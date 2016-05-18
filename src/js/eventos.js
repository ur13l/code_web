var action;
var id;
var eventos;
var paginaActiva = 0;


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
 * Compara si la primera fecha es menor a la segunda.
 * @param  inputF1: Fecha de inicio
 * @param  inputH1: Hora de inicio
 * @param  inputF2: Fecha de finalización
 * @param  inputH2: Hora de finalización
 * @return {Boolean} true si las fechas son válidas, false de lo contrario
 */
function compararFechas(inputF1, inputH1, inputF2, inputH2){
    var fInicio = inputF1.val();
    var hInicio = inputH1.val();
    var fFin = inputF2.val();
    var hFin = inputH2.val();


    var f1 = moment(fInicio + " " + hInicio, "DD/MM/YYYY HH:mm");
    var f2 = moment(fFin + " " + hFin, "DD/MM/YYYY HH:mm");

    if (f1.isAfter(f2)){
      inputF2.addClass("invalid");
      inputH2.addClass("invalid");
        Materialize.toast('La fecha de inicio no puede ser posterior a la de finalización', 4000,'red')
    }

    return(f2.isAfter(f1));
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
    "<td>"+eventos[i].titulo+"</td>" +
    "<td>"+eventos[i].descripcion+"</td>" +
    "<td>"+fInicio+"</td>" +
    "<td>"+fFin+"</td>" +
    "<input type='hidden' value='"+eventos[i].tipo+"'>" +
    "<td><i class='material-icons delete' style='cursor:pointer'>delete</i></td>" +
    "</tr>";
    $("#tabla-eventos").append(elem);


  }
  //Cuando se selecciona un elemento de la tabla debe mostrarse el modal
  $(".item-evento").on('click', function(){
    action = 'update';
    id= $($(this).children()[0]).val()
    $('#modal1').openModal();
    $($("#titulo").val($($(this).children()[1]).html()).siblings()[0]).addClass("active");
    $($("#descripcion").val($($(this).children()[2]).html()).siblings()[0]).addClass("active");

    var f1 = $($(this).children()[3]).html();
    $("#fecha-inicio").val(moment(f1,"DD/MM/YYYY [a las] HH:mm").format("DD/MM/YYYY"));
    $($("#fecha-inicio").siblings("label")[0]).addClass("active");

    var f2 = $($(this).children()[4]).html();
    $("#fecha-fin").val(moment(f2,"DD/MM/YYYY [a las] HH:mm").format("DD/MM/YYYY"));
    $($("#fecha-fin").siblings("label")[0]).addClass("active");

    $("#hora-inicio").val(moment(f1,"DD/MM/YYYY [a las] HH:mm").format("HH:mm"));
    $($("#hora-inicio").siblings("label")[0]).addClass("active");

    $("#hora-fin").val(moment(f2,"DD/MM/YYYY [a las] HH:mm").format("HH:mm"));
    $($("#hora-fin").siblings("label")[0]).addClass("active");

    $('#tipo').val($($(this).children()[5]).val());
    $('#tipo').material_select();
  });

  $(".delete").on('click', function(){
    console.log($(this));
  })
}

/**
 * Función que define el número de páginas y elementos a mostrarse por cada página.
 * @return void
 */
function definirPaginacion(){
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
             visiblePages: 5,
             onPageClick: function (event, page) {
                 getEvents(page-1);
             }
         });
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

  //Se ejecuta al darle click al botón de más, permite configurar la acción a 'create'
   $('#new-event').on('click', function(){
     action = 'create';
     id = null;
   });

   $('#guardar-evento').on('click', function(){
      var emptyTitulo = isEmpty($('#titulo'));
      var emptyDescripcion = isEmpty($('#descripcion'));
      var emptyFInicio = isEmpty($('#fecha-inicio'));
      var emptyFFin = isEmpty($('#fecha-fin'));
      var emptyHInicio = isEmpty($('#hora-inicio'));
      var emptyHFin = isEmpty($('#hora-fin'));
      if( !emptyTitulo && !emptyDescripcion && !emptyFInicio && !emptyFFin && !emptyHInicio && !emptyHFin ){
        if(compararFechas($("#fecha-inicio"), $("#hora-inicio"), $("#fecha-fin"), $("#hora-fin"))){
          // Se arma el objeto a enviar
          var obj = {
            titulo: $('#titulo').val(),
            descripcion: $('#descripcion').val(),
            fecha_inicio: moment($("#fecha-inicio").val() +" "+ $("#hora-inicio").val(), "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm"),
            fecha_fin: moment($("#fecha-fin").val() +" "+ $("#hora-fin").val(), "DD/MM/YYYY HH:mm").format("YYYY-MM-DD HH:mm"),
            tipo: $("#tipo option:selected").val(),
            action: action,
            id: id
          };
          $.ajax({
              // la URL para la petición
              url : '../controller/eventos.php',

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
                  console.log(json);
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

   });

   // for HTML5 "required" attribute
   $("select[required]").css({display: "inline", height: 0, padding: 0, width: 0});

   $(".vald").change(function(){
     $(this).removeClass("invalid");
   });

   //Se trae el número de hojas y elementos.
   definirPaginacion();
    //Llamar a la primera página de eventos cuando se inicializa.
    getEvents(paginaActiva);

});
