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
            agregar_inventario(); 
            break;

            case 1:
            actualizar_inventario();
            break;
    
            case 2:
            eliminar_inventario();
            break;
        }
    }

    function agregar_inventario(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Iflor = $_GET[''];
    $Ivida_util = $_GET[''];
    $ICantidad = $_GET[''];
    $Ifecha_corte = $_GET[''];
    $Iestado = $_GET[''];
    $sql = "CALL INSERTAR_INVENTARIO('$Iflor','$Ivida_utiL','$ICantidad','$Ifecha_corte','$Iestado')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Inventario.php');
    }


    function actualizar_inventario(){
        $Iid = $_GET[''];
        $Iflor = $_GET[''];
        $Ivida_util = $_GET[''];
        $ICantidad = $_GET[''];
        $Ifecha_corte = $_GET[''];
        $Iestado = $_GET[''];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_INVENTARIO('$Iid','$Iflor','$Ivida_utiL','$ICantidad','$Ifecha_corte','$Iestado')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_inventario(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    //Id del inventario
    $Iid = $_GET[''];
    $sql = "CALL ELIMINAR_INVENTARIO($Iid)";
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