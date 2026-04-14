<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VehiculoModel;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class ReporteController extends BaseController
{
  public function generarReportePrueba(){
    //No tenemos modelo de donde negociar los datos...
    $listaPersonas = [
      ["apellidos" => "Torres", "nombres" => "Carlos", "telefono" => "956111222", "genero" => "M", "sueldo" => 2000],
      ["apellidos" => "Quintana", "nombres" => "Juana", "telefono" => "956111333", "genero" => "F", "sueldo" => 4000],
      ["apellidos" => "Flores", "nombres" => "Pedro", "telefono" => "956111444", "genero" => "M", "sueldo" => 3000],
      ["apellidos" => "Ochoa", "nombres" => "Hugo", "telefono" => "956111555", "genero" => "M", "sueldo" => 2200],
      ["apellidos" => "Mendoza", "nombres" => "Silvia", "telefono" => "956111777", "genero" => "F", "sueldo" => 5000]
    ];

    $estilos = view('Reports/estilos'); //Estilos CSS
    $html = view('Reports/prueba', ['personas' => $listaPersonas, 'estilos' => $estilos]);

    try{
      $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', [20, 15, 15, 15]);
      $html2pdf->setDefaultFont('Arial');
      $html2pdf->writeHTML($html);
      $html2pdf->output('Reporte-prueba.pdf');
      $this->response->setHeader('Content-Type', 'application/pdf');
    }
    catch(Html2PdfException $e){
      $html2pdf->clean();
      throw new \RuntimeException($e->getMessage());
    }

  }

  public function generarReporteVehiculos(){
    //Obtener datos
    $vehiculo = new VehiculoModel();
    $listaVehiculos = $vehiculo->obtenerVehiculos();

    //Renderizar la vista
    $html = view('Reports/vehiculos-todos', ['vehiculos' => $listaVehiculos]);

    //Generar PDF
    try{
      $html2pdf = new Html2Pdf('P', 'A4', 'es');
      $html2pdf->setDefaultFont('Arial');
      $html2pdf->writeHTML($html);

      //I = Mostrar en el navegador, D = forzar descarga
      //F = guarda en el servidor, S = retorna el PDF como string
      $html2pdf->output('Reporte.pdf', 'I');
      exit();

    }catch(Html2PdfException $e){
      $html2pdf->clean();
      throw new \RuntimeException($e->getMessage());
    }

  }
}