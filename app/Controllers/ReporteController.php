<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VehiculoModel;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class ReporteController extends BaseController
{
  public function vehiculosTodosPDF(){
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
      $pdfContent = $html2pdf->output('Reporte.pdf', 'I');
      exit();

    }catch(Html2PdfException $e){
      $html2pdf->clean();
      throw new \RuntimeException($e->getMessage());
    }

  }
}