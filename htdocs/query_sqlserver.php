<?php

    $serverName = "localhost";
    $connectionOptions = array(

        "Database"  => "Northwind",
        "Uid"       => "headlight",
        "PWD"       => "PfpSSL5m9MUyWTzc"
    );

    //Establishes the connection
    try {

        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn) {

            echo "Connected!";
        }

    } catch(Exception $e) {   

      die( print_r( $e->getMessage() ) );   
    }
?>

<div class="container">

<?php

    print '<pre>' . print_r($result, true) . '</pre>';

?>

</div> <!-- container -->
