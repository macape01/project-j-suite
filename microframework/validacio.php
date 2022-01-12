<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    
    <link rel="stylesheet" type="text/css" href="css/estilo-login.css" media="screen"/>    
    <script src="js/jquery-1.7.2.min.js" type="text/javascript"></script> 
    <script src="js/validarFormularios.js" type="text/javascript"></script> 
    
    <title>Registro</title>
</head>

<body>
    
    <?php
        require_once 'controlador/config.php';
        require 'modelo/usuario.php';
        require 'controlador/GestorUsuarios.php';
        
        // Inicializamos las varibles que se usaran para los campos de texto del formulario.
        $usuario="";
        $email="";
        $nombre="";
        $apellidos="";
        $edad="";
        $telefono=""; 
        $password="";
        $password2="";

        if(isset($_POST['registrar'])){             
            $conexion = new mysqli($servidor, $usuarioBD, $passwordBD, $baseDatos);
            $nuevoUsuario = new Usuario($_POST['usuario'],$_POST['nombre'],$_POST['apellidos'],$_POST['email'],$_POST['edad'],$_POST['telefono'],$_POST['password'],$_POST['password2']);
            $gestor = new GestorUsuarios($conexion);    
            
            // Si todos los campos del usuario son correctos y se realiza la insercion del usuario con exito
            // se redireciona a la pagina correspondiente.
            if (($gestor->validarUsuario($nuevoUsuario)) && ($gestor->insertarUsuario($nuevoUsuario))) {
                $conexion->close();
                header("Location:formulario_login.php");
            } else {
                // Si algo falla se recuperan los datos introducidos por el usuario
                // para que no tenga que reescribir los que estuviesen correctos.
                $usuario=$_POST['usuario'];
                $email=$_POST['email'];
                $nombre=$_POST['nombre'];
                $apellidos=$_POST['apellidos'];
                $edad=$_POST['edad'];
                $telefono=$_POST['telefono']; 
                $password=$_POST['password'];
                $password2=$_POST['password2']; 
            }
        }
    ?>

    <section>
        <div id="formulario_registro">

            <h2>Formulario registro</h2>
            <form action="#" method=POST>
                <div class="campoFormulario">
                    <label for="usuario">Usuario: <span class="obligatorio">*</span></label>
                    <input type='text' id="usuario" name="usuario" maxlength="15" value="<?php echo $usuario ?>" onblur="return validarNombreUsuario(this.value)" autocomplete="off"/>
                </div>
                <div class="campoFormulario">
                    <label for="password">Contraseña: <span class="obligatorio">*</span></label>
                    <input type='password' id="password" name="password" maxlength="20" value="<?php echo $password ?>" onblur="return validarPassword(this.value)" autocomplete="off"/>
                </div>
                <div class="campoFormulario">
                    <label for="password2">Repita la Contraseña: <span class="obligatorio">*</span></label>
                    <input type='password' id="password2" name="password2" maxlength="20" value="<?php echo $password2 ?>" onblur="return validarPasswordIguales(password.value,this.value)"/>
                </div>
                <div class="campoFormulario">
                    <label for="email">Email: <span class="obligatorio">*</span></label>
                    <input type='text' id="email" name="email" maxlength="30" value="<?php echo $email ?>" onblur="return validarEmail(this.value)"/>
                </div>
                <div class="campoFormulario">
                    <label for="nombre">Nombre:</label>
                    <input type='text' id="nombre" name="nombre" maxlength="20" value="<?php echo $nombre ?>" onblur="return validarNombre(this.value)"/>
                </div>
                <div class="campoFormulario">
                    <label for="apellidos">Apellidos:</label>
                    <input type='text' id="apellidos" name="apellidos" maxlength="30" value="<?php echo $apellidos ?>" onblur="return validarApellidos(this.value)"/>
                </div>
                <div class="campoFormulario">
                    <label for="edad">Edad:</label>
                    <input type='text' id="edad" name="edad" maxlength="30" value="<?php echo $edad ?>" onblur="return validarEdad(this.value)"/>
                </div>
                <div class="campoFormulario">
                    <label for="telefono">Telefono: <span class="obligatorio">*</span></label>
                    <input type='text' id="telefono" name="telefono" maxlength="9" value="<?php echo $telefono ?>" onblur="return validarTelefono(this.value)"/>
                </div>


                <div class="botonFormulario">
                    <input type="submit" id="registrar" name="registrar" value="Registrarse">
                </div>  
            </form> 
        </div>
    </section>
</body>
</html>