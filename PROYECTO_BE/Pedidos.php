<meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $update = false;
    $Pid  = 0;
    $idFlor  = "";
    $fechaEntrega  = "";
    $cantidad  = "";
    $fechaPedido  = "";

 
    if(isset($_POST['save'])){
        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Pflor = $_REQUEST['input_IdFlor'];
        $PCantidad = $_REQUEST['input_CantidadRollos'];
        $Pfecha_entrega = $_REQUEST['input_FechaEntrega'];
        $newDate = date("d/m/y", strtotime($Pfecha_entrega));
        $Pfecha_pedido = $_REQUEST['input_FechaPedido'];
        $newDate2 = date("d/m/y", strtotime($Pfecha_pedido));
        $sql = "CALL PKG_PEDIDOS.INSERTAR_PEDIDOS('$Pflor','$PCantidad','$newDate','$newDate2')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Pedidos.php');

    }
    
    if(isset($_GET['delete'])){
        $conexion = oci_connect("hr","hr","localhost/xe");
        $Pid = $_REQUEST['delete'];
        $sql = "CALL PKG_PEDIDOS.ELIMINAR_PEDIDOS($Pid)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Pedidos.php');
    }

    if(isset($_GET['edit'])){
        $Pid = $_REQUEST['edit'];
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT ID_FLOR, CANTIDAD, FECHA_ENTREGA, FECHA_PEDIDO FROM TBL_PEDIDOS WHERE ID_PEDIDO='$Pid' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'ID_FLOR', $idFlor);
        oci_define_by_name($stid1, 'CANTIDAD', $cantidad);
        oci_define_by_name($stid1, 'FECHA_ENTREGA', $fechaEntrega);
        oci_define_by_name($stid1, 'FECHA_PEDIDO', $fechaPedido);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $idFlor = $row['ID_FLOR'];
                    $fechaEntrega =  date("Y-m-d",strtotime($row['FECHA_ENTREGA']));
                    $cantidad = $row['CANTIDAD'];
                    $fechaPedido = date("Y-m-d",strtotime($row['FECHA_PEDIDO']));
            }
    }
    if(isset($_POST['update'])){
        $Pid = $_REQUEST['id'];
        $Pflor = $_REQUEST['input_IdFlor'];
        $PCantidad = $_REQUEST['input_CantidadRollos'];
        $Pfecha_entrega = $_REQUEST['input_FechaEntrega'];
        $newDate = date("d/m/y", strtotime($Pfecha_entrega));
        $Pfecha_pedido = $_REQUEST['input_FechaPedido'];
        $newDate2 = date("d/m/y", strtotime($Pfecha_pedido));
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL PKG_PEDIDOS.ACTUALIZAR_PEDIDOS('$Pid','$Pflor','$PCantidad','$newDate','$newDate2')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Pedidos.php');

    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }


    oci_close($conexion);

    ?>