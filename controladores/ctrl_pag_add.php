<!--
===========================================================================
Controlador para procesar un nuevo registro
Creado por: Edgard Ruiz Gonzalez
Fecha: 01/11/2015
============================================================================
-->

<?php
    include '../modelo/connect_DB.php';
    include '../modelo/model_pag.php';

    //Subimos la pagina
	$pagina = $_FILES["archivo"]['tmp_name'];
	$nombre_pagina = $_FILES["archivo"]['name'];
	$tipo = $_FILES["archivo"]['type'];
	$tamano  = $_FILES["archivo"]['size'];

	$destino = "../paginas/" . $nombre_pagina;

	if (move_uploaded_file($pagina, $destino))
	{
	echo "Su pagina se ha subido correctamente en breve seras redirigido";

	}
	else 
	{
	echo  "Su archivo no se ha subido";
	}

	//Recogemos variables
    $nombre= $_POST['nombre'];
    $funcionalidades= $_POST['Funcionalidades'];
    $url= "/www.gestshell.ga/paginas/" . $_FILES["archivo"]["name"];
    $desc="";
	

   //Conectamos con el gestor de la bd
    $db = new Database();
    $newPag = new Pagina();

    

    //Comprobamos si ya existe la pagina
    $consultaSiPag = $newPag->exists($nombre);
    if ($consultaSiPag == true){
        echo '<p>La pagina ' . $nombre . ' ya existe en la bd</p>';
    } else {
        $insertPag = new Pagina ($url,$nombre, $funcionalidades);
        if ($newPag->crear($insertPag) == true){
            echo 'La pagina ' . $nombre . ' ha sido registrada en el sistema';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
 
        } else{
            echo "Error al insertar la pagina";
        }
    }

?>
<!--
<script type="text/javascript">
setTimeout("window.location = '<?php echo $_SERVER['HTTP_REFERER'] ?>'", 4000);
</script>

-->















