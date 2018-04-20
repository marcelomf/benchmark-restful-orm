var service = {}, admin = {}, models, controllers, event, config, Usuario, $i;

service.count = async (req, res) => {
  let dataList = controllers.processDataList(Usuario, req.query);

  try {
    let totality = await Usuario.count();
    if(dataList.filter == null) {
      return res.json({totality: totality, filtered: 0});
    }
    let filtered = await Usuario.count(dataList.filter);
    return res.json({totality: totality, filtered: filtered});
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

service.get = async (req, res) => {
  try {
    let usuario = await Usuario.findOne({_id : req.params.id}).exec();
    return res.json(usuario);
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

service.query = async (req, res) => {
  let dataList = { page: {}, sort: 'field -_id' };
  if(req.query.filter || req.query.sort || req.query.page)
    dataList = controllers.processDataList(Usuario, req.query);

  try {
    let usuarios = await Usuario.find(dataList.filter || null).
      sort(dataList.sort || null).
      skip(dataList.page.skip || null).
      limit(dataList.page.limit || null).
      populate('usuario').
      exec();
    return res.json(usuarios);
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

service.validate = (req, res, next) => {
  let usuario = new Usuario(req.body);
  usuario.validate(function(err){
    if(err)
      return res.json(event.newError(err).toJson());
    else
      return next();
  });
}

service.create = async (req, res) => {
  try {
    let usuario = new Usuario(req.body);
    usuario = await usuario.save();
    return res.json(event.newSuccess(res.__("usuario")+" "+res.__("created")).data(usuario).toJson());
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

service.update = async (req, res) => {
  delete req.body._id;
  try {
    let usuario = await Usuario.findOneAndUpdate({_id : req.params.id }, req.body, { upsert : true });
    return res.json(event.newSuccess(res.__("usuario")+" "+res.__("updated")).data(usuario).toJson());
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

service.destroy = async (req, res) => {  
  try {
    await Usuario.remove({_id : req.params.id});
    return res.json(event.newSuccess(res.__("Destroyed")).toJson());
  } catch(err) {
    return res.json(event.newError(err).toJson());
  }
}

admin.dashboard = (req, res) => {
  let locale = (config.locales.indexOf(req.cookies.locale) >= 0) ? req.cookies.locale : config.defaultLocale;
  res.render('cadastre/view/usuario_dashboard', { isAuth: req.isAuthenticated(), locale: locale, user: req.user});
}

var UsuarioController = function(di) {
  $i = di;
  event = new $i.event.newSuccess('Instance created');
  config = $i.config;
  models = $i.models;
  controllers = $i.controllers;
  Usuario = models.usuario; // object/class
  this.service = service;
  this.admin = admin;
};

module.exports = exports = UsuarioController;