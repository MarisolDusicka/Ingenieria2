<?php

namespace App\Models; 

use CodeIgniter\Model;


class  ProductoModel extends Model
{
    protected $table      = 'anteojos';
    protected $primaryKey = 'id_anteojo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 'codigo_anteojo', 'anteojo_nombre', 'anteojo_categoria', 'anteojo_marca', 'anteojo_stock', 'anteojo_precio',  'anteojo_descripcion', 'anteojo_imagen', 'anteojo_estado'] ;

 /*   // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = '';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';*/

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


public function getResult(){
    $db = \Config\Database::connect();
    $builder = $db->table('anteojos');
    $builder->select('*');
    $builder->join('categorias', 'categorias.id_categoria = anteojos.anteojo_categoria');
    $builder->join('marcas', 'marcas.id_marca = anteojos.anteojo_marca');
    $query = $builder->get();
    return $query->getResultArray();
}


/*// buscar el registro a traves $id por este metodo 
public function getAnteojos($id){
   return $this->where('$data',$id)->first($id);
}

public function actualizar($id, $data){
    return update($id, $data);
}
*/

}