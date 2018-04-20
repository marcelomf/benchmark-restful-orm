from flask import Blueprint
from flask_restful import Api
from resources.Hello import Hello
from resources.UsuarioResource import UsuarioResource

api_bp = Blueprint('api', __name__)
api = Api(api_bp)

# Route
api.add_resource(Hello, '/hello')
api.add_resource(UsuarioResource, '/usuarios', '/usuarios/<id>')