<?= $header ?>

<div class="row">
  <div class="col-md-12">
    <h5>Administrador de vehículos</h5>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-vehiculos">
      Nuevo vehículo
    </button>

    <a href="<?= base_url('vehiculos/reporte') ?>" class="btn btn-primary">Reportes</a>

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


<!-- Zona modal -->
<div class="modal fade" id="modal-vehiculos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- primary, success, danger, info, secondary, light -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Complete el formulario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario-vehiculos" autocomplete="off">
          
          <div class="form-group">
            <label for="marcas">Marca:</label>
            <select name="marcas" id="marcas" class="form-control rounded-0" required>
              <option value="">Seleccione</option>
            </select>
          </div>

          <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" class="rounded-0 form-control" id="modelo" required>
          </div>

          <div class="form-group">
            <label for="anio">Año:</label>
            <input type="text" class="rounded-0 form-control" id="anio" minlength="4" maxlength="4" required>
          </div>

          <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" class="rounded-0 form-control" id="color" required>
          </div>

          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="text" class="rounded-0 form-control text-right" id="precio" required>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-0 btn-sm btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="formulario-vehiculos" class="btn rounded-0 btn-sm btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Zona modal -->

<script>
  document.addEventListener("DOMContentLoaded", function(){
    
    //Referencias, declaración objetos
    const tabla = document.querySelector("#content-vehiculos") //<tbody>
    const listaMarcas = document.querySelector("#marcas") //<select>
    const formulario = document.querySelector("#formulario-vehiculos") //<form>

    //Función estandar
    function notificar(mensaje = ''){
      Swal.fire({
        text: mensaje,
        icon: 'info',
        position: 'top-end',
        timer: 2500,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        background: '#ffeaa7'
      })
    }

    //Funciones asíncronas
    async function registrarVehiculo(){
      try{
        //Objeto que contenga los datos para registro
        const vehiculo = {
          idmarca: listaMarcas.value,
          modelo: document.querySelector("#modelo").value,
          anio: document.querySelector("#anio").value,
          color: document.querySelector("#color").value,
          precio: document.querySelector("#precio").value
        }

        //Se envía la solicitud
        const response = await fetch(`<?= base_url('vehiculos/registrar') ?>`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(vehiculo)
        })

        const data = await response.json()
        notificar(data.message)
        
        //No funcionó
        if (!data.success) { return; }

        //Todo bien...
        //Cerrar modal
        $('#modal-vehiculos').modal('hide')

        //Formulario se reinicia
        formulario.reset()

        //Recargar tabla
        obtenerVehiculos()

      }catch(e){
        console.error("No se logró registrar:", e)
      }
    }

    async function obtenerMarcas(){
      try{
        const response = await fetch(`<?= base_url('marcas/listar') ?>`)
        const data = await response.json()

        if (response.status != 200) { return; }
        if (!data) { return; }

        data.forEach(element => {
          const tagOption = document.createElement("option")
          tagOption.value = element.id
          tagOption.innerText = element.marca
          listaMarcas.appendChild(tagOption)
        });

      }catch(e){
        console.error("No se pudo obtener las marcas:", e)
      }
    }

    async function obtenerVehiculos(){
      try{
        const response = await fetch(`<?= base_url('vehiculos/listar') ?>`)
        const data = await response.json()
        
        //Si el servidor no respondió correctamente
        if (response.status != 200) {return;}
        
        //Si no encontramos datos...
        if (!data){ return; }

        tabla.innerHTML = ``

        //¡Todo OK procedemos!
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
              <a href='#' class='btn btn-sm btn-info'>Editar</a>
              <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
            </td>
          </tr>
          `
        });

      }catch(e){
        console.error("Error al obtener los datos:", e)
      }
    }

    //Eventos
    formulario.addEventListener("submit", function (event){
      event.preventDefault() //STOP

      if (!confirm("¿Registramos este vehículo?")) { return; }
      registrarVehiculo()
    })


    //Función autoejecución
    obtenerVehiculos()
    obtenerMarcas()

  })
</script>

<?= $footer ?>