<!--
===========================================================================
Controlador para modificar los datos de los usuarios
Creado por: Edgar Conde Nóvoa
Fecha: 03/11/2015
============================================================================
-->

<?php
    include_once "../modelo/model_usu.php";

    $modUsu = new Usuario();

    //Nuevos datos
    $oldUsuLogin = $_POST['oldLogin'];
    $newUsuLogin = $_POST['newLogin'];
    $newUsuName = $_POST['nombre'];
    $newUsuSurname = $_POST['apellidos'];
    $newUsuEmail = $_POST['email'];
    $oldUsuPassword = $_POST['oldPass'];
    $newUsuPassword = $_POST['newPass'];
    $fechaAlta = $_POST['fechaAlta'];
    $idioma= $_POST['idioma'];
    $roles = array();
    $pags = array();

    //Comprobamos que se hayan cubierto todos los campos
    if ( empty($newUsuLogin) OR empty($newUsuName) OR empty($newUsuSurname) OR (!filter_var($newUsuEmail, FILTER_VALIDATE_EMAIL) AND empty($newUsuEmail))){
                // Set a 400 (bad request) response code and exit.
                header("HTTP/1.0 400 bad request");
                echo '<p>Por favor, rellene correctamente todos los campos</p>';
                exit;
     }

    if(isset($_POST['newRol'])){
      if (is_array($_POST['newRol'])) {
        foreach($_POST['newRol'] as $value){
          $roles[] = $value;
        }
      }
    }

    if(isset($_POST['newPag'])){
      if (is_array($_POST['newPag'])) {
        foreach($_POST['newPag'] as $value){
          $pags[] = $value;
        }
      }
    }

    $newUsu = new Usuario($newUsuLogin, $newUsuName, $newUsuSurname, $fechaAlta, $newUsuEmail, $newUsuPassword, $idioma);
    if ($modUsu->setPassword($oldUsuPassword, $newUsuPassword, $oldUsuLogin) == true){
        if (($modUsu->modificar($oldUsuLogin, $newUsu) == true)){
            header('location:../vistas/vista_usu.php'); 
        }else {
            echo "Fallo en la actualizacion del usuario";
        }
    }else {
        echo "Fallo en la actualizacion de la password";
    }
?>