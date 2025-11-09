from flask import Flask, render_template, request
from flask_wtf.csrf import CSRFProtect

app = Flask(__name__)
app.secret_key = 'test_secret_key'
csrf = CSRFProtect(app)

@app.route('/submit_poem', methods=['GET', 'POST'])
def submit_poem():
    if request.method == 'POST':
        title = request.form.get('title')
        content = request.form.get('content')
        category = request.form.get('category')
        file = request.files.get('file')
        return f"Poem submitted: {title}, {content}, {category}, File: {file.filename if file else 'No file'}"
    return '''
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
            <label>Title: <input type="text" name="title"></label><br>
            <label>Content: <textarea name="content"></textarea></label><br>
            <label>Category: <input type="text" name="category"></label><br>
            <label>File: <input type="file" name="file"></label><br>
            <button type="submit">Submit</button>
        </form>
    '''

if __name__ == '__main__':
    app.run(debug=True)