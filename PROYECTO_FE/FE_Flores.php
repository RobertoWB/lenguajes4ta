<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>Jumbotron Template · Bootstrap</title>
  
      <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/jumbotron/">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" href="../CSS/custom.css">
      <!-- Bootstrap core CSS -->
  <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
      <!-- Custom styles for this template -->
      <link href="jumbotron.css" rel="stylesheet">
    </head>
    <body>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
      <!-- 
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
       -->
    </div>
  </nav>
  <?php require_once '../PROYECTO_BE/Flores.php' ?>
  <main role="main">
  <form action="../PROYECTO_BE/Flores.php">
    <div class="jumbotron">

        <div class='container'>
                <h2 class='text-center'>Lista de Flores</h2>
                <?php 
              $conexion = oci_connect("hr","hr","localhost/xe");
              $sql = "SELECT * FROM TBL_FLORES order by ID_FLOR";
              $stid =oci_parse($conexion,$sql);
              $res = oci_execute($stid);

              print "<div class='container'>";
              print "<table class='table table-hover' >\n";
              print "<tr>\n";
              print "<thead>";
              print "<th>ID</th>";
              print "<th>NOMBRE</th>";
              print "<th>Tipo</th>";
              print "<th>Detalle</th>";
              print "<th>Accion</th>";
              print "</thead>";
              while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
              foreach ($row as $item) {
                  print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";

              }
              ?>
             <td><a href="../PROYECTO_BE/Flores.php?delete=<?php echo $row['ID_FLOR']; ?>" class='btn btn-danger' >Eliminar</a>
                <a href="FE_Flores.php?edit=<?php echo $row['ID_FLOR']; ?>"class='btn btn-warning'>Actualizar</a></td>

              <?php
              print "</tr>\n";
              }
              print "</table>\n";
              print "</div>";
              oci_free_statement($stid);
              oci_close($conexion);


        ?>  
                     
        <form action="../PROYECTO_BE/Flores.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $Fid ; ?>">
        <div class="jumbotron">
            <div class='container'>
                    <h2 class='text-center'>Agregar Flor</h2>
                    <label class='col-sm-3 control-label'>Nombre de la flor</label>
                    <div class='form-group'>
                        <input type='text' class='form-control'  value="<?php echo $name; ?>"  id='nom_flor' name='nom_flor'>
                    </div>
                    <label class='col-sm-3 control-label'>Tipo de flor</label>
                    <div class='form-group'>
                        <input type='text' class='form-control'  value="<?php echo $tipo; ?>" id='tipo_flor' name='tipo_flor'>
                    </div>
                    <label class='col-sm-3 control-label'>Detalles</label>
                    <div class='form-group'>
                        <input type='text' class='form-control'  value="<?php echo $detalle; ?>"  id='detalles' name='detalles'>
                    </div>
                    <?php 
                      if($update == true):
                    ?>
                    <button class='btn btn-primary btn-block' type="submit" value="2" name='update'>Actualizar</button>
                      <?php else: ?>
                    <button class='btn btn-primary btn-block' type="submit" value="1" name='save'>Ingresar</button>
                      <?php endif; ?>                    
            </div>  
        </div>  
      </form>
      
    </div>  
  </form>
  </main>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
  </html>