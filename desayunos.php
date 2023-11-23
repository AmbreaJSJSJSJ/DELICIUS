<?php
session_start();

include('../php/desa.php');
$conexionBD = BD::crearInstancia();

$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $sql = $conexionBD->prepare("SELECT id, producto, precio, ruta FROM desayunos WHERE producto LIKE :search");
    $sql->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
} else {  
    // Si no se ingresó un término de búsqueda, puedes mostrar todos los productos de desayunos
    $sql = $conexionBD->prepare("SELECT id, producto, precio, ruta FROM desayunos");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Desayunos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nombre+de+la+Fuente">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <form>
            <input type="text" id="search-input" name="search" placeholder="Buscar...">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <nav class="navbar">
            <a href="../index.html">Inicio</a>
            <a href="../bebidas/bebidas.php">Bebidas</a>
            <a href="../desayunos/desayunos.php">Desayunos</a>
            <a href="../Comida/comidas.php">Comidas</a>
            <a href="../postres/postres.php">Postres</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <li class="cerrar-sesion"><a href="../Sesion/sesion/logout.php">Cerrar sesión</a></li>
            <?php endif; ?>
        </nav>
    </div>
    <div class="imagen-grande">
        <img src="../imagen/5.png" alt="Imagen Grande">
    </div>
    <hr>
    <div class="contenidos">
        <?php foreach ($resultado as $mos) { ?>
            <div class="bebida">
                <?php
                $imagen = $mos['ruta'];
                if (!file_exists($imagen)) {
                    $imagen = "../bebidas/no-photo.jpg";
                }
                ?>
                <div class="portada"><img src="<?php echo $imagen; ?>" alt="bebida "></div>
                <h3><?php echo $mos['producto'] ?></h3>
                <h4><?php echo $mos['precio'] ?></h4>
                
                
            <!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
            <input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="VP7U8SMJJCMMC" />
            <input type="hidden" name="currency_code" value="MXN" />
            <input type="hidden" name="item_name" value="<?php echo $mos['producto'] ?>" />
            <input type="hidden" name="amount" value="<?php echo $mos['precio'] ?>" />
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Add to Cart" />
            </form>

</button>


            
            </div>
          
          
  <!-- Modal -->
          
            
        <?php } ?>
        
      
        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
     const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
    </script> 
    
</body>
</html>
