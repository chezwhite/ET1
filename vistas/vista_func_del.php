<!--
===========================================================================
Borra las funcionalidades
Creado por: Edgar Conde Nóvoa
Fecha: 07/11/2015
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


if(!$_SESSION){
session_start();
header('Location:../vistas/login.php');

}
include_once('../controladores/ctrl_permisos.php');
include('../html/navBar.html');
include_once('../controladores/ctrl_func.php');
?>

<html lang="en">
    <!-- Contenido Principal -->
    <body>
        
        <?php 
        if(isset($_GET['confirmar'])){
            $funcionalidades->eliminar($_GET['confirmar']);
            header('location:vista_func.php');
        } else if (isset($_GET['borrar'])){
        ?>
        <!-- Remove Modal Page -->
        <div class="modal show" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="myModalLabel"><?php echo $idioma["advertencia_borrar_funcionalidad"]; ?></h4>
              </div>
                
            <!-- Contenido de la página login modal -->
              <div class="modal-body">
                 <p><?php echo $idioma["seguro_borrar_funcionalidad"]; echo $_GET['borrar'];?> ?</p>
              </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick ="location='vista_func.php'"><?php echo $idioma["NO_borrar_funcionalidad"]; ?></button>
                  <a class="btn btn-primary" href="vista_func_del.php?confirmar=<?php echo $_GET['borrar'];?>"><?php echo $idioma["SI_borrar_funcionalidad"]; ?></a>
              </div>
            </div>
          </div>
        </div>
         <?php
        		}
									?>
        
        
    </body>
</html>

<!--Importar los jquery, bootstrap.js y el footer-->
<?php include('../html/footer.html'); ?>