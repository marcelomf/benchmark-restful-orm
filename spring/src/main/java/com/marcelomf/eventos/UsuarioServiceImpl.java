package com.marcelomf.eventos;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class UsuarioServiceImpl implements UsuarioService {

    @Autowired
    private UsuarioRepository repository;

    @Override
    public Usuario create(Usuario usuario) {
        return repository.save(usuario);
    }

    @Override
    public Usuario delete(int id) {
        Usuario usuario = findById(id);
        if(usuario != null){
            repository.delete(usuario);
        }
        return usuario;
    }

    @Override
    public List<Usuario> findAll() {
        return repository.findAll();
    }

    @Override
    public Usuario findById(int id) {
        return repository.findOne(id);
    }

    @Override
    public Usuario update(int id, Usuario usuario) {
        usuario.setId(id);
        return repository.save(usuario);
    }
}
