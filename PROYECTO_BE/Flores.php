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
            //debug_to_console($fun);
            listar_flor();
            break;

            case 1:
            agregar_flor(); 
            break;

            case 2:
            actualizar_flor();
            break;
    
            case 3:
            eliminar_rol();
            break;
        }
    }

    function agregar_flor(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Fnom = $_GET['nom_flor'];
    $Ftipo = $_GET['tipo_flor'];
    $Fdetalle = $_GET['detalles'];
    $sql = "CALL INSERTAR_FLORES('$Fnom','$Ftipo','$Fdetalle')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Flores.php');
    }


    function actualizar_flor(){
    $Fid = $_GET['id_flor'];
    $Fnom = $_GET['nom_flor'];
    $Ftipo = $_GET['tipo_flor'];
    $Fdetalle = $_GET['detalles'];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_FLORES('$Fid','$Fnom','$Ftipo','$Fdetalle')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_flor(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    $Fid = $_GET['id_flor'];
    $sql = "CALL ELIMINAR_FLORES($Fid)";
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