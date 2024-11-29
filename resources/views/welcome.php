<!--PASO 77 defino una estrutura html simple para probar el llamado a la vista --><!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bienvenido</title>
</head>
    <h1>hola mundo desde una VISTA</h1>
<body>
    
</body>
</html>-->

<!--PASO 79 una vez probado el correcto errutameinto a las vistas inicamos la contruccion del portal inicial --> 
<html>
    <head>
        <title>Proyecto CRUD | Consultar y listar con Ajax</title>
        <!--PASO 86 Importacion del CSS bootstrap -->
        <link href="<?= URL::to("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <!--FIJARSE que ingreso la ruta del archivo a utilizar dentro de la clase URL bajo el metodo to esto se hace para
        evitar que se dependa de manera estrita del host del proyecto o de la estructura interna del mismo. Ya que el metodo
        busca la URL base del mismo y la concatena a la URI de la ubicacion del archivo dentro de la carpeta-->

        <!-- Importacion del CSS y sweetalert -->
        <link href="<?= URL::to("assets/plugins/sweetalert/sweetalert.css") ?>" rel="stylesheet" type="text/css"/>
    </head>


     <!-- permiten el intercambio de información de propiedad entre el HTML y su representación DOM que pueden utilizar los scripts-->
    <!--para mas informacion sobre el uso del attributo data LEER: 
    https://www.apinem.com/atributos-data-html5/#:~:text=Los%20atributos%20data-*%20en%20HTML5%20permiten%20almacenar%20datos%20personalizados,de%20usar%20atributos%20no%20estándar
    https://developer.mozilla.org/es/docs/Web/HTML/Global_attributes#data-esdocswebhtmlglobal_attributesdata- -->
    <body data-urlbase="<?= URL::base() ?>"> 
    <!--PASO 80 creacion de la clase URL en ./src/bin/URL.php-->    
   

    <!--PASO 81 Maquetado de la pagina usando etilos de bootstrap en una tabla que muestre los usuarios registrados 
    ademas de tener una opcion para registras nuevos usuarios-->
        <div class="container"> 
            <div class="card mt-5">
                <div class="card-header bg-dark text-white">
                    <h5>Proyecto 1</h5>
                </div>
                <div class="card-body">

                    <div class="btn-group"><!--BOTON para la creacion de usuarios-->
                        <a href="crearusuario"></a>
                        <!--podemos ver a continuacion que usamos el metodo URL::to para concatenar la url a la quevamos a redirigir-->
                        <a href="<?= URL::to("usuarios/form/crear") ?>" class="btn btn-primary">Crear usuario</a>
                        <!--defino la ruta para la creacion de usuario en ./routes/web.php-->
                    </div>

                    <hr/>
                    <h4 class="card-title mb-4">Listar usuarios con AJAX</h4>
                    <table class="table table-condensed table-hover table-striped" width="100%" id="tablaListaUsuarios">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">Consultando...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!--IMPORTANTE los recursos .js DEBEN de ser cargados ANTES del CERRAR la etiqueta </body>
        esta practica le permite a las paginas tener mayor velocidad de carga-->

        <!--PASO 86 Importacion del archivo .js de bootstrap y jquery -->
        <!--FIJARSE que ingreso la ruta del archivo a utilizar dentro de la clase URL bajo el metodo to esto se hace para
        evitar que se dependa de manera estrita del host del proyecto o de la estructura interna del mismo. Ya que el metodo
        busca la URL base del mismo y la concatena a la URI de la ubicacion del archivo dentro de la carpeta-->
        <script src="<?= URL::to("assets/plugins/jquery.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/bootstrap/js/bootstrap.min.js") ?>" type="text/javascript"></script>

        <!--PASO 88 importacion de librerias de terceros, pueden ver en los archivos en la cabecera como se declara un recurso de tercero para evitar infraccion en -->
        <script src="<?= URL::to("assets/js/global/helperform.js") ?>" type="text/javascript"></script>
        <!--importo las rutas api definidas para ubicar los metodos a utilizar en el AJAX-->
        <script src="<?= URL::to("assets/js/global/rutas.api.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/app.global.js") ?>" type="text/javascript"></script>


        <script src="<?= URL::to("assets/plugins/sweetalert/sweetalert.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/modulos/lista.usuarios.js") ?>" type="text/javascript"></script>
    </body>
</html>  