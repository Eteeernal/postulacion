<?php
require_once './src/subidaArchivos/Archivos.php';

$archivos = new Archivos();
$tipos = $archivos->obtenerTipos();

?>
<!DOCTYPE html>
     <head>
      <title>Ingreso de archivos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script type="text/javascript" src="src/assets/jquery-3.6.0.min.js"></script>
        <script defer type="text/javascript" src="src/assets/index.js"></script>

    </head>

     <body>
      <div class="content">
          <div class="row col-md-12">
              <h1>Bienvenido</h1>
              <div class="col-md-2  pull-right">
                  <button type="button" id="reiniciarBD" class="btn btn-danger">Reiniciar BD</button>
              </div>
          </div>
          <div class="row mt-10">
              <div class="col-md-1">
                  <label for="inputNombre">Nombre:</label>
              </div>
              <div class="col-md-3">
                  <input style="width: 100%" type="text" id="inputNombre" name="inputNombre">
              </div>
          </div>
          <div class="row mt-2">
              <div class="col-md-1">
                  <label for="inputRut">Rut:</label>
              </div>
              <div class="col-md-3">
                  <input type="number" id="inputRut" name="inputRut">
                  -
                  <input style="width: 69px" type="number" maxlength="1" id="inputDv" name="inputDv">
              </div>
          </div>
          <div class="row mt-2">
              <div class="col-md-1">
                  <label for="inputArchivo">Archivo:</label>
              </div>
              <div class="col-md-4">
                  <input style="width: 100%" type="file" id="inputArchivo" name="inputArchivo">
              </div>
          </div>
          <div class="row mt-2">
              <div class="col-md-1">
                  <label for="selectTipo">Tipo:</label>
              </div>
              <div class="col-md-3">
                  <select id="selectTipo" name="selectTipo">
                      <?php
                      foreach ($tipos as $tipo){
                          echo '<option value="'.$tipo['id'].'">'.$tipo['nombre'].'</option>';
                      }
                      ?>
                  </select>
              </div>
          </div>

          <p>A pesar de que no esta completo escribire las acciones a seguir para poder completar el proceso.
              - Primero asignar una funcion por javascript al boton Reiniciar BD, esto para poder resetear la base de datos de ser necesario.
              - Agregar validacion de digito verificador en el rut
              - En el submit del formulario, Primero se guarda el usuario en caso que no exista y si existe consultar informacion,
                en cualquiera de los dos casos guardar el id del usuario. Despues guardar el archivo que se subio con el id del usuario asociado y el id del tipo de archivo.
              - Al recargar la pagina generar la tabla rescatando los registros en la tabla archivos que estan asociados a usuario y tipo, de esta manera poder mostrar todos los archivos guardados.
          </p>
      </div>
    </body>
</html>