<?php

namespace App\Models;

use CodeIgniter\Model;

class RecetaModel extends Model
{
    protected $table = 'recetas';
    protected $primaryKey = 'id_receta';
    protected $returnType = 'array';

    protected $allowedFields = [
        'id_persona',
        'id_anteojo',
        'observaciones',
        'receta',
        'fecha',
        'estado'
    ];

    /**
     * Consulta normal usando Query Builder de CodeIgniter.
     */
    public function getRecetas()
    {
        return $this->select('
                recetas.*,
                anteojos.anteojo_nombre,
                personas.persona_nombre,
                personas.persona_apellido
            ')
            ->join('anteojos', 'anteojos.id_anteojo = recetas.id_anteojo')
            ->join('personas', 'personas.id_persona = recetas.id_persona')
            ->orderBy('recetas.id_receta', 'DESC')
            ->findAll();
    }

    /**
     * Invoca el procedimiento almacenado de consulta.
     * Procedimiento: sp_consultar_recetas_pendientes()
     */
    public function consultarRecetasPendientesSP()
    {
        $db = \Config\Database::connect();

        $query = $db->query("CALL sp_consultar_recetas_pendientes()");

        return $query->getResultArray();
    }

    /**
     * Invoca el procedimiento almacenado de actualización.
     * Procedimiento: sp_actualizar_estado_receta()
     */
    public function actualizarEstadoRecetaSP($idReceta, $estado)
    {
        $db = \Config\Database::connect();

        $db->query("CALL sp_actualizar_estado_receta(?, ?)", [
            $idReceta,
            $estado
        ]);

        return true;
    }


    
}