# models.py
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime

db = SQLAlchemy()

class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(150), unique=True, nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    password = db.Column(db.String(150), nullable=False)
    is_admin = db.Column(db.Boolean, default=False)
    bio = db.Column(db.Text, default='')
    poems = db.relationship('Poem', backref='author', lazy=True)
    comments = db.relationship('Comment', backref='user', lazy=True)
    likes = db.relationship('Like', backref='user', lazy=True)

class Poem(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(100))
    content = db.Column(db.Text)
    category = db.Column(db.String(50))
    timestamp = db.Column(db.DateTime, default=datetime.utcnow)
    approved = db.Column(db.Boolean, default=False)  # Field to track approval status
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    comments = db.relationship('Comment', backref='poem', lazy=True)
    file = db.Column(db.String(120))
    likes = db.Column(db.Integer, default=0,nullable=False)  # Add this field
    
class Comment(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    content = db.Column(db.Text, nullable=False)
    timestamp = db.Column(db.DateTime, default=datetime.utcnow)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    poem_id = db.Column(db.Integer, db.ForeignKey('poem.id'), nullable=False)

    def __repr__(self):
        return f"<Comment {self.id} by User {self.user_id} on Poem {self.poem_id}>"

class Like(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    poem_id = db.Column(db.Integer, db.ForeignKey('poem.id'), nullable=False)
    user_id = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    __table_args__ = (db.UniqueConstraint('poem_id', 'user_id', name='unique_like'),)

