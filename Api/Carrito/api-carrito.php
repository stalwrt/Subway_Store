<?php

include_once 'carrito.php';

if (isset($_GET['action'])) {
    $acccion = $_GET['action'];
    $carrito = new Carrito();

    switch ($acccion) { //+ mostrar, add, remove
        case 'mostrar':
            mostrar($carrito);
            break;

        case 'add':
            add($carrito);
            break;

        case 'remove':
            remove($carrito);
            break;

        default:
    }
} else {
    echo json_encode([
        'statuscode' => 404,
        'response' => 'No se puede procesar la solicitud'
    ]);
}

function mostrar($carrito)
{
    //+ cargar el arreglo en la sesión
    //+ consultar la base de datos para actualizar los valores de los productos

    $itemsCarrito = json_decode($carrito->load(), 1);
    $fullItems = [];
    $total = 0;
    $totalItems = 0;

    foreach ($itemsCarrito as $itemCarrito) {
        $httpRequest = file_get_contents('http://localhost/burger_shop/api/productos/api-producto.php?get-item=' . $itemCarrito['id']);
        $itemProducto = json_decode($httpRequest, 1)['item'];
        $itemProducto['cantidad'] = $itemCarrito['cantidad'];
        $itemProducto['subtotal'] = $itemProducto['cantidad'] * $itemProducto['precio'];

        $total += $itemProducto['subtotal'];
        $totalItems += $itemProducto['cantidad'];

        array_push($fullItems, $itemProducto);
    }
    $resArray = array('info' => ['count' => $totalItems, 'total' => $total], 'item' => $fullItems);

    echo json_encode($resArray);
}

function add($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->add($_GET['id']);
        echo $res;
    } else {
        // error
        echo json_encode([
            'statuscode' => 404,
            'response' => 'No se puede procesar la solicitud, id vacio'
        ]);
    }
}

function remove($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->remove($_GET['id']);
        if ($res) {
            echo json_encode(['statuscode' => 200]);
        } else {
            echo json_encode(['statuscode' => 400]);
        }
    } else {
        // error
        echo json_encode([
            'statuscode' => 404,
            'response' => 'No se puede procesar la solicitud, id vacio'
        ]);
    }
}
