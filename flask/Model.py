from flask import Flask
from marshmallow import Schema, fields, pre_load, validate
from flask_marshmallow import Marshmallow
from flask_sqlalchemy import SQLAlchemy

ma = Marshmallow()
db = SQLAlchemy()

class Usuario(db.Model):
    __tablename__ = 'usuarios'
    id = db.Column(db.Integer, primary_key=True)
    nome = db.Column(db.String(250), nullable=False)
    login = db.Column(db.String(250), nullable=True)
    senha = db.Column(db.String(250), nullable=True)
    email = db.Column(db.String(250), nullable=True)
    permissao = db.Column(db.String(250), nullable=True)

    def __init__(self, nome, login, senha, email, permissao):
        self.nome = nome
        self.login = login
        self.senha = senha
        self.email = email
        self.permissao = permissao

class UsuarioSchema(ma.Schema):
    id = fields.Integer(dump_only=True)
    nome = fields.String(required=True, validate=validate.Length(1))
    login = fields.String(required=False, validate=validate.Length(1))
    senha = fields.String(required=False, validate=validate.Length(1))
    email = fields.String(required=False, validate=validate.Length(1))
    permissao = fields.String(required=False, validate=validate.Length(1))