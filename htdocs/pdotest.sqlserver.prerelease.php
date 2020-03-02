<?php

    $server = 'prerelease.freeroutingsoftware.com';
    $username = getenv('SQL_USERNAME');
    $password = getenv('SQL_PASSWORD');

    $dsn = "sqlsrv:server=$server;Database=SE100001";
    $options = array(

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

	try {	

        $pdo = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT TOP 5 * FROM geocode_cache";
        $result = $pdo->query($sql)->fetchAll();

        print print_r($result, true);

	} catch(PDOException $error) {

		echo sprintf("%s   %s", $sql, $error->getMessage());
	}

    print "\n";
    print sprintf("server: %s\n", $server);
    print sprintf("username: %s\n", $username);
    print sprintf("password: %s\n", $password);
