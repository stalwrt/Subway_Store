<div class="card">
    <input type="hidden" id="id" value="<?php echo $item['id']; ?>">
    <div class="imagen">
        <img src="Assets/Images/<?php echo $item['imagen']; ?>">
    </div>
    <div class="contenido">
        <h3><?php echo $item['nombre']; ?></h3>
        <p><?php echo $item['descripcion']; ?></p>
        <span><?php echo $item['precio']; ?></span>
        <button>Agregar al carrito</button>
    </div>
</div>