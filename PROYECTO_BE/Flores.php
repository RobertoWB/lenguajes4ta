<?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $name = '';
    $tipo = '';
    $detalle = '';
    $update = false;
    $Fid  = 0;

if(isset($_GET['save'])){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Fnom = $_REQUEST['nom_flor'];
    $Ftipo = $_REQUEST['tipo_flor'];
    $Fdetalle = $_REQUEST['detalles'];
    $sql = "CALL INSERTAR_FLORES('$Fnom','$Ftipo','$Fdetalle')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Flores.php');

}

if(isset($_GET['delete'])){
    $conexion = oci_connect("hr","hr","localhost/xe");
    $Fid = $_REQUEST['delete'];
    $sql = "CALL ELIMINAR_FLORES($Fid)";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Flores.php');

}

if(isset($_GET['edit'])){
    $Fid = $_REQUEST['edit'];
    $update = true;
    $conexion = oci_connect("hr","hr","localhost/xe"); 
    $sql1 = "SELECT NOMBRE, TIPO, DETALLE FROM TBL_FLORES WHERE ID_FLOR='$Fid' ";  
    $stid1 = oci_parse($conexion,$sql1);
    oci_define_by_name($stid1, 'NOMBRE', $name);
    oci_define_by_name($stid1, 'TIPO', $tipo);
    oci_define_by_name($stid1, 'DETALLE', $detalle);
    oci_execute($stid1);
        if(count($stid1)==1){
            $row = oci_fetch_array($stid1, OCI_ASSOC);
                $name = $row['NOMBRE'];
                $tipo = $row['TIPO'];
                $detalle = $row['DETALLE'];
        }
}

if(isset($_GET['update'])){
    debug_to_console("update");
    $Flor_id = $_REQUEST['id'];
    $Fnom = $_REQUEST['nom_flor'];
    $Ftipo = $_REQUEST['tipo_flor'];
    $Fdetalle = $_REQUEST['detalles'];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_FLORES('$Flor_id','$Fnom','$Ftipo','$Fdetalle')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Flores.php');
}
    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>