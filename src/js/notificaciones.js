var action;
var id;
var notificaciones;
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

      return true;
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
function getNotifications(page){
  var obj = {
    page: page
  };
  $.ajax({
      url : '../controller/readNotifications.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
          notificaciones = json;
          renderizarNotificaciones();
      },
      error : function(xhr, status) {
        console.log(xhr);
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },

  });
}

/**
 * Función para mostrar los campos de los eventos.
 * @return {[type]} [description]
 */
function renderizarNotificaciones(){
  $("#tabla-notificaciones").html("");
  for (var i = 0 ; i < notificaciones.length; i++){
    var fInicio = moment(notificaciones[i].fecha_emision, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY HH:mm");

    var elem = "<tr  class='item-notificacion'>" +
    "<input type='hidden' value='"+notificaciones[i].id_notificacion+"'>" +
    "<td> <input type='checkbox' id='chk"+notificaciones[i].id_notificacion+"' class='filled-in checkbox-green-code chk'/>  <label for='chk"+notificaciones[i].id_notificacion+"'></label></td>" +
    "<td>"+notificaciones[i].titulo+"</td>" +
    "<td>"+notificaciones[i].mensaje+"</td>" +
    "<td>"+fInicio+"</td>" +
    "<td class='delete' style='cursor:pointer'><i class='material-icons'>delete</i></td>" +
    "</tr>";
    $("#tabla-notificaciones").append(elem);


  }

  $(".delete").on('click', function(){
    eliminarIds = [$(this).parent().children()[0].value];
    $("#delete-message").html("¿Desea eliminar el evento \""+$(this).parent().children()[2].innerHTML+"\"?");
    dialogDelete();
  });

  $(".chk").on('change', function(){
    var arr = $("#tabla-notificaciones").children();
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
  $.ajax({
      url : '../controller/paginacionNotificaciones.php',
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        //Mostrar paginación
        $('#pagination-demo').twbsPagination({
             totalPages: Math.ceil(json.pages/10),
             visiblePages: 7,
             first: "Primera",
              prev: "Anterior",
              next: "Siguiente",
              last: "Última",
             onPageClick: function (event, page) {
                paginaActiva = page-1;
                 getNotifications(page-1);
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
function deleteNotifications(){
  var obj = {
    ids: JSON.stringify(eliminarIds)
  };
  $.ajax({
      url : '../controller/deleteNotification.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        $('#deleteModal').closeModal();
        getNotifications(paginaActiva);
        definirPaginacion();
      },
      error : function(xhr, status) {
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },
  });
  definirPaginacion();
  getEvents(paginaActiva);
  $("#deleteModal").closeModal();
}

function validacionesModal(){
  $("#chk_hombre").change(function(){
    if(!$(this).is(":checked")){
      if(!$("#chk_mujer").is(":checked")){
        $("#chk_mujer").prop("checked", true);
      }
    }
  });

  $("#chk_mujer").change(function(){
    if(!$(this).is(":checked")){
      if(!$("#chk_hombre").is(":checked")){
        $("#chk_hombre").prop("checked", true);
      }
    }
  });

  $("#chk_android").change(function(){
    if(!$(this).is(":checked")){
      if(!$("#chk_ios").is(":checked")){
        $("#chk_ios").prop("checked", true);
      }
    }
  });

  $("#chk_ios").change(function(){
    if(!$(this).is(":checked")){
      if(!$("#chk_android").is(":checked")){
        $("#chk_android").prop("checked", true);
      }
    }
  });

  $("#sl_rango_edad").change(function(){
     if(this.value > 1){
       $("#txt_age1").css("display", "inline");
       $("#label_age").css("display", "inline");
       $("#txt_age2").css("display", "none");
     }

     if(this.value == 2){
      $("#txt_age2").css("display", "inline");
     }

     if(this.value == 1){
      $("#txt_age1").css("display", "none");
      $("#txt_age2").css("display", "none");
      $("#label_age").css("display", "none");

     }
  });
}

function enviarNotificacion(){
    var tituloEmpty = isEmpty($("#titulo"));
    var mensajeEmpty = isEmpty($("#mensaje"));

    if(!tituloEmpty && !mensajeEmpty){
      $("#enviar").addClass('disabled');
      $("#enviar").prop('disabled', true);
      $('#enviar').removeClass('waves-effect')
      newNotification();
    }
}

function newNotification(){
  var obj = {
    action: 'create',
    titulo: $("#titulo").val(),
    mensaje: $("#mensaje").val(),
    enlace: $("#enlace").val(),
    schedule: $("#chk_schedule").is(":checked"),
    fecha: $("#fecha").val(),
    hora: $("#hora").val(),
    hombre: $("#chk_hombre").is(":checked"),
    mujer: $("#chk_mujer").is(":checked"),
    presion: $("#chk_presion").is(":checked"),
    glucosa: $("#chk_glucosa").is(":checked"),
    rango: $("#sl_rango_edad").val(),
    age1: $("#txt_age1").val(),
    age2: $("#txt_age2").val(),
    android: $("#chk_android").is(":checked"),
    ios: $("#chk_ios").is(":checked")
  };

  $.ajax({
      url : '../controller/notificaciones.php',
      data : obj,
      type : 'POST',
      dataType : 'json',
      success : function(json) {
        Materialize.toast("Mensaje entregado con éxito", 4000, "green");
        limpiarCampos()
        getNotifications(paginaActiva);
        definirPaginacion();
        $("#enviar").removeClass('disabled');
        $("#enviar").addClass('waves-effect');
        $("#enviar").prop('disabled', false);
        $("#enviar").unbind('click', false);
        //$("#enviar").on('click', enviarNotificacion);
      },
      error : function(xhr, status) {
          Materialize.toast("Hubo un error al procesar su solicitud", 4000, "red");
      },
  });

}

/**
 * Limpia los campos de la ventana modal de nuevo/modificar evento
 * @return void
 */
function limpiarCampos(){
  $("#titulo").val("");
  $("#mensaje").val("");
}

$(document).ready(function(){

  //Configuración para generar el SideNav
  $(".button-collapse").sideNav();

  //Configuración para abrir modal
  $('.modal-trigger').leanModal();

  //Definiendo el slider
  noUiSlider.create(document.getElementById("connect"), {
  start: [20, 80],
  connect: true,
  step: 1,
  range: {
    'min': 0,
    'max': 122
  },
  format: wNumb({
    decimals: 0
  })
 });

  //Configuración del datePicker
  $('.datepicker').pickadate({
    labelMonthNext: 'Siguiente',
    labelMonthPrev: 'Anterior',
    labelMonthSelect: 'Selecciona un mes',
    labelYearSelect: 'Selecciona un año',
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
    weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
    weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb' ],
    weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',
    format: "dd/mm/yyyy",
    modal: false
  });

  //Configuración del TimePicker
  $('.timepicker').lolliclock({
    autoclose:true,
    hour24: true
  });

  //Necesario para sustituir el select común de HTML5 por el de Materialize
   $('select').material_select();

   $('#titulo').on("focus", function(){
     $(this).removeClass("invalid");
   });

   $('#mensaje').on("focus", function(){
     $(this).removeClass("invalid");
   });

   validacionesModal();

   $("#enviar").on('click',enviarNotificacion);

   //Manejador del botón de eliminar selección
   $("#delete-selection").on('click', function(){
     $("#delete-message").html("¿Confirma que desea eliminar las notificaciones seleccionadas?");
     dialogDelete();
   });

   definirPaginacion();

   getNotifications(paginaActiva);
});
