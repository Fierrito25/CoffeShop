<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$idCliente = $_SESSION['user_cliente'];
$sql = $con->prepare("SELECT id_transaccion, fecha, status, total FROM  compras WHERE id_cliente = ? ORDER BY DATE(fecha) DESC");
$sql->execute([$idCliente]);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffe Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">

  </head>
  <body>
    <?php include 'menu.php'; ?>
    <!-- Contenido -->
    <main class="m-auto pt-4" >
        <div class="container">
            <h4>My Sopping</h4>
            <hr>
            <?php while($row = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="card mb-3 border-primary">
                <div class="card-header">
                    <?php echo $row['fecha']; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Folio: <?php echo $row['id_transaccion']; ?></h5>
                    <p class="card-text">Total: <?php echo $row['total']; ?></p>
                    <a href="#" class="btn btn-primary">See purchase</a>
                </div>
                </div>
                <?php } ?>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
  </body>
</html>