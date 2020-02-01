<?php 

    $links = array(

        array('description' => '$_SERVER[]', 'url' => 'server.php'),
        array('description' => 'phpinfo', 'url' => 'phpinfo.php'),
        array('description' => 'todolist', 'url' => './todolist/ '),

    );
?>

<!DOCTYPE html>
<html>
<head>
<title>Welcome to the MobileIQ Demo Grounds!</title>
<style>
    body {
        max-width: 960px;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<h1>Welcome to the MobileIQ Demo Grounds!</h1>
<?php 

    foreach ($links as $link) {

        print sprintf('<a href="%s">%s</a></br>', $link['url'], $link['description']);
    }

?>
</body>
</html>

