<!--
===========================================================================
Muestra los usuarios
Creado por: Andrea Araujo Cuquejo, Elías Martínez Blanco
Fecha: 27/10/2015
============================================================================
-->
<!--Importar las cabeceras y la barra de navegacion-->



<?php

session_start();


if(!$_SESSION["idioma_usuario"]){
include_once "../modelo/es.php";
    
}else{
    include_once '../modelo/'.$_SESSION["idioma_usuario"].'.php';
}

?>


<?php

if(!$_SESSION){
session_start();
header('Location:../vistas/login.php');

}

?>

<?php include_once('../html/navBar.html');
include_once('../controladores/ctrl_usu.php');
 ?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        <!-- Boton añadir rol -->
        <div class="btn-parent">
            <div class="btn-child"> <!-- centran el boton -->
                <a href="vista_usu_add.php" class="btn btn-info btn-lg">
                    <?php echo $idioma["anadir_usuario_usuario"]; ?>
                    <div class="glyphicon glyphicon-plus"></div>
                </a>
            </div>
        </div>
        <br>
        
        <!-- Mostrar Usuarios -->
        <?php 
        foreach ($arrayUsuarios as $usu)  {
            echo "<div class='col-md-8 col-md-offset-2 well'>
            <a href='#' data-toggle='modal' data-target='#removeModal'> <div class='remove-icon glyphicon glyphicon-remove'></div></a>
            <div class='col-md-6'>
                <div class='titulo'> {$usu['Login']} 
            <a href='vista_usu_mod.php'> <div class='edit-icon glyphicon glyphicon-edit'></div></a>
            
            <div class='col-md-3'>
                <h4>Roles</h4>";
                // array asociativo de los roles ligados al usuario actual del bucle
                $arrayRoles = $usuarios->arrayA($usu['Login']);
                foreach ($arrayRoles as $rol){
                    echo "<p> {$rol['NombreRol']} </p>";
                }
                
            echo "
            </div>
            <div class='col-md-2'>
                <h4>Paginas</h4>";
                // array asociativo de las paginas ligadas al usuario actual del bucle
                $arrayPaginas = $usuarios->arrayB($usu['Login']);
                foreach ($arrayPaginas as $pag ){
                    echo "<p> {$pag['Url']} </p>";
                }
            echo "        
            </div>
        </div>";
        }
        ?>
        
        
        <!-- Remove Modal Page -->
        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["advertencia_borrar_usuario"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p><?php echo $idioma["seguro_borrar_usuario"]; ?></p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $idioma["NO_borrar_usuario"]; ?></button>
                <button type="button" class="btn btn-primary"><?php echo $idioma["SI_borrar_usuario"]; ?></button>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>