using System.Collections.Generic;
using System.Linq;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using Eventos.Models;
 
namespace Eventos.Controllers
{
    public class UsuarioController : Controller
    {
        public MyDbContext context = new MyDbContext();

        [HttpGet("usuarios/{id}")]
        public Usuario GetUsuario(int id)
        {
            return context.Usuarios.Find(id);
        }
 
        [HttpDelete("usuarios/{id}")]
        public string RemoveUsuario(int id)
        {
            Usuario usuario = new Usuario() { Id = id};
            context.Usuarios.Attach(usuario);
            context.Usuarios.Remove(usuario);
            context.SaveChanges();
            return "{}";
        }
 
        [HttpGet("usuarios")]
        public List<Usuario> GetUsuarios()
        {
            return context.Usuarios.ToList();
        }
 
        [HttpPost("usuarios")]
        public string AddUsuario([FromBody]Usuario usuario)
        {
            context.Usuarios.Add(usuario);
            context.SaveChanges();
            return JsonConvert.SerializeObject(usuario);
        }

        [HttpPut("usuarios/{id}")]
        public string UpdateUsuario(int id, [FromBody]Usuario usuario)
        {
            usuario.Id = id;
            context.Usuarios.Update(usuario);
            context.SaveChanges();
            return JsonConvert.SerializeObject(usuario);
        }
    }
}