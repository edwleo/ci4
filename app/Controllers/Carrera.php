<?php

namespace App\Controllers;

class Carrera extends BaseController{

  /**
   * Retorna la vista de la Web de Ingeniería de Software
   */
  public function showIngenieria(): string
  {
    return view('ingenieria');
  }

  /**
   * Retorna la vista de la Web de Diseño Gráfico Digital
   */
  public function showDesign(): string
  {
    return view('design');
  }

}