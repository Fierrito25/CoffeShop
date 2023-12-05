<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id_transaccion = isset($_GET['key']) ? $_GET['key'] : 0;

$error = "";
if($id_transaccion == ''){
    $error = 'Error al procesar la petición';
}else{
    $sql = $con->prepare("SELECT count(id) FROM compras WHERE id_transaccion=? AND status=?");
        $sql->execute([$id_transaccion,'COMPLETED']);
        if($sql->fetchColumn() > 0){
            $sql = $con->prepare("SELECT id, fecha, email, total FROM compras WHERE id_transaccion=? AND status=?");
            $sql->execute([$id_transaccion,'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $idCompra = $row['id'];
            $total = $row['total'];
            $fecha = $row['fecha'];

            $sqlDet = $con->prepare("SELECT nombre, precio, cantidad FROM detalle_compra WHERE id_compra=?");
            $sqlDet->execute([$idCompra]);
        } else{
            $error = 'Error al comprobar compra';
        }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coffe Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">

  </head>
  <body>
    <?php include 'menu.php'; ?>
    <main>
        <div class="container">
            <?php  if(strlen($error) > 0) { ?>
                <div class="row">
                    <div class="col">
                        <h3><?php echo $error; ?></h3>
                    </div>
                </div>
            <?php } else { ?>

            <div class="row">
                <div class="col">
                    <b>Purchase folio: </b> <?php echo $id_transaccion; ?><br>
                    <b>Purchase date: </b> <?php echo $fecha; ?><br>
                    <b>Total: </b> <?php echo MONEDA . number_format($total,2,'.',','); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Product</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)){ 
                                  $importe = $row_det['precio'] * $row_det['cantidad']; ?>
                                <tr>
                                    <td><?php echo $row_det['cantidad']; ?></td>
                                    <td><?php echo $row_det['nombre']; ?></td>
                                    <td><?php echo MONEDA . $importe ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>

            <a href="index.php" class="btn btn-primary">Exit shopping</a>
        </div>
    </main>
</body>
</html>