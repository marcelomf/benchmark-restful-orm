graoJS.factory('Usuario', ['$resource', function($resource) {
  var Usuario = $resource('/service/usuario/:id', { id: '@_id' }, {
    update: {
      method: 'PUT'
    },
    validate: {
      method: 'POST',
      url: '/service/usuario/validate'
    },
    count: {
      method: 'GET',
      url: '/service/usuario/count'
    }
  });
  return Usuario;
}]);