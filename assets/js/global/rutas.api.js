/*definimos un OBJETO RUTAS_API que contiene la definicion de las rutas a utilizar y que seran llamas mediante AJAX*/
//DEBE de declararse en MAYUSCULAS ya que forma parte de la implementacion de metodo AJAX que incluimos mediante Jquery
//y este es parametrizado en app.global.js
var RUTAS_API = {
    USUARIOS: {//este atributo me define el CONTROLADOR que se busca invocar en el proyecto
        
        /*
        las rutas que definiremos dentro de este objeto deben de poseer EXACTAMENTE la misa declaracion que 
        las definida en el archivo web.php ubicado en ./routes/web.php sino el metodo AJAX no podra ubicar la 
        ubicacion adecuada de los metodos que son solicitados de los CONTROLADORES
        */
        
        LISTAR: 'listar_usuarios',//PASO 92 esta ruta es enviada al AJXA para buscar DEBE cohincidir con la definida en ./routes/web.php  
        // el metodo del controlador adecuado que necesitamos al parsearse adecuadamente pasa de
        // listar_usuarios a listarUsuarios que es como fue definido dentro de el proyecto



        REGISTRAR_USUARIO: 'usuarios/registrar',// definimos la ruta bajo la cual el AJAX conectara los controladores necesarioa para el registro de USUARIO
        
        CONSULTAR_USUARIO_POR_ID: 'usuarios/consultarUsuarioPorId',//defino la ruta que se usara para 

        // PASO 119 defino la ruta que llama al metodo para actulizar usuarios que debe ser exacta a la ruta definida en web.php
        ACTUALIZAR_USUARIO: 'usuarios/actualizar',

        ELIMINAR_USUARIO_POR_ID: 'usuarios/eliminarUsuarioPorId',// PASO 122 definimos la ruta para eliminar usarios por ID
    }

    /*supongase que se quieren declarar las rutas de los metodos del controlador de PERSONAJES se incluiria al objeto
    RUTAS_API el objeto:
    
    PERSONAJES: {
        SHOW: 'showPersonaje',
        UPDATE: 'updatePj',
        DELETE: 'delete_pj',
    }
    
    SIEMPRE que dichas rutas hallan sido reclaradas adecuadamento en ./routes/web.php , es decir, el valor de la variables
    que esta entre las ' ' sea exatamente igual a lo contenido dentro de "URL" de la estrutura:

    Route::"MetodoHTTP"("URL",NombreClase::class."@nombreMetodoAUtilizar");

    el metodo AJAX podra ubicar la ruta planteada y esta no generara errores

    */
};