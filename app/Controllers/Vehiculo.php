<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\VehiculoModel;

class Vehiculo extends BaseController{
  public function index(){
    $vehiculo = new VehiculoModel();

    $data = [
      "header" => view("Partials/header"),
      "footer" => view("Partials/footer"),
      "libraries" => view("Partials/libraries"),
      "vehiculos" => $vehiculo->getVehiculosConMarca()
    ];
    return view("Modulos/vehiculos/index", $data);
  }
}