<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php
    //crear conexion con oracle
    $conexion = oci_connect("hr","hr","localhost/xe");

    $fun = $_GET['id'];
    debug_to_console($fun);
    if(!$conexion){
        $m = oci_error();
        echo $m('message'),"n";
        exit;
    }else{
        //echo "Conexion con exito a Oracle";
        switch($fun){
            case 0:
            listar_rol();
            break;
    
            case 1:
            agregar_rol();
        
            break;

            case 2:
            actualizar_rol();
            break;
    
            case 3:
            eliminar_rol();
            break;
        }
    }

    /* Me gusta como se ve, pero solo me devuelve un 1, Este es de un stored procedure
    $sql = "CALL PRUEBA()";
    $stid = oci_parse($conexion,$sql);

    if (!$stid){
        $e = oci_error($conexion);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }   

    $res = oci_execute($stid);
    
    print "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
    }
    print "</table>\n";
    */
    function agregar_rol(){
    $Rid = $_GET['id_rol'];
    $Rnom = $_GET['nom_rol'];
    $sql = "CALL INSERTAR_ROL($Rid,'$Rnom')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function listar_rol(){
        $conexion = oci_connect("hr","hr","localhost/xe");
    $sql = "SELECT * FROM TBL_ROLES";
    $stid =oci_parse($conexion,$sql);
    $res = oci_execute($stid);

    print "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
    }
    print "</table>\n";
    }

    function actualizar_rol(){
    $sql = "CALL PRUEBA2(2,4,'PRUEBA')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
    oci_free_statement($stid);
    oci_close($conexion);
    //header('location: ../PROYECTO_FE/index.html');
    }

    function eliminar_rol(){
    $sql = "CALL ELIMINAR_ROL(4)";
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


?>


