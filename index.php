 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
<meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body>
    <div class="container" style="background-color: #6970ff;">
    <div class="row">
  <div class="col">
  Port:<p id='platform1'>undefined</p>
  </div>
  <div class="col">
  url:<p id='platform2'>undefined </p>
  </div>
  <div class="col">
     <!-- dropdown -->
     <div class="dropdown">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
    Funciones
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="javascript:addPlatform();">Agregar plataforma</a>
    <a class="dropdown-item" href="JavaScript:selectPlatform();"> Seleccionar Plataforma</a>
    <a class="dropdown-item" href="JavaScript:getInfo();"> /info/</a>
    <a class="dropdown-item" href="JavaScript:getSearch();"> /search/</a>
    <a class="dropdown-item" href="JavaScript:getChange();"> /change/</a>
    
  </div>
</div> 
</div>
  </div>
  </div>
  <div class="container" style="background-color: #969695;">
  <div class="row">
  <div class="col">
  
   <!-- form -->
   <div class='container' id="generalForm">
  
  </div>

  </div>
  <div class="col"></div>
</div>
</div>
<br>
<div id="console" class="container" style="background-color: #969696; color: white;  height: 150px; overflow: auto; display: flex; flex-direction: column-reverse; font-size: 15px;">
<div class="row">
  <h6>Console</h6><br><div class="spinner-border text-info"></div>
   -> Running
	<div id="consoleCol" class="col">
   <p id="textConsole"></p>
	</div>
</div>
	
</div>
</div>


  </body>
  <script>

    var ip = null;
    var port = null;
    
    var hw ='';
    let body = [];
  function insertPlatform(){
    var id = $("#pltfrm").val();
    var url = $("#url").val();
    const toPush = [id, url];
    body.push(toPush);
    this.ip=url;
    this.port=id;
    $("#platform1").html(id);
    $("#platform2").html(url);
    var currText = $("#textConsole").text();
    var currHtml = $("#consoleCol").html();
    $("#textConsole").html(currHtml +''+ '->'+'inserted port: '+ id + ' and url: '+ url+''); 


    
   

  }
  function changeHw(){

    var hardwareselected = $("#hwidchange").val();
    var status = $("#status").val();
    var freq = $("#freq").val();
    var desc = $("#desc").val();
    $.ajax({
   url: "api.php?ip="+this.ip+"&port="+this.port,
   data: {myData: 'getChange', hw: hardwareselected, stts: status, frecuencia: freq, txt: desc},
   type: 'POST',
   success: function(response) {
       var currHtml = $("#consoleCol").html();
       $("#textConsole").html(currHtml +''+ '->'+response);
   },
   error: function(err){
     console.log(err);
   }
});

  }
  function getChange(){
    if(this.hw==''){
      alert("do /search/ ");  

      }
      else{
        var htmls = $("#generalForm");
      var request_form = `<form action="">
  <div class="form-group">
    <label for="id">Hardware id</label>
    <input type="text" class="form-control" id="hwidchange" readonly value='${this.hw}'>
  </div>
  <div class="form-group">
    <label for="url">status:</label>
    <input type="text" class="form-control" id="status">
  </div>
  <div class="form-group">
    <label for="url">Frecuencia:</label>
    <input type="text" class="form-control" id="freq">
  </div>
  <div class="form-group">
    <label for="url">Descripcion:</label>
    <input type="text" class="form-control" id="desc">
  </div>
  <button type="button" onclick="changeHw()" class="btn btn-primary">Submit</button>
</form> `;
htmls.html(request_form);

      }
 
    
  }
  function selectdude(){
  theValue =  document.getElementById("pltfrm").value;
  var index = 0;
  var selectedPort = 0;
  var selectedHost = '';
  for(var i = 0; i<body.length; i++){
    for(var j = 0; j<body[i].length; j++){
      if(body[i][j] == theValue){
        selectedPort = body[i][0];
        selectedHost = body[i][1];
        index = i;
      }
    }
  }
  alert('port : ' + selectedPort + 'host: '+ selectedHost);
  this.ip = selectedHost;
  this.port = selectedPort;
  var id = selectedPort;
  var url = selectedHost;
  $("#platform1").html(id);
    $("#platform2").html(url);

  }
  function selectPlatform(){
    if(this.ip == null){
      alert("ingrese ip ");
    }
    else{
    var htmls = $("#generalForm");
    var selectForm = `<select id='pltfrm'>`;
    for(var i = 0; i < body.length; i++){
      selectForm += `<option>${body[i][1]}</option>`;

    }
    selectForm += `</select> <button type="button" onclick="selectdude()" class="btn btn-primary">Aceptar</button>`;
htmls.html(selectForm );
}
  }
    function addPlatform(){
      var htmls = $("#generalForm");
      var request_form = `<form action="">
  <div class="form-group">
    <label for="id">puerto plataforma:</label>
    <input type="text" class="form-control" id="pltfrm">
  </div>
  <div class="form-group">
    <label for="url">url:</label>
    <input type="text" class="form-control" id="url">
  </div>
  <button type="button" onclick="insertPlatform()" class="btn btn-primary">Submit</button>
</form> `;
htmls.html(request_form);
      
    }
    function getInfo(){
      // if($("#platform1").text())
      
      if(this.ip!=null){
        console.log(this.ip);
        var currHtml = $("#consoleCol").html();
       $("#textConsole").html(currHtml +''+ '->'+'Creating HTTP request to ... '+ this.ip+'/info/');
      // $.post( this.ip+'/info/', function( data ) {
      //    var currHtml = $("#consoleCol").html();
      //  $("#textConsole").html(currHtml +''+ '->'+'OK '+ data+'');
      // });
      var myJSONobj = {id:"FE_CC8Project001", url:"<?php echo $_SERVER['SERVER_ADDR']; ?>", "​date​":"daes"};
      var http = new XMLHttpRequest();
      var url2 = this.ip;
      var params = JSON.stringify(myJSONobj);
      console.log(params);
      $.ajax({
   url: "api.php?ip="+this.ip+"&port="+this.port,
   data: {myData: 'getInfo'},
   type: 'POST',
   success: function(response) {
       var currHtml = $("#consoleCol").html();
       $("#textConsole").html(currHtml +''+ '->'+response);
   },
   error: function(err){
     console.log(err);
   }
});
      }
      else{

        alert("Ingrese una url y un puerto");
      }
    }

    var searchArray = Array();
    var nwresponse ='';
    function doSearch(){
      var currHtml = $("#consoleCol").html();
       $("#textConsole").html(currHtml +''+ '->'+'Creating HTTP request to ... '+ this.ip+'/search/');
       const hardware = $("#idhw").val();
       this.hw = hardware;
       const datei = $("#inicial").val();
       const datef = $("#final").val();
       console.log(hardware +" "+ datei + " " + datef);
       $.ajax({
   url: "api.php?ip="+this.ip+"&port="+this.port,
   data: {myData:'getSearch', hw: hardware, initial: datei, final: datef },
   type: 'POST',
   success: function(response) {
       var currHtml = $("#consoleCol").html();
       $("#textConsole").html(currHtml +''+ '->'+response);
      
   }
});


    }

    function getSearch(){
      if(this.ip!=null){
        var htmls = $("#generalForm");
        var formularioSearch = `<form action="">
  <div class="form-group">
    <label for="id">id hardware (CASESENSITIVE):</label>
    <input type="text" class="form-control" id="idhw">
  </div>
  <div class="form-group">
    <label for="id">Fecha Inicial:</label>
    <input type="datetime-local" class="form-control" id="inicial">
  </div>
  <div class="form-group">
    <label for="id">Fecha final:</label>
    <input type="datetime-local" class="form-control" id="final">
  </div>
  <button type="button" onclick="doSearch()" class="btn btn-primary">Submit</button>
</form> `
        htmls.html(formularioSearch);
      }
      else{
        alert("Ingrese una plataforma");
      }
    }



  </script>
</html>


