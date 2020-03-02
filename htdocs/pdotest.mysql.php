<?php

    $server = getenv('MYSQL_SERVER');
    $username = getenv('MYSQL_USERNAME');
    $password = getenv('MYSQL_PASSWORD');

    $database = 'headlight';
    $charset = 'utf8mb4';

    $dsn = sprintf("mysql:host=%s;dbname=%s;charset=%s", $server, $database, $charset);
    $options = array(

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

	try {	

        $pdo = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * FROM users";
		$result = $pdo->query($sql)->fetchAll();

        print print_r($result, true);

	} catch(PDOException $error) {

		echo sprintf("%s   %s", $sql, $error->getMessage());
	}

    print "\n";
    print sprintf("server: %s\n", $server);
    print sprintf("username: %s\n", $username);
    print sprintf("password: %s\n", $password);
