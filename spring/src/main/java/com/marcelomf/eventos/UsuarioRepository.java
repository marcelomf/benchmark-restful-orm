package com.marcelomf.eventos;

import org.springframework.data.repository.Repository;

import java.util.List;

public interface UsuarioRepository extends Repository<Usuario, Integer> {

    void delete(Usuario usuario);

    List<Usuario> findAll();

    Usuario findOne(int id);

    Usuario save(Usuario usuario);
}
