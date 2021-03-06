<?php
require "config.php";
require "./common.php";
?>
<?php
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);
           
            $id = escape($_GET['id']);

            $sql = "DELETE FROM tasks WHERE id = :id";
        
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            header ("location: /demos/todolist/index.php");
      
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      } 
?>