<?php

    $server = "localhost";
    $database = "Northwind";
    $dsn = "sqlsrv:server=$server;Database=$database";

    $username = "headlight";
    $password = "PfpSSL5m9MUyWTzc";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	try {	

        $connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM customers";
		$statement = $connection->prepare($sql);
		$statement->execute();

        $result = $statement->fetchAll();	

	} catch(PDOException $error) {

		echo $sql . "<br>" . $error->getMessage();
	}

?>

<div class="container">

    <?php print '<pre>' . print_r($result, true) . '</pre>'; ?>

</div>
