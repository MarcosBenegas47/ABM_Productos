<?php 

    require 'conexion_base.php';
    require 'producto.php';

    if(isset($_POST["nombre_producto"]) && (isset($_FILES["imagen_producto"]) || isset($_FILES["imagen2"]))){
        /*
        echo "Estan llegando los datos!";
        echo "<br>";
        */
        $producto = array();
        $producto["nombre_producto"] = $_POST["nombre_producto"];

        //cuando tengo un input de tipo "file", lo vamos a agarrar con la variable
        //$_FILES (tambien es un array asociativo)
        //var_dump($_FILES["imagen_producto"]);

        //NECESITO LA EXTENSION DEL ARCHIVO
        $type = pathinfo($_FILES["imagen_producto"]["name"], PATHINFO_EXTENSION);
        
        //NECESITO LA DATA BINARIA DEL ARCHIVO
        $data = file_get_contents($_FILES["imagen_producto"]["tmp_name"]);
        
        //TRANSFORMAR ESTO A BASE64
        $producto["imagen_producto"] = "data:image/".$type.";base64,".base64_encode($data);
        
        
        //codigo para  guardar imagenes localmente
        $typeImage2 = pathinfo($_FILES["imagen2"]["name"], PATHINFO_EXTENSION);
        $nombreImagenGuardada = 'imagenes/foto_' . uniqid() . "." . $typeImage2;
        $tmp_name = $_FILES["imagen2"]["tmp_name"];
        // Mueve el archivo temporal a la carpeta 'imagenes'
        move_uploaded_file($tmp_name,  $nombreImagenGuardada);


        //descomentar para guardar en la base de datos
        
        // $conexion = conectar_base();

        // $resultado = agregar_producto($conexion, $producto);

        // if($resultado){
        //     echo "Salio bien!";
        //     echo "<br>";
        //     header('Location: productos.php');
        // }
        // else{
        //     echo "Salio mal!";
        //     echo "<br>";
        // }

     //   desconectar_base($conexion);
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <label>Nombre:</label><input type="text" id="nombre_producto" name="nombre_producto" autocomplete="off"><br>
    <label>Imagen:</label><input type="file" id="imagen_producto" name="imagen_producto"><br>
    
    <label>Imagen2:</label><input type="file" id="imagen2_producto" name="imagen2">

    <button>Agregar Producto</button>
    <a href="./productos.php">Volver</a>
</form>