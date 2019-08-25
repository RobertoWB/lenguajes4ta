<DOCTYPE HTML>
    <meta charset = "utf8"/>
    <?php
    //crear conexion con oracle
    $conexion = oci_connect("hr","hr","localhost/xe");

    debug_to_console($fun);
    if(!$conexion){
        $m = oci_error();
        echo $m('message'),"n";
        exit;
    }else{
        echo "Conexion con exito a Oracle";
    }

    

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }


?>


