'use strict';
module.exports = (sequelize, DataTypes) => {
  var Usuario = sequelize.define('Usuario', {
    nome: DataTypes.STRING,
    login: DataTypes.STRING,
    senha: DataTypes.STRING,
    email: DataTypes.STRING,
    permissao: DataTypes.STRING
  }, {});
  Usuario.associate = function(models) {
    // associations can be defined here
  };
  return Usuario;
};