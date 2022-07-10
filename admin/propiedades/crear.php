<?php 

    //Base de datos
    require '../../includes/config/database.php';

    $db = conectarDB();

    //Consultar para obtener vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db,$consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    //Ejecutar el código después de que el ususraio envia formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        /*echo "<pre>";
        var_dump($_POST);
        echo "</pre>";*/

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        if (!$titulo){
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio){
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento){
            $errores[] = "El número de lugares de estacionamiento es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']){

            $errores[] = "La imagen es obligatoria";

        }

        //Validar por tamaño
        $medida = 1000*1000;

        if($imagen['size'] > $medida){
            $errores[] = " La imagen es muy pesada";

        }

        //Revisar que el array de errores esté vacío
        if(empty($errores)){

            //Subida de archivos

            //crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            //Subir imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            //Insertar en base de datos
            $query = " INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado, vendedorId) 
                        VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId')";

            //echo $query;

            $resultado = mysqli_query($db,$query);

            if($resultado){
                //Redireccionar al usuario

                header("Location: /admin?resultado=1");
            }
        }

    }

    require '../../includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Crear</h1>


        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach ?>    

        <!-- POST para enviar datos de forma segura
            GET para exponerlos en la URL-->
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>
                    <label for="titulo">Titulo:</label>
                    <input type="text" id="titulo" name="titulo" placeholder = "Titulo Propiedad" value="<?php echo $titulo; ?>">

                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" placeholder = "Precio Propiedad" value="<?php echo $precio; ?>">

                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept = "image/jpeg, image/png" name="imagen">

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?> </textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name ="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" name ="wc" id="wc" placeholder = "Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" name ="estacionamiento" id="estacionamiento" placeholder = "Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name ="vendedor" >
                    <option value="">--Selecione--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ): ?>
                        <option  <?php echo $vendedor === $vendedor['id'] ? 'selected' : '' ?> value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre']. " ". $vendedor ['apellido'];?></option>

                    <?php endwhile ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>