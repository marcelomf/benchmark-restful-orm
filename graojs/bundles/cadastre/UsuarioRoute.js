var $i;
var UsuarioRoute = function(di) {
  $i = di;
  $i.graoExpress.get('/service/usuario/count',
    //$i.controllers.passport.service.validateJson, 
    $i.controllers.usuario.service.count);
  $i.graoExpress.get('/service/usuario/:id', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.get);
  $i.graoExpress.put('/service/usuario/:id', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.validate, 
    $i.controllers.usuario.service.update);
  $i.graoExpress.delete('/service/usuario/:id', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.destroy);
  $i.graoExpress.get('/service/usuario', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.query);
  $i.graoExpress.post('/service/usuario/validate', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.validate, 
    function(req, res){ 
      res.json($i.event.newSuccess("Successful validation!").toJson()); 
    });
  $i.graoExpress.post('/service/usuario', 
    //$i.controllers.passport.service.validateJson,
    $i.controllers.usuario.service.validate,
    $i.controllers.usuario.service.create);
  $i.graoExpress.get('/admin/usuario', 
    //$i.controllers.passport.service.validateTpl,
    $i.controllers.usuario.admin.dashboard);
};

module.exports = exports = UsuarioRoute;