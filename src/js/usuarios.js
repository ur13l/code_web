var action;
var id;
var eventos;
var paginaActiva = 0;
var eliminarIds;


/**
 * Función que valida si un campo de texto está vacío, marca el error en la interfaz.
 * @param  input: Recibe el elemento visible que contiene el texto.
 * @return {Boolean} true si el campo está vacío, false de lo contrario.
 */
function isEmpty(input){
    if(input.val().length > 0){
      return false;
    }
    else {
      input.addClass("invalid");
    }
}

function comparePasswords(pass1, pass2){
  if(pass1.val() == pass2.val()){
    return true;
  }
  else{
    pass2.addClass("invalid");
  }
}

/**
 * N
 * @param  {[type]} select [description]
 * @return {[type]}        [description]
 */
function noOpcion(select){
  if(select.val()){
    return false;
  }
  else {
    select.css({'border-color':'#EA454B','box-shadow':'0 1px 0 0 #EA454B'});
  }
}


/**
 * Llamada AJAX que devuelve los eventos de una página
 * @param  int page: Número de página (Comienza en 0)
 * @return void
 */
function getEvents(page){
  var obj = {
    page: page,
    action: 'read'
  };
  $.ajax({
      url : '../controller/usuarios.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
          eventos = json;
          renderizarEventos();
      },
      error : function(xhr, status) {
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },

  });
}

/**
 * Función para mostrar los campos de los eventos.
 * @return {[type]} [description]
 */
function renderizarEventos(){
  $("#tabla-eventos").html("");
  for (var i = 0 ; i < eventos.length; i++){


    var elem = "<tr  class='item-evento'>" +
    "<input type='hidden' value='"+eventos[i].id+"'>" +
    "<td> <input type='checkbox' id='chk"+eventos[i].id+"' class='filled-in chk checkbox-green-code'/>  <label for='chk"+eventos[i].id+"'></label></td>" +
    "<td>"+eventos[i].correo+"</td>" +
    "<td class='edit' style='cursor:pointer'><i class='material-icons'>edit</i></td>" +
    "<td class='delete' style='cursor:pointer'><i class='material-icons'>delete</i></td>" +
    "</tr>";
    $("#tabla-eventos").append(elem);


  }
  //Cuando se selecciona un elemento de la tabla debe mostrarse el modal
  $(".edit").on('click', function(){
    action = 'update';
    id= $($(this).parent().children()[0]).val()

    $('#modal1').openModal();

    $($("#correo").val($($(this).parent().children()[2]).html()).siblings()[0]).addClass('active');

  });

  $(".delete").on('click', function(){
    eliminarIds = [$(this).parent().children()[0].value];
    $("#delete-message").html("¿Desea eliminar al usuario \""+$(this).parent().children()[2].innerHTML+"\"?");
    dialogDelete();
  });

  $(".chk").on('change', function(){
    var arr = $("#tabla-eventos").children();
    eliminarIds = [];
    $("#delete-selection").css("display","none");
    for (var i = 0 ; i < arr.length ; i++){
      var checked = $($($(arr[i]).children()[1]).children()[0]).context.checked;
      if (checked){
        $("#delete-selection").css("display","block");
        eliminarIds.push($(arr[i]).children()[0].value);
      }
    }
  });
}

/**
 * Función que define el número de páginas y elementos a mostrarse por cada página.
 * @return void
 */
function definirPaginacion(){
  if($('#pagination-demo').data("twbs-pagination")){
    $("#pagination-demo").twbsPagination('destroy');
  }
  var obj = {
    action: 'count'
  };
  $.ajax({
      url : '../controller/usuarios.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        //Mostrar paginación
        console.log("PAGES" + json.pages);
        $('#pagination-demo').twbsPagination({
             totalPages: Math.ceil(json.pages/10),
             visiblePages: 7,
             first: "Primera",
              prev: "Anterior",
              next: "Siguiente",
              last: "Última",
             onPageClick: function (event, page) {
                paginaActiva = page-1;
                 getEvents(page-1);
             }
         });
         if(paginaActiva >= Math.ceil(json.pages/10)){
           paginaActiva = Math.ceil(json.pages/10)-1;
         }

      },
      error : function(xhr, status) {
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },
  });

}

/**
 * Muestra el diálogo de confirmación para eliminar.
 */
function dialogDelete(){
  $("#deleteModal").openModal();
}

/**
 * Función para eliminar eventos de la base de datos.
 */
function deleteEvents(){
  var obj = {
    action: 'delete',
    ids: JSON.stringify(eliminarIds)
  };
  $.ajax({
      url : '../controller/usuarios.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        console.log(json);
        getEvents(paginaActiva);
      },
      error : function(xhr, status) {
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },
  });
  definirPaginacion();
  getEvents(paginaActiva);
  $("#deleteModal").closeModal();
}

function guardarEvento(){
     var emptyCorreo = isEmpty($('#correo'));
     var emptyPass = isEmpty($('#pass'));
     var emptyPass2 = isEmpty($('#pass2'));

     if(!emptyCorreo && !emptyPass && !emptyPass2 ){

         // Se arma el objeto a enviar
         if(comparePasswords($('#pass'), $('#pass2'))){
           var obj = {
             correo: $('#correo').val(),
             password: $('#pass').val(),
             action: action,
             id: id
           };
           $.ajax({
               // la URL para la petición
               url : '../controller/usuarios.php',

               // la información a enviar
               // (también es posible utilizar una cadena de datos)
               data : obj,

               // especifica si será una petición POST o GET
               type : 'POST',

               // el tipo de información que se espera de respuesta
               dataType : 'json',

               // código a ejecutar si la petición es satisfactoria;
               // la respuesta es pasada como argumento a la función
               success : function(json) {
                   $("#modal1").closeModal();
                   getEvents(paginaActiva);
                   definirPaginacion();
               },

               // código a ejecutar si la petición falla;
               // son pasados como argumentos a la función
               // el objeto de la petición en crudo y código de estatus de la petición
               error : function(xhr, status) {
                   alert('Disculpe, existió un problema');
               },

           });
         }
     }

}

/**
 * Limpia los campos de la ventana modal de nuevo/modificar evento
 * @return void
 */
function limpiarCampos(){
  $("#correo").val("");
  $("#pass").val("");
  $("#pass2").val("");
}

$(document).ready(function(){
  //Configuración para generar el SideNav
  $(".button-collapse").sideNav();

  //Configuración para abrir modal
  $('.modal-trigger').leanModal();

  //Se ejecuta al darle click al botón de más, permite configurar la acción a 'create'
   $('#new-event').on('click', function(){
     action = 'create';
     id = null;
     limpiarCampos();
   });

   $('#guardar-evento').on('click', guardarEvento);

   // for HTML5 "required" attribute
   $("select[required]").css({display: "inline", height: 0, padding: 0, width: 0});

   $(".vald").change(function(){
     $(this).removeClass("invalid");
   });

   //Manejador del botón de eliminar selección
   $("#delete-selection").on('click', function(){
     $("#delete-message").html("¿Confirma que desea eliminar los usuarios seleccionados?");
     dialogDelete();
   });

   //Cambiar el mensaje de la interfaz
   $(".brand-logo").html("&nbsp Eventos");

   //Se trae el número de hojas y elementos.
   definirPaginacion();
    //Llamar a la primera página de eventos cuando se inicializa.
    getEvents(paginaActiva);

});
