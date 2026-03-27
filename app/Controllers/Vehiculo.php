<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\VehiculoModel;

class Vehiculo extends BaseController
{

  public function index()
  {
    $vehiculo = new VehiculoModel();

    $data = [
      "header" => view("Partials/header"),
      "footer" => view("Partials/footer"),
      "libraries" => view("Partials/libraries")
    ];
    return view("Modulos/vehiculos/index", $data);
  }

  public function getVehiculos()
  {
    $vehiculo = new VehiculoModel();
    return $this->response->setJSON($vehiculo->getVehiculosConMarca());
  }

  public function registrarVehiculo()
  {
    $vehiculo = new VehiculoModel();

    $data = $this->request->getJSON();

    if ($vehiculo->insert($data)) {
      return $this->response->setJSON([
        "status" => "success",
        "message" => "Vehículo registrado correctamente"
      ]);
    }

    return $this->response->setJSON([
      "status" => "error",
      "message" => "Error al registrar el vehículo"
    ]);
  }

  public function eliminarVehiculo($id)
  {
    $vehiculo = new VehiculoModel();
    $registro = $vehiculo->find($id);

    if (!$registro){
      return $this->response
        ->setStatusCode(404)
        ->setJSON([
          "status" => "error",
          "message" => "Vehículo no encontrado"
        ]);
    }

    if ($vehiculo->delete($id)) {
      return $this->response
      ->setStatusCode(200)
      ->setJSON([
        "status" => "success",
        "message" => "Vehículo eliminado correctamente"
      ]);
    }

    return $this->response
      ->setStatusCode(500)
      ->setJSON([
        "status" => "error",
        "message" => "Error al eliminar el vehículo"
      ]);
  }
}