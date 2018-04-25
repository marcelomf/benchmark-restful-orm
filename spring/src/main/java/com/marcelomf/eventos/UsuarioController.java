package com.marcelomf.eventos;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
public class UsuarioController {

    @Autowired
    private UsuarioService usuarioService;

    @PostMapping("/usuarios")
    public Usuario create(@RequestBody Usuario usuario){
        return usuarioService.create(usuario);
    }

    @GetMapping("/usuarios/{id}")
    public Usuario findOne(@PathVariable("id") int id){
        return usuarioService.findById(id);
    }

    @PutMapping("/usuarios/{id}")
    public Usuario update(@PathVariable("id") int id, @RequestBody Usuario usuario){
        return usuarioService.update(id, usuario);
    }

    @DeleteMapping("/usuarios/{id}")
    public Usuario delete(@PathVariable("id") int id) {
        return usuarioService.delete(id);
    }

    @GetMapping("/usuarios")
    public List<Usuario> findAll(){
        return usuarioService.findAll();
    }
}
