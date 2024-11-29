var vista = {
    /*se crea un objeto que manipulara el DOM del formulario para el registo de USUARIOS*/
    controles: {
        formUsuario: $('#formUsuario'),//PASO 104 referencia al formulario para id="formUsuario"

        idUsuario: $('#idUsuario') /*Hago referencia al elemento id="idUsuario"
        declarado en el input oculto de formulario reciclado PASO 113 ./resources/views/usuarios/registrarusuario.php 
        mediante la capturacion previa dentro de una variable  */
    },
    init: function () {//atributo complejo de tipo funcion que inica los procesos al cargar la pagina
        vista.eventos(); // PASO 104 reviso los eventos que pueden darse la pagina, una forma de observador

        //LO SIGUIENTE FORMA PARTE DEL PASO 116 
        var idUsuario = vista.controles.idUsuario.val(); //capturo el valor del id de usuario

        /*se invoca la peticion para poder hacer uso del metodo para ACTULIZAR USUARIO que recibe el valor de idUsuario*/
        vista.peticiones.consultarUsuarioPorId(idUsuario);//se envia la variables que contiene el valor del ID USUARIO
        
    },
    eventos: function () {
        vista.controles.formUsuario.on('submit', vista.callbacks.eventos.accionesFormRegistro.ejecutar);
        //capturo el evento submit cuando el usuario le de clic al boton o de enter a un campo ejecuta el metodo callback adecuado
    },
    callbacks: {// 
        eventos: {
            accionesFormRegistro: {
                ejecutar: function (evento) {
                    __app.detenerEvento(evento);/*detengo la ejecucion del evento para que no haga postback que es 
                    el intercambio de información entre servidores para informar sobre la acción de un usuario en 
                    un sitio web, red o aplicación
                    
                    es un HTTP POST a la misma página que contiene el formulario. En otras palabras, el contenido 
                    del formulario es enviado de nuevo a la misma URL que la del formulario.
                    
                    Lo cual no es lo que se busca dado que la informacion la quiero enviar a otro archivo para su procesamiento*/


                    var form = vista.controles.formUsuario; //obtengo la referencia del formulario

                    var obj = form.getFormData(); //obtengo los datos del formulario metodo contenido en la herramienta de tercero helperform.js

                    console.log(obj);//imprimo por consola el objeto que obtube de los datos del formulario utilizado SOLO para verificar la operativida del proyecto

                    vista.peticiones.registrarUsuario(obj);//implemetamos una peticio para registrar usuario
                }
            }
        },
        peticiones: {//PASO 107 definir el compotamento de las peticiones callback
            beforeSend: function () {
                //bloqueamos los inputs y el boton para evitar el cambio de informacion mientras la informacion se esta enviando
                vista.controles.formUsuario.find('input,button').prop('disabled', true);
            },
            completo: function () { 
                //activo los input y los botones del formulario que desactive en el envio
                vista.controles.formUsuario.find('input,button').prop('disabled', false);
            },
            finalizado: function (respuesta) {
                //si existe una respuesta adecuada                
                if (__app.validarRespuesta(respuesta)) {
                    //sino hay un idUsruario que se ESTA actualizando, es decir, no se cuenta ningun elemento
                    if (!vista.controles.idUsuario.length) {
                        
                        //limpia los campos del formulario porque se esta es insertando datos
                        vista.controles.formUsuario.find('input').val('');
                        
                    }
                    swal('Correcto', respuesta.mensaje, 'success');
                    return;
                }
                //en caso de error muestro el mensaje que devuelve el servidor
                swal('Error', respuesta.mensaje, 'error');
            },
            consultarPorIdCompleto: function (respuesta) {//PASO 117 re llenado del formulario una vez operado
                if (__app.validarRespuesta(respuesta)) {
                    //si existe una respuesta adecuada 
                    vista.controles.formUsuario.fillForm(respuesta.datos)
                    /*llenamos el formulario UBICANDO el formulario que estamos usando y haciendo uso del
                     metodo fillForm() del archivo de tercero helperform */
                    return;
                }//en caso de error se muestra el mensaje correspondiente
                swal('Error', respuesta.mensaje, 'error');
            }
        }
    },
    peticiones: { //PASO 105 defino la peticion para registrar usuario
        registrarUsuario: function (obj) {

            var url = RUTAS_API.USUARIOS.REGISTRAR_USUARIO;//definimos la ruta para la insercion del usuario


            /* PASO 118 verificamos si JS detecto la presencia de un idUsuario a 
                MODIFICAR contando length() los elementos encontrados ya que jquery siempre genera un objeto asi este vacio
                para evitar errores contamos los elementos de ese objeto encontrado/generado
            */
            if (vista.controles.idUsuario.length) {
                
                url = RUTAS_API.USUARIOS.ACTUALIZAR_USUARIO;//llamamos a la ruta para el actualizar usuario que se declara en rutas.api.js
                obj.idUsuario = vista.controles.idUsuario.val();//PASO 120 asignamos el valor de idUsuario recibido para ser enviado al metodo que actualizara el registro
            }

            __app.post(url, obj) //PASO 106 establesco el comportameinto el metodos post del formulario e intancio los metodos callback adecuados
                    //llamo un metodo para evitar modificacion de la informacion que se envia por el formulario
                    .beforeSend(vista.callbacks.peticiones.beforeSend)

                    //una vez finalice el proceso activo el formulario nuevamente
                    .complete(vista.callbacks.peticiones.completo)

                    //si hay una respuesta de parte del servidor
                    .success(vista.callbacks.peticiones.finalizado)

                    //si hay algun tipo de error reciclo el mensaje de fallo de metodo anterior
                    .error(vista.callbacks.peticiones.finalizado)
                    .send();
        },
        consultarUsuarioPorId: function (id) {//PASO 116 establesco un nuebo metodo para cosultar un usuario por ID

            if(!id) {//sino recibo un ID termino la llamada al metodo
                return;
            }

            __app.post(RUTAS_API.USUARIOS.CONSULTAR_USUARIO_POR_ID, {
                idUsuario: id,
                /*este objeto es la data que se envia mediante $_REQUEST que se recibe por medio del controllador
                $idUsuario = $request->idUsuario;   (ver PASO 114) metodo buscarUsuarioPorId()*/
            })      
                    //reciclo los metodos ya implementados en la INSERCION de datos de USUARIOS
                    .beforeSend(vista.callbacks.peticiones.beforeSend)
                    .complete(vista.callbacks.peticiones.completo)
                    //intancio metodos especificoa para volver a completar el formulario una vez modificado
                    .success(vista.callbacks.peticiones.consultarPorIdCompleto)
                    //o en caso de error
                    .error(vista.callbacks.peticiones.consultarPorIdCompleto)
                    .send();
        }
    }
};
$(vista.init);// PASO 108 instanciamos el objeto a travez de su atributo init