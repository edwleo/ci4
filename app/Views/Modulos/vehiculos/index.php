<?= $header ?>
<div class="row">
  <div class="col-md-12">
    <h5>Vehículos</h5>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-registro">
      Registrar vehiculo
    </button>

    <table class="table table-sm mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Año</th>
          <th>Color</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($vehiculos as $vehiculo): ?>
          <tr>
            <td><?= $vehiculo['id'] ?></td>
            <td><?= $vehiculo['marca'] ?></td>
            <td><?= $vehiculo['modelo'] ?></td>
            <td><?= $vehiculo['anio'] ?></td>
            <td><?= $vehiculo['color'] ?></td>
            <td><?= $vehiculo['precio'] ?></td>
            <td>
              <a href="#" class="btn btn-sm btn-primary">Editar</a>
              <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-registro" tabindex="-1" data-backdrop="static" data-keyboard="false"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo vehiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" autocomplete="off" id="form-vehiculos">
          <div class="form-group">
            <label for="marcas">Marca</label>
            <select name="marcas" id="marcas" class="form-control" required>
              <option value="">Marca</option>
              <option value="A">AAA</option>
            </select>
          </div>
          <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo" required>
          </div>
          <div class="form-group">
            <label for="">Año</label>
            <input type="text" id="anio" name="anio" class="form-control" minlength="4" maxlength="4" required>
          </div>
          <div class="form-group">
            <label for="">Color</label>
            <input type="text" id="color" name="color" class="form-control" required>
          </div>
          <div class="form-group">Precio</div>
          <input type="text" id="precio" name="precio" maxlength="10" class="form-control text-right" required>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="form-vehiculos" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<?= $libraries ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("modal-registro");
    const formulario = document.getElementById("form-vehiculos");
    
    $('#modal-registro').on('hidden.bs.modal', function (event) {
      formulario.reset();
    })
    

  });
</script>


<?= $footer ?>