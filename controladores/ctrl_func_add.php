<!--
===========================================================================
Controlador para añadir func
Creado por: David Ansia
Fecha: 01/11/2015
============================================================================
-->

<?php
    include '../modelo/model_func.php';

	//Recogemos variables
    $nombre= $_POST['nombre'];
    $desc=$_POST['desc'];
    $newRoles = array();
    $newPags = array();

   //Conectamos con el gestor de la bd
    $db = new Database();
    $newFunc = new Funcionalidad();

    //Comprobamos si ya existe la funcionalidad
    $consultaSiFunc = $newFunc->exists($nombre);
    if ($consultaSiFunc == true){
        echo "existe";
    } else {
        $insertFunc = new Funcionalidad ($nombre, $desc, $roles, $paginas);
        header('Location: ../vistas/vista_func.php');
        if ($newFunc->crear($insertFunc) == true){
            echo 'La funcionalidad ' . $nombre . ' ha sido registrada en el sistema';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
 
        } else{
            echo "Error al insertar la funcionalidad";
        }
    }

?>

<!--
<script type="text/javascript">
setTimeout("window.location = '<?php echo $_SERVER['HTTP_REFERER'] ?>'", 4000);
</script>
-->
