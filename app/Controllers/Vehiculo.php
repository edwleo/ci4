<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Vehiculo extends BaseController{
  public function index(){
    $data = [
      "header" => view("Partials/header"),
      "footer" => view("Partials/footer")
    ];
    return view("Modulos/vehiculos/index", $data);
  }
}