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
            agregar_usuario(); 
            break;

            case 1:
            actualizar_usuario();
            break;
    
            case 2:
            eliminar_usuario();
            break;
        }
    }

    function agregar_usuario(){
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $Urol = $_GET[''];
    $Unom = $_GET[''];
    $Uapellido = $_GET[''];
    $Unick = $_GET[''];
    $Upass = $_GET[''];
    $sql = "CALL INSERTAR_USUARIO('$Urol','$Unom','$Uapellido','$Unick','$Upass')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/Listar_Usuarios.php');
    }


    function actualizar_usuario(){
        $Uid = $_GET[''];
        $Urol = $_GET[''];
        $Unom = $_GET[''];
        $Uapellido = $_GET[''];
        $Unick = $_GET[''];
        $Upass = $_GET[''];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_USUARIO('$Uid','$Urol','$Unom','$Uapellido','$Unick','$Upass')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_usuario(){
    $conexion = oci_connect("hr","hr","localhost/xe");
    //Id del usuario
    $Uid = $_GET[''];
    $sql = "CALL ELIMINAR_FLORES($Uid)";
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