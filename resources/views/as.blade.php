@extends('adminlte::page')

@section('body')
<select style="width:300px" id="tahun">
    <option value="2020">2020</option>
    <option value="2021">2021</option>
</select>
<select style="width:300px" id="type">
</select>
<select style="width:300px" id="type1">
</select>

<div class="row">

    <div class="col-md-7 col-sm-15">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Grafik yang sudah dikerjakan</h3>
          <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <span class="label label-primary">Label</span>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <canvas id="line-chart" width="800" height="450"></canvas>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          The footer of the box
        </div>
        <!-- box-footer -->
      </div>
      <!-- /.box -->
    </div>
  
    <div class="row">
  
      <div class="col-md-7 col-sm-15">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Grafik yang akan dikerjakan</h3>
            <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
              <span class="label label-primary">Not Yet</span>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <canvas id="line-chartt" width="800" height="450"></canvas>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            The footer of the box
          </div>
          <!-- box-footer -->
        </div>
        <!-- /.box -->
      </div>
  
  
      <div class="row">
  
        <div class="col-md-7 col-sm-15">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik dalam Proses </h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary">Waiting</span>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <canvas id="line-charttt" width="800" height="450"></canvas>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              The footer of the box
            </div>
            <!-- box-footer -->
          </div>
          <!-- /.box -->
        </div>
  
      </div>

      <script>
          function showGraphic(closed, waiting, notYet){
            new Chart(document.getElementById("line-chart"), {
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



new Chart(document.getElementById("line-chartt"), {
type: 'line',
data: {
labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt', 'Nov', 'Des'],
datasets: [{ 
    data:  waiting,
    label: "Not Yet",
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


new Chart(document.getElementById("line-charttt"), {
type: 'line',
data: {
labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt', 'Nov', 'Des'],
datasets: [{ 
    data:  notYet,
    label: "Waiting",
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
       console.log(e['choice'].id);
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
showGraphic(myObjj['userArr'], myObjj['userArrt'], myObjj['usery'])
}
};
console.log(kecamatan)
xhttp.open("GET", "grafikData?q="+kecamatan+"&tahun="+tahun, true);
xhttp.send();
}
</script>
@endsection