/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	if(file.type == "video/mp4"){
    if(file.size <= 100000000){
      var formdata = new FormData();
    	formdata.append("file1", file);
    	var ajax = new XMLHttpRequest();
    	ajax.upload.addEventListener("progress", progressHandler, false);
    	ajax.addEventListener("load", completeHandler, false);
    	ajax.addEventListener("error", errorHandler, false);
    	ajax.addEventListener("abort", abortHandler, false);
    	ajax.open("POST", "../controller/video.php");
    	ajax.send(formdata);
    }
    else{
        Materialize.toast("El video no puede ser mayor de 100Mb", 4000, "red");
    }
  }
  else {
    Materialize.toast("El formato del archivo debe ser mp4", 4000, "red");
  }

}
function progressHandler(event){
	var percent = (event.loaded / event.total) * 100;
  $(".determinate").css("width", Math.round(percent)+"%")

}
function completeHandler(event){
	$(".determinate").css("width", "0%");
  Materialize.toast("Video subido correctamente", 4000, "green");
  location.reload();
}
function errorHandler(event){
  Materialize.toast("Hubo un error al cargar su video.", 4000, "green");
}
function abortHandler(event){
	  Materialize.toast("Subida de video cancelada", 4000, "green");
}
