<?php

    $server = getenv('SQL_SERVER');
    $username = getenv('SQL_USERNAME');
    $password = getenv('SQL_PASSWORD');

    $dsn = "sqlsrv:server=$server;database=SE100001";
    $options = array(

        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    // sample data to populate geocode_cache
    $records = array(

        array('id' => '1367[B]', 'address' => '14 WINCHESTER ST, MONROE, MI, 48161', 'hash_address' => '1997394a5be66bb73d4b2c8609cc5d81'),
        array('id' => '1005[A]', 'address' => 'PO BOX 853, ERIE, MI',                'hash_address' => 'b068f85480bd256c08d8a1007683101c'),
        array('id' => '1420[A]', 'address' => 'PO BOX 906, MONROE, MI, 48161',       'hash_address' => 'be902d3634f75ed5f528ad3ef2cabf4a'),
        array('id' => '1420[B]', 'address' => 'PO BOX 906, MONROE, MI, 48161',       'hash_address' => 'be902d3634f75ed5f528ad3ef2cabf4a'),
        array('id' => '1369',    'address' => '9 S MONROE ST, MONROE, MI, 48161',    'hash_address' => '01160602985cf6d8bda5b9a994b153e1'),
    );

	try {	

        $pdo = new PDO($dsn, $username, $password, $options);

        $sql = "DELETE FROM geocode_cache";
        $pdo->prepare($sql)->execute();

        foreach ($records as $record) {
            $sql = "INSERT INTO geocode_cache (id, address, hash_address) VALUES (?,?,?)";
            $pdo->prepare($sql)->execute(array($record['id'], $record['address'], $record['hash_address']));
        }

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
