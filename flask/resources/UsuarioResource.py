from flask import request
from flask_restful import Resource
from Model import db, Usuario, UsuarioSchema

usuarios_schema = UsuarioSchema(many=True)
usuario_schema = UsuarioSchema()

class UsuarioResource(Resource):
    def get(self):
        usuarios = Usuario.query.all()
        usuarios = usuarios_schema.dump(usuarios).data
        return usuarios, 200

    def post(self):
        json_data = request.get_json(force=True)
        data, errors = usuario_schema.load(json_data)
        if errors:
            return errors, 422
        usuario = Usuario(
            nome=json_data['nome'],
            login=json_data['login'],
            senha=json_data['senha'],
            email=json_data['email'],
            permissao=json_data['permissao']
        )
        db.session.add(usuario)
        db.session.commit()

        result = usuario_schema.dump(usuario).data

        return result, 201
        
    def put(self, id):
        json_data = request.get_json(force=True)
        data, errors = usuario_schema.load(json_data)
        if errors:
            return errors, 422
        
        usuario = Usuario.query.filter_by(id=id).first()
        usuario.nome = data['nome']
        usuario.login = data['login']
        usuario.senha = data['senha']
        usuario.email = data['email']
        usuario.permissao = data['permissao']
        db.session.commit()
        result = usuario_schema.dump(usuario).data

        return result, 204

    def delete(self, id):
        print(id)
        usuario = Usuario.query.filter_by(id=id).delete()
        db.session.commit()

        return '{}', 204