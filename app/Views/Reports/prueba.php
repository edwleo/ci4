<?= $estilos ?>

<page backtop="5mm" backbottom="5mm"> <!-- Inicio de la página -->
  <page_header>
    <div class="cabecera">Reporte de trabajadores</div>
  </page_header>

  <page_footer>
    <div class="pie">Página: [[page_cu]]</div>
  </page_footer>

  <!-- Contenido -->
  <table class="table">
    <thead>
      <tr>
        <th style="width: 10%" class="center">#</th>
        <th style="width: 25%">Apellidos</th>
        <th style="width: 25%">Nombres</th>
        <th style="width: 15%;">Teléfono</th>
        <th style="width: 10%;">Género</th>
        <th style="width: 15%;">Sueldo</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      $j = 1;
      $nPersonas = 0;
      $nHombres = 0; //Incializar
      $nMujeres = 0; //Incializar
      $sumSueldos = 0;
      $promSueldos = 0;
      ?>
      <?php for($i = 1; $i <= 10; $i++): ?>
        
        <?php foreach($personas as $persona): ?>
        <tr>
          <td><?= $j ?></td>
          <td><?= $persona['apellidos'] ?></td>
          <td><?= $persona['nombres'] ?></td>
          <td><?= $persona['telefono'] ?></td>
          <td><?= $persona['genero'] ?></td>
          <td><?= $persona['sueldo'] ?></td>
        </tr>
        <?php 
          $j++; 

          //Cálculos...
          if ($persona['genero'] == 'M') $nHombres++; else $nMujeres++;
          $sumSueldos += $persona['sueldo']; 
        ?>
        <?php endforeach; ?>
      <?php endfor; ?>
      
      <!-- Cálculos finales -->
      <?php $nPersonas = $nHombres + $nMujeres; ?>
      <?php $promSueldos = $sumSueldos / $nPersonas; ?>

    </tbody>
  </table>
</page> <!-- Fin de la página -->

<!-- Otras páginas -->
<!-- Se HEREDA cabacera, pie a través del "pageset" -->
<page pageset="old">
  <h1 class="center">Resumen</h1>
  <table class="table">
      <thead>
        <tr>
          <th style="width: 50%">Indicador</th>
          <th style="width: 50%">Valor</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Total</td>
          <td><?= $nPersonas ?></td>
        </tr>
        <tr>
          <td>Hombres</td>
          <td><?= $nHombres ?></td>
        </tr>
        <tr>
          <td>Mujeres</td>
          <td><?= $nMujeres ?></td>
        </tr>
        <tr>
          <td>Promedio sueldo</td>
          <td><?= $promSueldos ?></td>
        </tr>
      </tbody>
  </table>
</page>