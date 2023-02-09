<?php
//* CÓDIGO PARA VER PRODUCTOS 
require 'Lib/Connection/database.php';

$db = new DB();
$con = $db->connect();

// No trae a la descripcion porque esa se llamará en los detalles del producto 
$sql = $con->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE categoria='alitas'");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC); // Llama a todos los productos que estén en está tabla
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bistro Online | Alitas</title>
</head>

<body>
    <?php
    include_once('Templates/menu.php');
    ?>

    <main>

        <!-- CATALOGOS DE PRODUCTOS  -->
        <h2>Alitas</h2>
        <div>
            <?php
            foreach ($resultado as $row) {
            ?>
                <div>
                    <input type="hidden" id="id" value="<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['imagen'] ?>">
                    <h3><?php echo $row['nombre']; ?></h3>
                    <p><?php echo $row['descripcion'] ?></p>
                    <span>$<?php echo $row['precio']; ?> MXN</span>
                    <br>
                    <button>Comprar ahora</button>
                </div>
            <?php
            }
            ?>
        </div>
    </main>

    <?php include_once('Templates/footer.php'); ?>
    <script src="Assets/JS/main.js"></script>

</body>

</html>