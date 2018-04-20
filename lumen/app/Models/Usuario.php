<?php
# app/Models/Usuario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Usuario extends Model  
{
    protected $fillable = ['nome', 'login', 'email', 'senha', 'permissao'];
}
?>