<?php

    $server = getenv('SQL_SERVER');

    $connectionOptions = array(

        "Database"  => "Northwind",
        "Uid"       => getenv('SQL_USERNAME'),
        "PWD"       => getenv('SQL_PASSWORD')
    );

    //Establishes the connection
    try {

        // $conn = sqlsrv_connect($server, $connectionOptions);
        $conn = sqlsrv_connect(getenv('SQL_SERVER'), $connectionOptions);
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
