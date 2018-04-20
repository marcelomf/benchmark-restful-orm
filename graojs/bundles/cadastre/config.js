module.exports = exports = {
  injection : {
    controller: [
      { name: "usuario", object: "UsuarioController.js" },
    ],
    model: [
      { name: "usuario", object: "Usuario.js" },
    ],
    route: [
      { name: "usuario", object: "UsuarioRoute.js" },
    ],
    validator: [
      { name: "usuario", object: "UsuarioValidator.js" },
    ],
    schema: [
      { name: "usuario", object: "UsuarioSchema.js" },
    ],
  },
  publicRoutes : [
    { fsdir: "/bundles/cadastre/public/css", webdir: "/css/usuario" },
    { fsdir: "/bundles/cadastre/public/js", webdir: "/js/usuario" },
    { fsdir: "/bundles/cadastre/public/image", webdir: "/image/usuario" },
    { fsdir: "/bundles/cadastre/public/font", webdir: "/font/usuario" },
    { fsdir: "/bundles/cadastre/public/file", webdir: "/file/usuario" },

  ]
}