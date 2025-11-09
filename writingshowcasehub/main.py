from flask import Flask, render_template, request, redirect, url_for, session, flash, send_from_directory
from flask_bcrypt import Bcrypt
from werkzeug.utils import secure_filename
from models import db, Comment, Poem, User, Like
from datetime import datetime
import os
from flask_wtf.csrf import CSRFProtect
from flask_mail import Mail, Message
from flask_migrate import Migrate
from flask_sqlalchemy import SQLAlchemy  # Import SQLAlchemy
# Flask app configuration
app = Flask(__name__)
app.secret_key = 'your_secret_key'

# Database configuration
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///showcase.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db.init_app(app)
migrate = Migrate(app, db)
csrf = CSRFProtect(app)

app.config['SECRET_KEY'] = 'your_secret_key_here'
app.config['WTF_CSRF_ENABLED'] = True
bcrypt = Bcrypt(app)

# Flask-Mail configuration
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USERNAME'] = 'your_email@gmail.com'
app.config['MAIL_PASSWORD'] = 'your_email_password'
mail = Mail(app)


# Database configuration
UPLOAD_FOLDER = os.path.join(os.getcwd(), 'uploads')
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///showcase.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False


# Define allowed file extensions
ALLOWED_EXTENSIONS = {'txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif'}

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.before_request
def debug_csrf_token():
    print("CSRF Token in Request:", request.form.get('csrf_token'))

@app.route('/')
def home():
    return render_template('home.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/signup', methods=['GET', 'POST'])
def signup():
    if request.method == 'POST':
        username = request.form.get('username')
        email = request.form.get('email')
        password = request.form.get('password')

        if not username or not email or not password:
            flash('All fields are required.', 'error')
            return redirect(url_for('signup'))

        if len(username) < 3:
            flash('Username must be at least 3 characters long.', 'error')
            return redirect(url_for('signup'))

        if '@' not in email or '.' not in email:
            flash('Invalid email address.', 'error')
            return redirect(url_for('signup'))

        if len(password) < 6:
            flash('Password must be at least 6 characters long.', 'error')
            return redirect(url_for('signup'))

        if User.query.filter_by(email=email).first():
            flash('Email already exists.', 'error')
            return redirect(url_for('signup'))

        hashed_password = bcrypt.generate_password_hash(password).decode('utf-8')
        try:
            user = User(username=username, email=email, password=hashed_password)
            db.session.add(user)
            db.session.commit()
            flash('Account created successfully!', 'success')
            return redirect(url_for('login'))
        except Exception as e:
            db.session.rollback()
            print(f"Error creating account: {e}")
            flash('Error creating account. Please try again.', 'error')
    return render_template('signup.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form.get('email')
        password = request.form.get('password')
        user = User.query.filter_by(email=email).first()

        if user and bcrypt.check_password_hash(user.password, password):
            session['user_id'] = user.id
            session['is_admin'] = user.is_admin  # Store admin status in the session
            flash('Login successful!', 'success')
            if user.is_admin:
                return redirect(url_for('admin_dashboard'))  # Redirect to admin dashboard
            return redirect(url_for('dashboard'))  # Redirect to user dashboard
        flash('Invalid credentials.', 'error')
    return render_template('login.html')

@app.route('/dashboard')
def dashboard():
    if 'user_id' not in session:
        flash('Please log in to access your dashboard.', 'error')
        return redirect(url_for('login'))

    # Fetch the user's poems from the database
    poems = Poem.query.filter_by(user_id=session['user_id']).all()
    return render_template('dashboard.html', poems=poems)

@app.route('/admin_dashboard')
def admin_dashboard():
    if 'user_id' not in session or not session.get('is_admin'):
        flash('Access denied. Admins only.', 'error')
        return redirect(url_for('login'))
    return render_template('admin_dashboard.html')

@app.route('/admin_only_route')
def admin_only_route():
    if 'user_id' not in session or not session.get('is_admin'):
        flash('Access denied. Admins only.', 'error')
        return redirect(url_for('login'))
    # Admin-specific logic here
    return "This is an admin-only page."
@app.route('/approve_poems', methods=['GET', 'POST'])
def approve_poems():
    if 'user_id' not in session or not session.get('is_admin'):
        flash('Access denied. Admins only.', 'error')
        return redirect(url_for('login'))

    # Fetch unapproved poems with pagination
    page = request.args.get('page', 1, type=int)
    poems = Poem.query.filter_by(approved=False).paginate(page=page, per_page=5)

    if request.method == 'POST':
        poem_id = request.form.get('poem_id')
        action = request.form.get('action')  # 'approve' or 'reject'
        poem = Poem.query.get(poem_id)
        if poem:
            user = User.query.get(poem.user_id)  # Get the user who submitted the poem
            if action == 'approve':
                poem.approved = True
                db.session.commit()
                flash('Poem approved successfully!', 'success')

                # Send approval email
                msg = Message('Your Poem Has Been Approved!',
                              sender=app.config['MAIL_USERNAME'],
                              recipients=[user.email])
                msg.body = f"Dear {user.username},\n\nYour poem '{poem.title}' has been approved and is now live in the gallery!"
                mail.send(msg)

            elif action == 'reject':
                db.session.delete(poem)
                db.session.commit()
                flash('Poem rejected successfully!', 'success')

                # Send rejection email
                msg = Message('Your Poem Has Been Rejected',
                              sender=app.config['MAIL_USERNAME'],
                              recipients=[user.email])
                msg.body = f"Dear {user.username},\n\nWe regret to inform you that your poem '{poem.title}' has been rejected."
                mail.send(msg)
        else:
            flash('Poem not found.', 'error')

    return render_template('approve_poems.html', poems=poems)


@app.route('/send_test_email')
def send_test_email():
    try:
        msg = Message('Test Email',
                      sender='your_email@gmail.com',
                      recipients=['recipient_email@gmail.com'])  # Replace with recipient's email
        msg.body = 'This is a test email from Flask-Mail.'
        mail.send(msg)
        return 'Email sent successfully!'
    except Exception as e:
        return f'Failed to send email: {e}'

@app.route('/submit_poem', methods=['GET', 'POST'])
def submit_poem():
    if 'user_id' not in session:
        flash('Please log in to submit a poem.', 'error')
        return redirect(url_for('login'))

    if request.method == 'POST':
        # Retrieve form data
        title = request.form.get('title')
        content = request.form.get('content')
        category = request.form.get('category')
        file = request.files.get('file')  # Use .get() to avoid KeyError

        # Validate required fields
        if not title or not content or not category:
            flash('All fields except the file are required.', 'error')
            return redirect(url_for('submit_poem'))

        # Handle file upload if provided
        if file and allowed_file(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
            poem = Poem(title=title, content=content, category=category, user_id=session['user_id'], file=filename)
        else:
            poem = Poem(title=title, content=content, category=category, user_id=session['user_id'])

        # Save the poem to the database
        try:
            db.session.add(poem)
            db.session.commit()
            flash('Poem submitted successfully!', 'success')
            return redirect(url_for('dashboard'))
        except Exception as e:
            db.session.rollback()
            print(f"Error submitting poem: {e}")  # Log the error
            flash('Error submitting poem. Please try again.', 'error')

    return render_template('submit_poem.html')

@app.route('/poem/<int:poem_id>', methods=['GET'])
def view_poem(poem_id):
    poem = Poem.query.get_or_404(poem_id)
    return render_template('view_poem.html', poem=poem)

@app.route('/poem/<int:poem_id>/like', methods=['POST'])
def like_poem(poem_id):
    poem = Poem.query.get_or_404(poem_id)
    user_id = session.get('user_id')
    if not user_id:
        flash('Please log in to like poems.', 'error')
        return redirect(url_for('login'))
    existing_like = Like.query.filter_by(poem_id=poem_id, user_id=user_id).first()
    if existing_like:
        flash('You have already liked this poem.', 'info')
        return redirect(url_for('view_poem', poem_id=poem_id))
    like = Like(poem_id=poem_id, user_id=user_id)
    db.session.add(like)
    poem.likes = (poem.likes or 0) + 1
    db.session.commit()
    flash('You liked this poem!', 'success')
    return redirect(url_for('view_poem', poem_id=poem_id))

@app.route('/poem/<int:poem_id>/comment', methods=['POST'])
def add_comment(poem_id):
    poem = Poem.query.get_or_404(poem_id)
    content = request.form.get('comment')
    if content:
        comment = Comment(content=content, user_id=session['user_id'], poem_id=poem_id)
        db.session.add(comment)
        db.session.commit()
        flash('Comment added successfully!', 'success')
    else:
        flash('Comment cannot be empty.', 'error')
    return redirect(url_for('view_poem', poem_id=poem_id))

@app.route('/gallery')
def gallery():
    page = request.args.get('page', 1, type=int)
    poems = Poem.query.filter_by(approved=True).paginate(page=page, per_page=5)
    print("Debug: Poems fetched for gallery:", poems.items)  # Debug statement
    return render_template('gallery.html', poems=poems)

@app.route('/download/<filename>')
def download_file(filename):
    return send_from_directory(app.config['UPLOAD_FOLDER'], filename, as_attachment=True)

@app.route('/logout')
def logout():
    session.clear()
    flash('Logged out successfully.', 'success')
    return redirect(url_for('home'))

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True)
