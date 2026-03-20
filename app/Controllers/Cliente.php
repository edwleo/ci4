<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClienteModel;

class Cliente extends BaseController
{

  /**
   * Este método retorna la vista con los datos de clientes
   * @return string
   */
  public function index(): string
  {
    $cliente = new ClienteModel();

    //$data es toda información que enviaremos a la vista
    $data = [
      'header'    => view('Partials/header'),
      'clientes'  => $cliente->findAll(),
      'footer'    => view('Partials/footer'),
    ];

    return view("Modulos/clientes/index", $data);
  }

  public function create(): string{
    $data = [
      'header'    => view('Partials/header'),
      'footer'    => view('Partials/footer')
    ];

    return view('Modulos/clientes/registrar', $data);
  }

}