<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    //Aqui se obtiene el id para que se meta en el switch
    $fun = $_GET['id'];

    if(!$conexion){
        $m = oci_error();
        echo $m('message'),"n";
        exit;
    }else{
        //echo "Conexion con exito a Oracle";
        switch($fun){
            case 0:
            agregar_venta(); 
            break;

            case 1:
            actualizar_venta();
            break;
    
            case 2:
            eliminar_venta();
            break;
        }
    }

    function agregar_venta(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Vflor = $_GET[''];
    $Vusuario = $_GET[''];
    $Vnombre_cliente = $_GET[''];
    $Vcantidad = $_GET[''];
    $Vfecha_venta = $_GET[''];
    $sql = "CALL INSERTAR_VENTAS('$Vflor','$Vusuario','$Vnombre_cliente','$Vcantidad','$Vfecha_venta')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Inventario.php');
    }


    function actualizar_venta(){
        $Vid = $_GET[''];
        $Vflor = $_GET[''];
        $Vusuario = $_GET[''];
        $Vnombre_cliente = $_GET[''];
        $Vcantidad = $_GET[''];
        $Vfecha_venta = $_GET[''];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_VENTAS('$Vid','$Vflor','$Vusuario','$Vnombre_cliente','$Vcantidad','$Vfecha_venta')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_venta(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    //Id del inventario
    $Vid = $_GET[''];
    $sql = "CALL ELIMINAR_VENTAS($Vid)";
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