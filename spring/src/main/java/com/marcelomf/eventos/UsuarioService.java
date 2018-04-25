package com.marcelomf.eventos;

import java.util.List;

public interface UsuarioService {

    Usuario create(Usuario usuario);

    Usuario delete(int id);

    List<Usuario> findAll();

    Usuario findById(int id);

    Usuario update(int id, Usuario usuario);
}
