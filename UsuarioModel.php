<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'id_persona';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['persona_nombre', 'persona_apellido','persona_telefono',
     'persona_direccion', 'persona_email', 'persona_password', 'perfil_id', 'persona_estado'];


public function getResult(){
    $db = \Config\Database::connect();
    $builder = $db->table('personas');
    $builder->select('*');
    $query = $builder->get();
    return $query->getResultArray();
}

//public function getpersonas($id_persona){
  //  return $this->where('id', $id_persona)->first($id_persona);
//}


public function getpersonas($id_persona)
{
    return $this->where('id_persona', $id_persona)->first();
}


}