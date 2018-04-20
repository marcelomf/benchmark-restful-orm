<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Usuario;

class UsuarioController extends Controller
{
   public function count() {
       $count = Usuario::all()->count();
       return $count;
   }
   
   public function show($id) {
       $usuario = Usuario::find($id);
       return response()->json($usuario);
   }
   
   public function query() {
       $usuarios = Usuario::all();
       return response()->json($usuarios);
   }
   
   public function create(Request $request) {
       $usuario = Usuario::create($request->json()->all());
       return response()->json($usuario);
   }
   
   public function update($id, Request $request) {
       $usuario = Usuario::find($id);
       //$usuario->nome = $request->json()->get('nome');
       //$usuario->login = $request->json()->get('login');
       //$usuario->email = $request->json()->get('email');
       //$usuario->senha = $request->json()->get('senha');
       //$usuario->permissao = $request->json()->get('permissao');
       $usuario->update($request->json()->all());
       return response()->json($usuario);
   }
   
   public function destroy($id) {
       Usuario::destroy($id);
       return "{}";
   }
}
