<?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $name = '';
    $surn = '';
    $direc = '';
    $tele = '';
    $update = false;
    $Did  = 0;
   // debug_to_console($_GET["save"]);

    if(isset($_GET['save'])){
        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Dnom = $_REQUEST['inputNombre'];
        $Apellido = $_REQUEST['inputApellido'];
        $Direccion = $_REQUEST['inputDireccion'];
        $Telefono = $_REQUEST['inputTelefono'];
        $sql = "CALL INSERTAR_DISTRIBUIDOR('$Dnom','$Apellido','$Direccion','$Telefono')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Distribuidor.php');
    }
    
    if(isset($_GET['delete'])){
        $conexion = oci_connect("hr","hr","localhost/xe");
        $Did = $_REQUEST['delete'];
        $sql = "CALL ELIMINAR_DISTRIBUIDOR($Did)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Distribuidor.php');

    }

    if(isset($_GET['edit'])){
        $Did = $_REQUEST['edit'];
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT NOMBRE, APELLIDO, DIRECCION, TELEFONO FROM TBL_DISTRIBUIDOR WHERE ID_DISTRIBUIDOR='$Did' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'NOMBRE', $name);
        oci_define_by_name($stid1, 'APELLIDO', $surn);
        oci_define_by_name($stid1, 'DIRECCION', $direc);
        oci_define_by_name($stid1, 'TELENOFO', $tele);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $name = $row['NOMBRE'];
                    $surn = $row['APELLIDO'];
                    $direc = $row['DIRECCION'];
                    $tele = $row['TELEFONO'];
            }
    }

    if(isset($_GET['update'])){
        $Distri_id = $_REQUEST['id'];
        $Dnom = $_REQUEST['inputNombre'];
        $Apellido = $_REQUEST['inputApellido'];
        $Direccion = $_REQUEST['inputDireccion'];
        $Telefono = $_REQUEST['inputTelefono'];
        $conexion = oci_connect("hr","hr","localhost/xe");    
        $sql = "CALL ACTUALIZAR_DISTRIBUIDOR('$Distri_id','$Dnom','$Apellido','$Direccion','$Telefono')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Distribuidor.php');
    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>