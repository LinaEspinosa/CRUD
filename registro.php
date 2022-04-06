<?php
    require_once("connections/connection.php")
?>

<?php
    $control="SELECT * from tipo_usuario WHERE id_tipo_usuario >= 2";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
?>
<?php
    $control1="SELECT * from tipo_documento";
    $query1=mysqli_query($mysqli,$control1);
    $fila2=mysqli_fetch_assoc($query1);
?>
<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $documento= $_POST['documento'];
        $nombre=    $_POST['nombre'];
        $usuario=   $_POST['usuario'];
        $clave=     $_POST['clave'];
        $idusu=     $_POST['idusu'];
        $doc=     $_POST['doc'];

        $validar ="SELECT * FROM usuario WHERE documento='$documento' or usuario='$usuario'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);
        if ($fila1) {
            echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
            echo '<script>windows.location="registro.php"</script>';
        }
         else if ($documento=="" || $nombre=="" || $usuario=="" || $clave=="" || $idusu=="" || $doc=="")
         {
             echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
            echo '<script>windows.location="registro.php"</script>';
         }
 
         else{
             $insertsql="INSERT INTO usuario(documento,nombre,usuario,password,id_tipo_usuario,id_tipo_documento) VALUES('$documento','$nombre','$usuario','$clave','$idusu','$doc')";
            mysqli_query($mysqli,$insertsql);
            echo '<script>alert (" Registro Exitoso, Gracias");</script>';
            echo '<script>window.location="index.html"</script>';
         }
     }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href=".//css/styleR.css">
    <title>Formulario Inicio de Sesion | LPEZ</title>
</head>
     <body onload="form1.usuario.focus()"> <!--PARA QUE EL FORMULARIO 1 SEA EL QUE INICIE Y LA LINEA PARPADEE EN ESA linea-- -->
    
    <div class="login-box"> <!-- Crea una caja imaginaria -->
        <img src="./images/pexels-caleb-oquendo-3023281 (1).jpg"  class="avatar" alt="Avatar image"> <!-- Insertamos una imagen -->
        
        <h1>Registro Usuario</h1>
    
        <form method="post" name="form1" id="form1"  autocomplete="off"> 

            <!-- select -->
            <select name="doc" id="#">
            <option value="">seleccione uno...</option>
            <?php
                do{
            ?>
                <option value="<?php echo($fila2['id_tipo_documento'])?>"> <?php echo($fila2['tipo_documento'])?>
            <?php      
                }while($fila2=mysqli_fetch_assoc($query1));
            ?>
            </select>


            <input type="text" name="documento" id="documento" placeholder="Ingrese su documento ">
            <input type="text" name= "nombre" id="documento" placeholder="Nombre completo ">
            <input type="text" name="usuario" id="usuario" placeholder="Usuario"><!-- Caja de texto donde el usuario digita -->
            <input type="password" name="clave" id="password" placeholder="Contraseña"><!-- caja de texto donde el usuario coloca la contraseña -->

            
     <!--select-->
        <select name="idusu">
            <option value="">seleccione uno...</option>
            <?php
                do{
            ?>
                <option value="<?php echo($fila['id_tipo_usuario'])?>"> <?php echo($fila['tipo_usuario'])?>
            <?php      
                }while($fila=mysqli_fetch_assoc($query));
            ?>
            </select>

            <input type="submit" name="validar"  value="Registrarme">
            
            <input type="hidden" name="MM_insert" value="formreg">
            

        </form>
    </div>
</body>

</html>
