/*PASO 89 Se crea un Objeto con funciones determinadas incluidas dentro de objetos especificos o atributos complejos
 que conforman al objeto "vista"
*/

var vista = {
  controles: {//PASO 90 defino un atributo que contiene una variable para establecer la ubicacion en el DOM de mi tabla
    tbodyListaUsuarios: $('#tablaListaUsuarios tbody'),//busca mediante el id de la tabla "tablaListaUsuarios" al objeto <tbody> 
    /*en caso de queres ubicar ejemplo la tabla Personajes puedo hacer

    en el cuerpo del html declarar la tabla como: 

    <table id="tablePjsList">
      <tbody>
      </tbody>
    </table>

    y dentro de un archivo list.pjs.js definir:

    //un atributo:
    controles: {

    //que dentro genero un objeto de busqueda 
    
    tbodyListaPersonajes: $('#tablePjsList tbody'), //y uso el id definido en mi tabla para indicar la parte del DOM de interes
    }
    
    */
  },
  init: function () {//utilizamos este atributo que contiene una funcion, para controlar los eventos dentro de la tabla
    vista.eventos();//llamamos un atributo para monitorear los eventos que ocurren dentro del cuerpo de la tabla 
    vista.peticiones.listarUsuarios();//llamamos al atributi 
  },
  eventos: function () {

    //PASO 123referencio a el evento dentro del docuemento cuando se hase clic en el boton eliminar
    $(document).on(
      'click',
      '.btn-accion.eliminar',//hago referencia al boton mediante lo definido en su clase; [class="btn-accion eliminar"] 
      vista.callbacks.eventos.onClickEliminar//hago la llamada al metodo callback onClickEliminar() para determinar su comportamento
    );
  },
  callbacks: {// es una función que se pasa como argumento a otra función para que sea ejecutada posteriormente.
    eventos: {
      onClickEliminar: function (evento) { //PASO 124 comportamiento al hacer clic en eliminar

        const btnEliminar = $(evento.target);//obtengo la informacion del boton al que se dio clic y la almaceno en una const

        const idUsuario = btnEliminar.data('id'); //extraigo de los datos suministrado por el boton el Id del USUARIO

        console.log('btnEliminar', btnEliminar);//muetro los datos obtenidos por consola, metodo de verificar la funcionabilidad
        console.log('id', btnEliminar.data('id'));

        swal(//muestro mediante sweealert eleboramos una confirmacion de Usuario en base la informacion
          {
            title: 'Estás seguro?',
            text: 'Esta acción no se puede deshacer',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false,
          },
          function (confirmado) {
            //segimos la estrutura de la alerta con una funcion que ccaptura en una variable el valor elegido por el usuario
            if (confirmado) {//si es true, presiono el confirmButtonText

              //se envia a la ruta de eliminacion el Id Usuario a eliminar por una peticion
              vista.peticiones.eliminarUsuarioPorId(idUsuario);
            }
          }
        );
      },
    },
    peticiones: {//PASO 9 peticiones que se haran al DOM mediante AJAX cuando hay una 
      eliminarUsuarioPorId: {// PASO 126 peticion callback para eliminacion de usuario
        completo: function (respuesta) {//definimor una funcions
          const v = __app.validarRespuesta(respuesta);//donde recibimos la respuesta del AJAX
          swal(//e invocamos una alerta para mostar segun sera true o false un mensaje
            v ? 'Correcto' : 'Error',
            respuesta.mensaje,
            v ? 'success' : 'error'
          );
          v && vista.peticiones.listarUsuarios();//y se hace una peticion para que se actulize la lista de Usuario una vez modificada la tabla
        },
      },
      listarUsuarios: {// definimos el comportamiento de listarUsuarios

        beforeSend: function () { //PASO 94 parametrizacion de los datos ANTES de la recepccion de parte de la BD

          var tbody = vista.controles.tbodyListaUsuarios; //hago una instancia de referencia a donde esta ubicada la tabla

          tbody.html(vista.utils.templates.consultando());// llamo al consulta mientras no hay datos recibidos de la tabla
        },
        completo: function (respuesta) {// //PASO 95 parametrizacion de los datos en base a la RESPUESTA de la BD

          var tbody = vista.controles.tbodyListaUsuarios; //hago una instancia de referencia a donde esta ubicada la tabla

          var datos = __app.parsearRespuesta(respuesta);//parseamos si la respuesta obtenida de la BD es valida

          if (datos && datos.length > 0) {//validamos que estemos recibiendo datos de la BD

            tbody.html('');//inicialicamos la cadena que se mostrara dentro de la tablas

            for (var i = 0; i < datos.length; i++) {//recorremos todos los elementos del arreglo que recibimos de la BD

              var dato = datos[i];//obtenemos el dato del indice que estamos recorriendo

              tbody.append(vista.utils.templates.item(dato)); //mostramos el dato usando la plantilla que definimos en base a una plantilla del PASO 95

              //El método append() se utiliza en JavaScript para agregar contenido HTML o un elemento al final de un elemento HTML específico 
            }
          } else {//en caso de error es decir no haber registro en la BD
            tbody.html(vista.utils.templates.noHayRegistros());
          }
        },
      },
    },
  },
  peticiones: {//PASO 91 atributo de las peticiones directas al DOM
    eliminarUsuarioPorId: function (idUsuario) { //PASO 125 peticion paara eliminar usuario
      __app
        .post(RUTAS_API.USUARIOS.ELIMINAR_USUARIO_POR_ID, {//llamamos la ruta para la eleminacion de usuario por id
          idUsuario,
        })
        //intancia las llamadas de las peticiones AJAX
        .success(vista.callbacks.peticiones.eliminarUsuarioPorId.completo)
        .error(vista.callbacks.peticiones.eliminarUsuarioPorId.completo)
        .send();
    },
    listarUsuarios: function () { // PASO 92 para el listar los registros de la tabla Usuario de nuestra BD

      __app//llamo al objeto _app dentro de app.global.js que nos intancia un objeto de configuracion AJAX
      //
        .get(RUTAS_API.USUARIOS.LISTAR)//pasamos la ruta definida en ./app/assets/js/global/rutas.api.js  PASO 93

        /*definimos las callbacks para el llamado listarUsuarios Una función de callback en JavaScript es una función que se pasa como 
        argumento a otra función para que sea ejecutada posteriormente. Las funciones de callback se
        utilizan para completar acciones o rutinas, y son útiles para crear páginas interactivas que 
        reaccionan a las solicitudes. */

        .beforeSend(vista.callbacks.peticiones.listarUsuarios.beforeSend)//intanciamos para ANTES de enviada la peticion 

        .success(vista.callbacks.peticiones.listarUsuarios.completo)//intanciamos para LOGRADO la peticion

        .error(vista.callbacks.peticiones.listarUsuarios.completo)//intanciamos para cuando hay error en la peticion

        .send();//Ejecutamso al peticion AJAX
    },
  },
  utils: {// PASO 95 genero un atributo de utilidades para el llenado de la tabla

    templates: { //dentro genero un atributo  complejo que es unas plantillas = templates que dan forma a la estrutura de la tabla

      item: function (obj) { //defino cuando reciba un objeto

        /*Proveniente del atributo init en su llamado de "vista.peticiones.listarUsuarios();
        mediante el cual extraigo la informacion de todos los registros en la BD de la tabla usuarios
        "*/
        //CONCATENAMOS una estrura HTML necesaria de la tabla para mostras los DATOS de los elementos de un obj que es un regitro dentro de la tabla
        return (
          '<tr>' +
          '<td>' +
          obj.nombres +
          '</td>' +
          '<td>' +
          obj.apellidos +
          '</td>' +
          '<td>' +
          obj.edad +
          '</td>' +
          '<td>' +
          obj.correo +
          '</td>' +
          '<td>' +
          obj.telefono +
          '</td>' +
          '<td>' +
          '<a href="' +
          __app.urlTo('/usuarios/form/edicion/' + btoa(obj.id)) +
          '" class="btn-accion editar">Editar</a>' +
          '  |  ' +
          '<a href="javascript:;" class="btn-accion eliminar" data-id="' +
          obj.id +
          '">Eliminar</a>' +
          '</td>' +
          '</tr>'
        );
      },
      consultando: function () {//cuando la pagina esta en proceso de consulta de los registos
        return '<tr><td colspan="6">Consultando...</td></tr>';
      },
      noHayRegistros: function () { //cuando no hay registros para mostrar en la tabla
        return '<tr><td colspan="6">No hay registros...</td></tr>';
      },
    },
  },
};
$(vista.init);
/*PASO 96 llamo al metodo .ready() de Jquery que ejecuta el metodo seleccionado en este caso al metodo init que esta 
dentro del objeto vista que se ejecuta cuando se ha cargado el DOM (modelo de objetos de documento). es decir los recursos
de la pagina*/
