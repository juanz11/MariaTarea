<!--PASO 99 maquetacion del formulario para AÑADIR usuarios-->
<html>
    <head>
                <!--PASO 111 valido si exite una variable llamada $titulo que en caso de existir cambio el nombre de la pagina -->
        <title>Proyecto CRUD | <?= isset($titulo) ? $titulo : "Insertar Usuario con Ajax" ?></title>


        <link href="<?= URL::to("assets/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= URL::to("assets/plugins/sweetalert/sweetalert.css") ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body data-urlbase="<?= URL::base() ?>">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header bg-dark text-white">
                    <h5>Proyecto 1</h5>
                </div>
                <div class="card-body">

                    <!--cambio el boton para volver a la lista de usuarios-->
                    <div class="btn-group">
                        <a href="<?= URL::base() ?>" >Listar usuarios</a> 
                    </div>


                    <hr/>

                    <!--PASO 112 valido si recibo por la URL el valor del TITULO-->
                    <h4 class="card-title mb-4"><?= isset($titulo) ? $titulo : "Insertar Usuarios con Ajax" ?></h4>
                    
                    <!--maquetacion del formulario-->
                    <form id="formUsuario" action="usuarios/registrar" method="POST">


                        <!--PASO 113 valido si recibo por la URL el valor del id de un usuario dentro de la BD-->
                        <?php if (isset($idUsuario)): ?>
                        <!--Este input OCULTO nos servira para validad desde JavaScript el ID actual del usuario en caso de ser resivido-->
                            <input type="hidden" id="idUsuario" value="<?= $idUsuario ?>" />
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="nombres">Nombres (*):</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos (*):</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad (*):</label>
                            <input type="number" class="form-control" id="edad" name="edad" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo (*):</label>
                            <input type="email" class="form-control" id="correo" name="correo" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" />
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?= URL::to("assets/plugins/jquery.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/bootstrap/js/bootstrap.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/helperform.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/rutas.api.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/global/app.global.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/sweetalert/sweetalert.js") ?>" type="text/javascript"></script>
                        <!--añado el archivo registrar.usuarios.js que manipulara este formulario -->
        <script src="<?= URL::to("assets/js/modulos/registrar.usuarios.js") ?>" type="text/javascript"></script>
    </body>
</html>