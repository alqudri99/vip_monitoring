@extends('adminlte::page')

@section('title', 'kk')
@section('top-nav')

@endsection

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- /.info-box -->
    <div class="info-box bg-green">
      <span class="info-box-icon"><i class="fa fa-handshake-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Site Progress</span>
        <span class="info-box-number">{{$closed}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 50%"></div>
        </div>
        <span class="progress-description">
          Site yang sudah dikerjakan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <!-- /.info-box -->
  </div>

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- /.info-box -->
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-battery-half"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Site Progress</span>
        <span class="info-box-number">{{$waiting}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          Site dalam proses pengerjaan
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- /.info-box -->
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-toggle-off"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Site Progress</span>
        <span class="info-box-number">{{$notyet}}</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
          Site yang akan dikerjakan bulan ini
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->




<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">

    <select style="width:300px" id="tahun">
      <option value="2020">2020</option>
      <option value="2021">2021</option>
    </select>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">

    <select style="width:300px" id="type">
    </select>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12">

    <select style="width:300px" id="type1">
    </select>
  </div>

</div>

<div class="row">

  <div class="col-md-4 col-sm-6 col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!-- /.box -->
        <canvas id="line-chartt" width="800" height="450"></canvas>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
      <!-- box-footer -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  <div class="col-md-4 col-sm-6 col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!-- /.box -->
        <canvas id="line-charttt" width="800" height="450"></canvas>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
      <!-- box-footer -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  <div class="col-md-4 col-sm-6 col-xs-12">

    <div class="box">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
          <!-- Buttons, labels, and many other things can be placed here! -->
          <!-- Here is a label for example -->
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <!-- /.box -->
        <canvas id="line-chart" width="800" height="450"></canvas>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        The footer of the box
      </div>
      <!-- box-footer -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->



</div>


<script>
  
  function showGraphic(closed, waiting, notYet){
        new Chart(document.getElementById("line-chartt"), {
type: 'line',
data: {
labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt', 'Nov', 'Des'],
datasets: [{ 
    data: closed,
    label: "Yang Sudah Siap",
    borderColor: "#3e95cd",
    fill: false
  }
]
},
options: {
title: {
  display: true,
  text: 'Grafik site yang sudah dikerjakan per bulan'
}
}
});



new Chart(document.getElementById("line-charttt"), {
type: 'line',
data: {
labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt', 'Nov', 'Des'],
datasets: [{ 
data:  waiting,
label: "Waiting",
borderColor: "#33FF57",
fill: false
}
]
},
options: {
title: {
display: true,
text: 'Grafik site yang akan dikerjakan per bulan'
}
}
});


new Chart(document.getElementById("line-chart"), {
type: 'line',
data: {
labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt', 'Nov', 'Des'],
datasets: [{ 
data:  notYet,
label: "Not Yet",
borderColor: "#FF5733",
fill: false
}
]
},
options: {
title: {
display: true,
text: 'Grafik site dalam proses pengerjaan per bulan'
}
}
});
      }
</script>

<script>
  
  var pilih =  $('#type').select2();
var tahunn = $('#tahun').select2();
var kecamatann = $('#type1').select2();
tahunn.append('<option  value='+23 + '>'+23 + '</option>');
tahunn.on("select2-selecting", function(e) {
   console.log(e['choice'].id);
   getGrafik(e['choice'].id, kecamatann.val())
 });
 pilih.on("select2-opening", function(e) {
   console.log('Opening');
 });
 pilih.on("select2-selecting", function(e) {
   console.log(e['choice'].id);
   getG(2021, e['choice'].id)
 });

 
 

 kecamatann.on("select2-opening", function(e) {
   console.log('Opening');
 });
 kecamatann.on("select2-selecting", function(e) {
  getGrafik(tahunn.val(), e['choice'].id)
 });


var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
var i = 0;
var myObj = JSON.parse(this.responseText);
var y = $.map(myObj, function(obj){
obj.id = obj.id || obj.name_kota 
});
console.log(myObj)
// $('#type').select2('e,');
for(i;i<myObj.length;i++){
if(i==0){
 console.log(myObj[i].id)
pilih.append('<option value='+myObj[i].id + '>'+myObj[i].name_kota + '</option>');
pilih.val(myObj[i].id).trigger('change');
}else{
pilih.append('<option  value='+myObj[i].id + '>'+myObj[i].name_kota + '</option>');
}

}
console.log('haaa' + pilih.val())
getG(2021, pilih.val())
// $('#type').select2('destroy');
}
};
xhttp.open("GET", "getKota", true);
xhttp.send();
</script>

<script>
h()
function h(){
  console.log('haiiiiii')
}

getEws()
function getEws(){
  var data = <?php echo $user; ?>;
  
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
var i = 0;
var html = ''


var myObjj = JSON.parse(this.responseText);
console.log("gagaga" +myObjj.bulan_ini.length)
// console.log(myObjj.bulan_ini.length)

var x = 0;
for(x;x<=myObjj.selesai.length ;x++){
  console.log('gagaga')
  if(x == 0){
    html += ` <p style = "font-size: 20px; margin-left: 0px; text-align: left; border:0px solid black;">
        <b>Sisa waktu penyelasaian Site</b>
      </p>
      `
  }else{
    var j = x-1
    html =html+ `<p style = "margin-left: 5%; border:0px solid black; text-align: left;">
      <i class="fa fa-arrow-circle-right" aria-hidden="true">Site `+ myObjj.selesai[(j)].site_name +` akan dimulai dalam ` +myObjj.selesai[j].estimasi +` lagi</i>
      </p>
      `
  }
}


var t = 0;
for(t;t<=myObjj.hari_ini.length ;t++){
  console.log('gagaga')
  if(t == 0){
    html += ` <p style = "font-size: 20px; margin-left: 0px; text-align: left; border:0px solid black;">
        <b>Site yang akan dikerjakan Hari ini</b>
      </p>
      `
  }else{
    var j = t-1
    html =html+ `<p style = "margin-left: 5%; border:0px solid black; text-align: left;">
        <i class="fa fa-arrow-circle-right" aria-hidden="true">Site `+ myObjj.hari_ini[(j)].site_name +`</i>
      </p>
      `
  }
}
for(i;i<=myObjj.bulan_ini.length ;i++){
  if(i == 0){
    html += ` <p style = "font-size: 20px; margin-left: 0px; text-align: left; border:0px solid black;">
        <b>Site yang akan dikerjakan Bulan ini</b>
      </p>
      `
  }else{
    var j = i-1
    html =html+ `<p style = "margin-left: 5%; border:0px solid black; text-align: left;">
        <i class="fa fa-arrow-circle-right" aria-hidden="true">Site `+ myObjj.bulan_ini[(j)].site_name +` akan dimulai dalam ` +myObjj.bulan_ini[j].estimasi +` lagi</i>
      </p>
      `
  }
}
var bulan = myObjj.bulan_ini.length;
var hari = myObjj.bulan_ini.length;
var selesai = myObjj.selesai.length;

console.log("myObjj.hari_ini[0].site_name " + myObjj.hari_ini.length)
if(bulan == 0 || hari == 0 || selesai == 0){
  
}else{
  ews(html)
}
}
};

// console.log(kecamatan)
xhttp.open("GET", "ews?id=" +data, true);
xhttp.send();
}
  
  function getG(tahun, kecamatan){

    var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
var i = 0;
var myObjj = JSON.parse(this.responseText);
console.log(myObjj)
kecamatann.empty()
kecamatann.select2({});
for(i;i<myObjj.length;i++){
if(i==0){
    kecamatann.append('<option value='+myObjj[i].id + '>'+myObjj[i].nama_kecamatan + '</option>');
    kecamatann.val(myObjj[i].id).trigger('change');
}else{
    kecamatann.append('<option value='+myObjj[i].id + '>'+myObjj[i].nama_kecamatan + '</option>');
}

}
getGrafik(tahunn.val(), kecamatann.val())
}
};
xhttp.open("GET", "getKecamatan?q="+kecamatan, true);
xhttp.send();
}


function getGrafik(tahun, kecamatan){

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
var i = 0;
var myObjj = JSON.parse(this.responseText);
console.log(myObjj)
showGraphic(myObjj['closed'], myObjj['waiting'], myObjj['notYet'])
}
};
console.log(kecamatan)
xhttp.open("GET", "grafikData?q="+kecamatan+"&tahun="+tahun, true);
xhttp.send();
}


function ews(html) {
  swal.fire({
      icon: "error",
      buttons: ['NO', 'YES'],
      dangerMode: true,
      html : html
    })
    .then(function(value) {
      console.log('returned value:', value);
    });
}

</script>
@stop