<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoModel extends Model
{
  protected $table = "vehiculos";
  protected $primaryKey = "id";
  protected $returnType = "array";
  protected $allowedFields = ["idmarca", "modelo", "anio", "color", "precio"];

  //Activamos timestamps para que se llenen automáticamente los campos created_at y updated_at
  protected $useTimestamps = true;
  protected $createdField = 'created_at'; //insertar
  protected $updatedField = 'updated_at'; //insertar + actualizar
}

?>