<?php

    $server = getenv('SQL_SERVER');
    $username = getenv('SQL_USERNAME');
    $password = getenv('SQL_PASSWORD');

    $dsn = "sqlsrv:server=$server;Database=Northwind";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	try {	

        $pdo = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT TOP 5 * FROM customers";
		$statement = $pdo->prepare($sql);
		$statement->execute();

        $result = $statement->fetchAll();
        print print_r($result, true);

	} catch(PDOException $error) {

		echo sprintf("%s   %s", $sql, $error->getMessage());
	}

    print "\n";
    print sprintf("server: %s\n", $server);
    print sprintf("username: %s\n", $username);
    print sprintf("password: %s\n", $password);
