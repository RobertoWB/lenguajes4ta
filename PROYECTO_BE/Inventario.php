<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $update = false;
    $Iid  = 0;
    $idFlor  = "";
    $VidaUtil  = "";
    $canti  = "";
    $corte_fecha  = "";
    $Status  = "";


    if(isset($_POST['save'])){

        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Iflor = $_REQUEST['input_IdFlor'];
        $Ivida_util = $_REQUEST['input_VidaUtil'];
        $ICantidad = $_REQUEST['input_CantidadRollos'];
        $Ifecha_corte = $_REQUEST['input_FechaCorte'];
        $newDate = date("d/m/y", strtotime($Ifecha_corte));
        //debug_to_console($newDate);
        $Iestado = $_REQUEST['input_Estado'];
        $sql = "CALL INSERTAR_INVENTARIO('$Iflor','$Ivida_util','$ICantidad','$newDate','$Iestado')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Inventario.php');
    }

    if(isset($_GET['delete'])){
        $conexion = oci_connect("hr","hr","localhost/xe");
        $Iid = $_REQUEST['delete'];
        $sql = "CALL ELIMINAR_INVENTARIO($Iid)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Inventario.php');
    }

    if(isset($_GET['edit'])){
        $Iid = $_REQUEST['edit'];
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT ID_FLOR, VIDA_UTIL, CANTIDAD_ROLLOS, FECHA_CORTE, ESTADO FROM TBL_INVENTARIOS WHERE ID_INVENTARIO='$Iid' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'ID_FLOR', $idFlor);
        oci_define_by_name($stid1, 'VIDA_UTIL', $VidaUtil);
        oci_define_by_name($stid1, 'CANTIDAD_ROLLOS', $canti);
        oci_define_by_name($stid1, 'FECHA_CORTE', $corte_fecha);
        oci_define_by_name($stid1, 'ESTADO', $Status);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $idFlor = $row['ID_FLOR'];
                    $VidaUtil = $row['VIDA_UTIL'];
                    $canti = $row['CANTIDAD_ROLLOS'];
                    //$corte_fecha = '2017-06-01';
                    $corte_fecha = date("Y-m-d",strtotime($row['FECHA_CORTE']));
                    $Status =$row['ESTADO'];
            }
    }
    if(isset($_POST['update'])){
        debug_to_console( 'dentro');
        $Iid = $_REQUEST['id'];
        $Iflor = $_REQUEST['input_IdFlor'];
        $Ivida_util = $_REQUEST['input_VidaUtil'];
        $ICantidad = $_REQUEST['input_CantidadRollos'];
        $Ifecha_corte = $_REQUEST['input_FechaCorte'];
        $newDate = date("d/m/y", strtotime($Ifecha_corte));
        $Iestado = $_REQUEST['input_Estado'];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_INVENTARIO('$Iid','$Iflor','$Ivida_util','$ICantidad','$newDate','$Iestado')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Inventario.php');


    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>