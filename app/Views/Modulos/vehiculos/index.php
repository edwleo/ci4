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
      <tbody id="content-vehiculos">
        
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
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" required>
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
    const marcas = document.getElementById("marcas");
    const tabla = document.getElementById("content-vehiculos");

    $('#modal-registro').on('hidden.bs.modal', function (event) {
      formulario.reset();
    })

    async function obtenerVehiculos(){
      try{
        const response = await fetch(`<?= base_url('vehiculos/obtener') ?>`);
        const data = await response.json();

        if (data){
          tabla.innerHTML = "";
          data.forEach(element => {
            tabla.innerHTML += `
            <tr>
              <td>${element.id}</td>
              <td>${element.marca}</td>
              <td>${element.modelo}</td>
              <td>${element.anio}</td>
              <td>${element.color}</td>
              <td>${element.precio}</td>
              <td>
                <a href="#" class="btn btn-sm btn-info btn-editar" data-idvehiculo="${element.id}">Editar</a>
                <a href="#" class="btn btn-sm btn-danger btn-eliminar" data-idvehiculo="${element.id}">Eliminar</a>
              </td>
            </tr>
            `;
          });
        }
      }catch(error){
        console.error("Error al obtener vehículos", error);
      }
    }

    async function obtenerMarcas() {
      try {
        const response = await fetch('<?= base_url('/marcas/obtener') ?>')
        const data = await response.json();

        if (data) {
          data.forEach(element => {
            const option = document.createElement("option");
            option.value = element.id;
            option.textContent = element.marca;
            marcas.appendChild(option);
          });
        }

      } catch (error) {
        console.error("Error al obtener marcas", error);
      }
    }

    async function registrarVehiculo() {
      try {
        const vehiculo = {
          idmarca: marcas.value,
          modelo: document.getElementById("modelo").value,
          anio: document.getElementById("anio").value,
          color: document.getElementById("color").value,
          precio: document.getElementById("precio").value
        }

        const response = await fetch('<?= base_url('/vehiculos/registrar') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(vehiculo)
        });

        const data = await response.json();
        if (data.status === "success") {
          alert(data.message);
          //location.reload();
          obtenerVehiculos();
          $("#modal-registro").modal("hide");
        } else {
          alert(data.message);
        }
      } catch (error) {
        console.error("Error al registrar vehículo", error);
      }
    }

    async function eliminarVehiculo(idvehiculo) {
      try {
        const response = await fetch(`<?= base_url('/vehiculos/eliminar') ?>/${idvehiculo}`, {
          method: 'DELETE'
        });

        const data = await response.json();
        if (data.status === "success") {
          alert(data.message);
          //location.reload();
          obtenerVehiculos();
        } else {
          alert(data.message);
        }
      } catch (error) {
        console.error("Error al eliminar vehículo", error);
      }
    }

    formulario.addEventListener("submit", function (event) {
      event.preventDefault();

      if (!confirm("¿Está seguro de registrar el vehpiculo?")) { return; }
      registrarVehiculo();

    });

    tabla.addEventListener("click", function (event){
      if (event.target.classList.contains("btn-eliminar")) {
        const idvehiculo = event.target.getAttribute("data-idvehiculo");
        if (confirm("¿Está seguro de eliminar el vehículo?")) {
          // Aquí iría la lógica para eliminar el vehículo usando el idvehiculo
          //console.log("Eliminar vehículo con ID:", idvehiculo);
          eliminarVehiculo(idvehiculo);
        }
      }
    });

    obtenerMarcas();
    obtenerVehiculos();

  });
</script>


<?= $footer ?>