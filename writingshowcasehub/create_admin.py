from main import app, db, User
from werkzeug.security import generate_password_hash

# Replace with your desired admin credentials
username = "zhavion"
email = "zhavion@gmail.com"
password = "ALCALIF8556"

# Create the admin user
hashed_password = generate_password_hash(password)
admin_user = User(username=username, email=email, password=hashed_password, is_admin=True)

# Add to the database
with app.app_context():
    db.session.add(admin_user)
    db.session.commit()
    print("Admin user created successfully!")