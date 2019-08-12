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
            agregar_pedido(); 
            break;

            case 1:
            actualizar_pedido();
            break;
    
            case 2:
            eliminar_pedido();
            break;
        }
    }

    function agregar_pedido(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Pflor = $_GET[''];
    $PCantidad = $_GET[''];
    $Pfecha_entrega = $_GET[''];
    $Pfecha_pedido = $_GET[''];
    $sql = "CALL INSERTAR_PEDIDOS('$Pflor','$Pcantidad','$Pfecha_entrega','$Pfecha_pedido')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Inventario.php');
    }


    function actualizar_pedido(){
        $Pid = $_GET[''];
        $Pflor = $_GET[''];
        $PCantidad = $_GET[''];
        $Pfecha_entrega = $_GET[''];
        $Pfecha_pedido = $_GET[''];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_PEDIDOS('$Pid','$Pflor','$Pcantidad','$Pfecha_entrega','$Pfecha_pedido')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_pedido(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    //Id del inventario
    $Pid = $_GET[''];
    $sql = "CALL ELIMINAR_PEDIDOS($Pid)";
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