<?php

    $result = array();
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

            /* Set up and execute the query. */
            $sql = "SELECT * from customers";
            $stmt = sqlsrv_query( $conn, $sql);
            if( $stmt === false)
            {
                echo "Error in query preparation/execution.\n";
                die( print_r( sqlsrv_errors(), true));
            }

            /* Retrieve each row as an associative array and display the results.*/
            while(  $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
            {
                $result[] = $row;
            }

            /* Free statement and connection resources. */
            sqlsrv_free_stmt( $stmt);
            sqlsrv_close( $conn);

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
