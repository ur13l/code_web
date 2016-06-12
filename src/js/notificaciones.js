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
function getEvents(page){
  var obj = {
    page: page,
    action: 'read'
  };
  $.ajax({
      url : '../controller/eventos.php',
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
    var fInicio = moment(eventos[i].fecha_inicio, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY [a las] HH:mm");
    var fFin = moment(eventos[i].fecha_fin, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY [a las] HH:mm");

    var elem = "<tr  class='item-evento'>" +
    "<input type='hidden' value='"+eventos[i].id_evento+"'>" +
    "<td> <input type='checkbox' id='chk"+eventos[i].id_evento+"' class='filled-in chk'/>  <label for='chk"+eventos[i].id_evento+"'></label></td>" +
    "<td>"+eventos[i].titulo+"</td>" +
    "<td>"+eventos[i].descripcion+"</td>" +
    "<td>"+fInicio+"</td>" +
    "<td>"+fFin+"</td>" +
    "<input type='hidden' value='"+eventos[i].tipo+"'>" +
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
    $($("#titulo").val($($(this).parent().children()[2]).html()).siblings()[0]).addClass("active");
    $($("#descripcion").val($($(this).parent().children()[3]).html()).siblings()[0]).addClass("active");

    var f1 = $($(this).parent().children()[4]).html();
    $("#fecha-inicio").val(moment(f1,"DD/MM/YYYY [a las] HH:mm").format("DD/MM/YYYY"));
    $($("#fecha-inicio").siblings("label")[0]).addClass("active");

    var f2 = $($(this).parent().children()[5]).html();
    $("#fecha-fin").val(moment(f2,"DD/MM/YYYY [a las] HH:mm").format("DD/MM/YYYY"));
    $($("#fecha-fin").siblings("label")[0]).addClass("active");

    $("#hora-inicio").val(moment(f1,"DD/MM/YYYY [a las] HH:mm").format("HH:mm"));
    $($("#hora-inicio").siblings("label")[0]).addClass("active");

    $("#hora-fin").val(moment(f2,"DD/MM/YYYY [a las] HH:mm").format("HH:mm"));
    $($("#hora-fin").siblings("label")[0]).addClass("active");

    $('#tipo').val($($(this).parent().children()[6]).val());
    $('#tipo').material_select();
  });

  $(".delete").on('click', function(){
    eliminarIds = [$(this).parent().children()[0].value];
    $("#delete-message").html("¿Desea eliminar el evento \""+$(this).parent().children()[2].innerHTML+"\"?");
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
      url : '../controller/eventos.php',
      data : obj,
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
      url : '../controller/eventos.php',
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
    console.log("LOL");
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

function newNotification(){
  var obj = {
    action: 'create',
    titulo: $("#titulo").val(),
    mensaje: $("#mensaje").val(),
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
        console.log(json);
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
  $("#descripcion").val("");
  $("#fecha-inicio").val("");
  $("#hora-inicio").val("");
  $("#fecha-fin").val("");
  $("#hora-fin").val("");
  $('#tipo').val("1");
  $('#tipo').material_select();
}

$(document).ready(function(){

  //Configuración para generar el SideNav
  $(".button-collapse").sideNav();

  //Configuración para abrir modal
  $('.modal-trigger').leanModal();

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

   validacionesModal();

   $("#enviar").on('click', function(){
     var tituloEmpty = isEmpty($("#titulo"));
     var mensajeEmpty = isEmpty($("#mensaje"));
     if(!tituloEmpty && !mensajeEmpty){
       newNotification();
     }
     else{
       console.log("WOW");
     }
   });
});
