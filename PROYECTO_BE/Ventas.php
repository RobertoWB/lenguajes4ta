    <meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $update = false;
    $Vid  = 0;
    $idFlor  = "";
    $idUsuario  = "";
    $Cliente  = "";
    $cantidad  = "";
    $fecha_Venta  = "";



    if(isset($_POST['save'])){
        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Vflor = $_REQUEST['inputFlor'];
        $Vusuario = $_REQUEST['inputUsuario'];
        $Vnombre_cliente = $_REQUEST['inputNombre'];
        $Vcantidad = $_REQUEST['inputCantidad'];
        $Vfecha_venta = $_REQUEST['inputFecha'];
        $newDate = date("d/m/y", strtotime($Vfecha_venta));
        $sql = "CALL PKG_VENTAS.INSERTAR_VENTAS('$Vflor','$Vusuario','$Vnombre_cliente','$Vcantidad','$newDate')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Ventas.php');
    }
    
    if(isset($_GET['delete'])){

        $conexion = oci_connect("hr","hr","localhost/xe");
        $Vid = $_REQUEST['delete'];
        $sql = "CALL PKG_VENTAS.ELIMINAR_VENTAS($Vid)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Ventas.php');

    }

    if(isset($_GET['edit'])){
        $Vid = $_REQUEST['edit'];
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT ID_FLOR, ID_USUARIO, NOMBRE_CLIENTE, CANTIDAD, FECHA_VENTA FROM TBL_VENTAS WHERE ID_VENTAS='$Vid' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'ID_FLOR', $idFlor);
        oci_define_by_name($stid1, 'ID_USUARIO', $idUsuario);
        oci_define_by_name($stid1, 'NOMBRE_CLIENTE', $Cliente);
        oci_define_by_name($stid1, 'CANTIDAD', $cantidad);
        oci_define_by_name($stid1, 'FECHA_VENTA', $fecha_Venta);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $idFlor = $row['ID_FLOR'];
                    $idUsuario = $row['ID_USUARIO'];
                    $Cliente = $row['NOMBRE_CLIENTE'];
                    $cantidad = $row['CANTIDAD'];
                    $fecha_Venta = date("Y-m-d",strtotime($row['FECHA_VENTA']));
            }
    }

    if(isset($_POST['update'])){

        $Vid = $_REQUEST['id'];
        $Vflor = $_REQUEST['inputFlor'];
        $Vusuario = $_REQUEST['inputUsuario'];
        $Vnombre_cliente = $_REQUEST['inputNombre'];
        $Vcantidad = $_REQUEST['inputCantidad'];
        $Vfecha_venta = $_REQUEST['inputFecha'];
        $newDate = date("d/m/y", strtotime($Vfecha_venta));
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL PKG_VENTAS.ACTUALIZAR_VENTAS('$Vid','$Vflor','$Vusuario','$Vnombre_cliente','$Vcantidad','$newDate')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Ventas.php');

    }







    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>