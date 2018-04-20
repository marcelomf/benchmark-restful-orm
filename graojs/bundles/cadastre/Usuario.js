var methods = {}, statics = {}, $i;

var Usuario = function(di) {
  $i = di;
  $i.schemas.usuario.mongoose.methods = methods;
  $i.schemas.usuario.mongoose.statics = statics;
  return $i.mongoose.model("Usuario", $i.schemas.usuario.mongoose, "usuario");
};

module.exports = exports = Usuario;