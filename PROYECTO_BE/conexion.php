<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php
    //crear conexion con oracle
    $conexion = oci_connect("hr","hr","localhost/xe");

    if(!$conexion){
        $m = oci_error();
        echo $m('message'),"n";
        exit;
    }else{
        echo "Conexion con exito a Oracle";
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


    /* funciona, Stored procedure de insertar
    $sql = "CALL INSERTAR_ROL(3,'paco')";
    $stid = oci_parse($conexion,$sql);
    oci_execute($stid);
*/
    /*
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
    */

/* update con stored procedure
$sql = "CALL PRUEBA2(2,4,'PRUEBA')";
$stid = oci_parse($conexion,$sql);
oci_execute($stid);
*/

/*  ELIMINAR ROL CON STORED PROCEDURE
$sql = "CALL ELIMINAR_ROL(4)";
$stid = oci_parse($conexion,$sql);
oci_execute($stid);

/*

oci_free_statement($stid);
oci_close($conexion);

?>


