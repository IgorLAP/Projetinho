<!DOCTYPE html>
<html>
<head>
    <title> Projetinho </title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once 'process.php'; ?>
    <?php

    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        //pre_r($result->fetch_assoc());

        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th> Nome </th>
                        <th> Localização </th>
                        <th colspan="2"> Ação </th>
                    </tr>
                <thead>
        <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-warning"> Editar </a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger"> Deletar </a>
                    </td>
                </tr>
        <?php endwhile; ?>
            </table>        
        </div>

        <?php
        
        function pre_r( $array ){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>

    <div class="row justify-content-center">
    <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"
        <div class="form-group">
        <label> Nome: </label>
        <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
        <label> Localização: </label>
        <input class="form-control" type="text" name="location" value="<?php echo $location; ?>" placeholder="Digite sua localização">
        </div>
        <div class="form-group">
        <?php 
            if ($update == true):
        ?>
            <button class="btn btn-info" type="submit" name="update"> Atualizar </button>
        <?php  else: ?>
            <button class="btn btn-primary" type="submit" name="enviar"> Enviar </button>
        <?php endif; ?>
        <div>
    </form>
    </div>
    </div>
</body>
</html>