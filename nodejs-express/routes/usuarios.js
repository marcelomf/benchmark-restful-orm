var models  = require('../models');
var express = require('express');
var router  = express.Router();

router.post('/usuarios', function(req, res) {
  models.Usuario.create(
    req.body
   ).then(function(usuario) {
    res.send(usuario);
  }).catch(function(error){
    res.status(400).send(error);
  });
});

router.put('/usuarios/:id', function(req, res) {
  models.Usuario.findById(
    req.params.id
  ).then(function(usuario){
    usuario.update(
      req.body
    ).then(function(usuario){
      res.send(usuario);
    });
  });
});

router.delete('/usuarios/:id', function(req, res) {
  models.Usuario.destroy({
    where: {
      id: req.params.id
    }
  }).then(function() {
    res.send({});
  });
});

router.get('/usuarios', function(req, res) {
  models.Usuario.findAll(
  ).then(function(usuarios) {
    res.send(usuarios);
  });
});


module.exports = router;