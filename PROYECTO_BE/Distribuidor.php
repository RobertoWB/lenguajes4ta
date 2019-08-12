<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $fun = $_GET['id'];

    if(!$conexion){
        $m = oci_error();
        echo $m('message'),"n";
        exit;
    }else{
        //echo "Conexion con exito a Oracle";
        switch($fun){
            case 0:
            agregar_distribuidor(); 
            break;

            case 1:
            actualizar_distribuidor();
            break;
    
            case 2:
            eliminar_distribuidor();
            break;
        }
    }

    function agregar_distribuidor(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Dnom = $_GET['inputNombre'];
    $Apellido = $_GET['inputApellido'];
    $Direccion = $_GET['inputDireccion'];
    $Telefono = $_GET['inputTelefono'];
    $sql = "CALL INSERTAR_DISTRIBUIDOR('$Dnom','$Apellido','$Direccion','$Telefono')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Distribuidor.php');
    }


    function actualizar_distribuidor(){
    $Did = $_GET['id_Distribuidor'];
    $Dnom = $_GET['inputNombre'];
    $Apellido = $_GET['inputApellido'];
    $Direccion = $_GET['inputDireccion'];
    $Telefono = $_GET['inputTelefono'];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_DISTRIBUIDOR('$Did','$Dnom','$Apellido','$Direccion','$Telefono')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_distribuidor(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    $Did = $_GET['id_Distribuidor'];
    $sql = "CALL ELIMINAR_DISTRIBUIDOR($Did)";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }


    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>