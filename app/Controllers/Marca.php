<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\MarcaModel;

class Marca extends BaseController
{
  public function getMarcas()
  {
    $model = new MarcaModel();
    $marcas = $model->findAll();

    return $this->response
      ->setStatusCode(200)
      ->setJSON($marcas);
  }
}

?>