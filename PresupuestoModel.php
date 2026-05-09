<?php

namespace App\Models;

use CodeIgniter\Model;

class PresupuestoModel extends Model
{
    // ==========================================
    // TABLA
    // ==========================================

    protected $table = 'presupuestos';

    protected $primaryKey = 'id_presupuesto';

    protected $useAutoIncrement = true;

    // ==========================================
    // RETORNO
    // ==========================================

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    // ==========================================
    // CAMPOS PERMITIDOS
    // ==========================================

    protected $allowedFields = [

        'id_persona',

        'id_anteojo',

        'archivo_receta',

        'observaciones',

        'estado',

        'fecha_creacion'

    ];

    // ==========================================
    // TIMESTAMPS
    // ==========================================

    protected $useTimestamps = false;

    // ==========================================
    // OBTENER PRESUPUESTOS
    // ==========================================

    public function getPresupuestos()
    {
        return $this->findAll();
    }

    // ==========================================
    // OBTENER PRESUPUESTO POR ID
    // ==========================================

    public function getPresupuesto($id)
    {
        return $this->where(
            'id_presupuesto',
            $id
        )->first();
    }
}