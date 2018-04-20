
function UsuarioPublicController($scope, $http, $q, share, Usuario) {
  $scope.share = share;
  $scope.notFilter = true;
  $scope.dataList = new DataList();
  $scope.usuario = $scope.usuario || (share.getRefObject("usuario") != null) ? share.getRefObject("usuario") : {};
  $scope.errors = {};
  $scope.errors.usuario = {};

  $scope.$watch("dataList", function(newDataList, oldDataList) {
    if(oldDataList.page.current != newDataList.page.current || 
      oldDataList.page.limit != newDataList.page.limit) {
      newDataList.page.skip = newDataList.page.current * newDataList.page.limit - newDataList.page.limit;
      $scope.queryUsuario();
    }
  }, true);

  $scope.createOrUpdateUsuario = function(windowCallBack, isRefered) {
    share.alertLoad();
    function finallySaved(dataResponse, windowCallBack, isRefered) {
      if(!isRefered) {
        $scope.queryUsuario();
        $scope.countUsuario(); 
        $scope.clearUsuario();
      } else {
        if(dataResponse.data && dataResponse.data._id)
          share.refAddObject("usuario", dataResponse.data);
      }
      if(windowCallBack)
        share.window(windowCallBack); 
      else
        share.windowBack();
    }

    function save() {
      var usuarioJson = $scope.usuario;
      if($scope.usuario._id != null)
        Usuario.update(usuarioJson, function(dataResponse){ 
          if(validate(share.alert, $scope.errors.usuario, dataResponse))
            finallySaved(dataResponse, windowCallBack, isRefered);
        });
      else
        Usuario.save(usuarioJson, function(dataResponse){ 
          if(validate(share.alert, $scope.errors.usuario, dataResponse))
            finallySaved(dataResponse, windowCallBack, isRefered);
        });
    } 
    save();
  }

  $scope.destroyUsuarioByIndex = function(index) {
    share.alertLoad();
    $scope.dataList.data[index].$delete(function(dataResponse){
      share.alert.show = true;
      share.alert.style = dataResponse.event.style;
      share.alert.message = dataResponse.event.message;
      if(dataResponse.event.status == true) {
        $scope.dataList.status.totality = $scope.dataList.status.totality-1;
        $scope.dataList.status.listing = $scope.dataList.data.length;
      }
    });
    $scope.dataList.data.splice(index, 1);
  }

  $scope.queryUsuario = function(queryMode) {
    share.alertLoad();
    if(queryMode === "reset")
      $scope.dataList.reset();

    if(queryMode === "all") {
      Usuario.query(null, function(dataResponse){ 
        $scope.usuarios = dataResponse;
        $scope.dataList.data = dataResponse.slice(0, 10);
        $scope.dataList.status.listing = $scope.dataList.data.length;
        share.alertClean();
      });
    } else {
      Usuario.query($scope.dataList.toParams(), function(dataResponse){ 
        $scope.dataList.data = dataResponse;
        $scope.dataList.status.listing = $scope.dataList.data.length;
        share.alertClean();
      });
    }

  }
  $scope.queryUsuario();

  $scope.countUsuario = function() {
    Usuario.count($scope.dataList.toParams(), function(dataResponse){
      $scope.dataList.status = dataResponse;
      $scope.dataList.status.listing = $scope.dataList.data.length;
    });
  }
  $scope.countUsuario();

  $scope.queryMoreUsuario = function() {
    share.alertLoad();
    $scope.dataList.page.skip = $scope.dataList.data.length;
    Usuario.query($scope.dataList.toParams(), function(dataResponse){
      angular.forEach(dataResponse, function(data){
        $scope.dataList.data.push(data);
        $scope.dataList.status.listing++;
      });
      share.alertClean();
    });
  }

  $scope.selectUsuario = function(index) {
    $scope.usuario = $scope.dataList.data[index];
  }

  $scope.clearUsuario = function() {
    delete $scope.usuario;
    $scope.usuario = {};
    $scope.errors = {};
    $scope.errors.usuario = {};

  }

}

