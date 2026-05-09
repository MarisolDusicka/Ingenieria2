<?php

namespace App\Models;

use CodeIgniter\Model;

class RecetaModel extends Model
{
    protected $table = 'recetas';
    protected $primaryKey = 'id_receta';

    protected $allowedFields = [
        'id_persona',
        'id_anteojo',
        'observaciones',
        'receta',
        'fecha',
        'estado'
    ];

    // ✅ JOIN COMPLETO
    public function getRecetas()
    {
        return $this->select('
                recetas.id_receta,
                recetas.observaciones,
                recetas.receta,
                recetas.estado,
                recetas.fecha,
                anteojos.anteojo_nombre,
                personas.persona_nombre,
                personas.persona_apellido
            ')
            ->join('anteojos', 'anteojos.id_anteojo = recetas.id_anteojo')
            ->join('personas', 'personas.id_persona = recetas.id_persona')
            ->orderBy('recetas.id_receta', 'DESC')
            ->findAll();
    }
}