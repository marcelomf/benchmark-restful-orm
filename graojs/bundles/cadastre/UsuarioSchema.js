// checkbox boolean currency number primary date radio email text password select textarea url sub_document
// boolean currency number primary date sub_document
var UsuarioSchema = function(di) {
  var validate = di.validate;
  var validator = di.validators.usuario;

  this.fields = {

    id : di.mongoose.Schema.ObjectId,

    nome :{
        type : String,
        required: true
    },

    login :{
        type : String,
        required: true
    },

    senha :{
        type : String,
        required: true
    },

    email :{
        type : String,
        required: true
    },

    permissao :{
        type : String
    },

  };

  this.mongoose = new di.mongoose.Schema(this.fields);
};

module.exports = exports = UsuarioSchema;
