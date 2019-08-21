<meta charset = "utf8"/>
    <?php

    $conexion = oci_connect("hr","hr","localhost/xe");
    $rol = '';
    $name = '';
    $ape = '';
    $nick = '';
    $pass = '';
    $update = false;
    $Uid  = 0;

    if(isset($_GET['save'])){

        $conexion = oci_connect("hr","hr","localhost/xe");    
        $Urol = $_REQUEST['id_rol'];
        $Unom = $_REQUEST['nombre'];
        $Uapellido = $_REQUEST['apellido'];
        $Unick = $_REQUEST['nick'];
        $Upass = $_REQUEST['pass'];
        $sql = "CALL INSERTAR_USUARIO('$Urol','$Unom','$Uapellido','$Unick','$Upass')";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Usuarios.php');


    }
    
    if(isset($_GET['delete'])){
        $conexion = oci_connect("hr","hr","localhost/xe");
        $Uid = $_REQUEST['delete'];
        $sql = "CALL ELIMINAR_USUARIO($Uid)";
        $stid = oci_parse($conexion,$sql);
        oci_execute($stid);
        oci_free_statement($stid);
        oci_close($conexion);
        header('location: ../PROYECTO_FE/FE_Usuarios.php');

    }

    if(isset($_GET['edit'])){
        $Uid = $_REQUEST['edit'];
        debug_to_console( $Uid );
        $update = true;
        $conexion = oci_connect("hr","hr","localhost/xe"); 
        $sql1 = "SELECT ID_ROL, NOMBRE, APELLIDO, NOMBRE_USUARIO, PASS FROM TBL_USUARIOS WHERE ID_USUARIO='$Uid' ";  
        $stid1 = oci_parse($conexion,$sql1);
        oci_define_by_name($stid1, 'ID_ROL', $rol);
        oci_define_by_name($stid1, 'NOMBRE', $name);
        oci_define_by_name($stid1, 'APELLIDO', $ape);
        oci_define_by_name($stid1, 'NOMBRE_USUARIO', $nick);
        oci_define_by_name($stid1, 'PASS', $pass);
        oci_execute($stid1);
            if(count($stid1)==1){
                $row = oci_fetch_array($stid1, OCI_ASSOC);
                    $rol = $row['ID_ROL'];
                    $name = $row['NOMBRE'];
                    $ape = $row['APELLIDO'];
                    $nick = $row['NOMBRE_USUARIO'];
                    $pass = $row['PASS'];
            }
    }

    if(isset($_GET['update'])){

        $Uid = $_REQUEST['id'];
        $Urol = $_REQUEST['id_rol'];
        $Unom = $_REQUEST['nombre'];
        $Uapellido = $_REQUEST['apellido'];
        $Unick = $_REQUEST['nick'];
        $Upass = $_REQUEST['pass'];
    $conexion = oci_connect("hr","hr","localhost/xe");    
    $sql = "CALL ACTUALIZAR_USUARIO('$Uid','$Urol','$Unom','$Uapellido','$Unick','$Upass')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    header('location: ../PROYECTO_FE/FE_Usuarios.php');

    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        
    }

    oci_close($conexion);

    ?>