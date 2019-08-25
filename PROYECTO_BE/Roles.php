<?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $name = '';
    $update = false;
    $Rid  = 0;
   // debug_to_console($_GET["save"]);


    if(isset($_POST['save'])){
        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Rnom = $_REQUEST['nom_rol'];
        $sql = "CALL PKG_ROLES.INSERTAR_ROL('$Rnom')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Roles.php');

    }
    
    if(isset($_GET['delete'])){
        $conexion = oci_connect("hr","hr","localhost/xe");
        $Rid = $_REQUEST['delete'];
        $sql = "CALL PKG_ROLES.ELIMINAR_ROL($Rid)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Roles.php');
    }

    if(isset($_GET['edit'])){
        $Rid = $_REQUEST['edit'];
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT NOMBRE FROM TBL_ROLES WHERE ID_ROL='$Rid' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'NOMBRE', $name);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $name = $row['NOMBRE'];
            }
    }
    if(isset($_POST['update'])){
        $rol_id = $_REQUEST['id'];
        $Rnom = $_REQUEST['nom_rol']; 
        debug_to_console($_REQUEST['nom_rol']);
        $sql = "CALL PKG_ROLES.ACTUALIZAR_ROL('$rol_id','$Rnom')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Roles.php');
    }


    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>