@extends('adminlte::page')
@section('content')
<div class="container">
  
<div class="row">
  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="tahun">
      <option value="2020">2020</option>
      <option value="2021">2021</option>
    </select>
  </div>

  
  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="bulan">
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maret</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Agustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>
  </div>

  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="type">
    </select>
  </div>
  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="type1">
    </select>
  </div>

  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="qcstatus">
      <option value="Final">Final</option>
      <option value="On Progress">On Progress</option>
      <option value="Not Yet">Not Yet</option>
    </select>
  </div>

</div>


  <div class = "row">
      <div class = "col-md-10">

        <div class="box box-default">
          <div class="box-header with-border">
            <button class="btn-sm btn-danger" id="remBtn">Hai</button>
            <h3 class="box-title">Data BTS</h3>
  
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            
        <table class = "table table-striped" id="myTable">
          <thead>
            <tr>
              <th>Alamat Site</th>
              <th>Nama Site</th>
              <th>Activity Name</th>
              <th>Methode</th>
              <th>Tanggal Mulai</th>
              <th>Acceptance Date</th>
              <th>Sisa Waktu</th>
              <th>QC Status</th>
              <th>Aksi</th>
              </tr>
          </thead>
        <tbody>
          @php
              $o=0;
          @endphp
            @foreach($datas as $data)
            <tr>
              <td>{{$data->nama_kota}}, {{$data->nama_kecamatan}}</td>
            <td>{{$data->nama_site}}</td>
            <td>{{$data->nama_kegiatan}}</td>
            <td>{{$data->methode}}</td>
            <td>{{$data->tanggal_mulai}}</td>
            <td>{{$data->tanggal_habiskontrak}}</td>
            <td><div id="{{$o}}"></div></td>
            
            <td>{{$data->qc_status}}</td>
            <td>
            <a href="{{route('project.show', ['id'=>$data->id])}}" class="btn-sm btn-success">Detail</a>
            <a href="{{route('project.edit', ['id'=>$data->id])}}" class="btn-sm btn-warning">Edit</a>
            <form action="{{route('project.destroy',['id'=>$data->id])}}" method="POST">
            {{-- <input type="hidden" name="_method" value="DELETE"> --}}
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            <button type="submit" class="btn-sm btn-danger">Hapus</button>
            
              </form>
            </td>
            </tr>
            @php
                $o++;
            @endphp
            @endforeach
        </tbody>
        </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button id="bt" class="btn-sm btn-warning">Cetak</button>
          </div>
        </div>
        <h3 class="fa fa-arrow-circle-right"></h3>
        <!-- /.box -->
        <script>
          $(document).ready(function() {
          $('#myTable').DataTable();
      } );
      </script>
        {{-- @push('script') --}}


        <script>
  
          var pilih =  $('#type').select2();
        var tahunn = $('#tahun').select2();
        var kecamatann = $('#type1').select2();
        var qc = $('#qcstatus').select2();
        var bulan = $('#bulan').select2();
        // tahunn.append('<option  value='+23 + '>'+23 + '</option>');
        // tahunn.on("select2-selecting", function(e) {
        //    console.log(e['choice'].id);
        //    getGrafik(e['choice'].id, kecamatann.val())
        //  });
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
          // getGrafik(tahunn.val(), e['choice'].id)
         });
        
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var i = 0;
        var myObj = JSON.parse(this.responseText);
        var y = $.map(myObj, function(obj){
        obj.id = obj.id || obj.nama_kota 
        });
        console.log(myObj)
        // $('#type').select2('e,');
        for(i;i<myObj.length;i++){
        if(i==0){
         console.log(myObj[i].id)
        pilih.append('<option value='+myObj[i].id + '>'+myObj[i].nama_kota + '</option>');
        pilih.val(myObj[i].id).trigger('change');
        }else{
        pilih.append('<option  value='+myObj[i].id + '>'+myObj[i].nama_kota + '</option>');
        }
        
        }
        console.log('haaa' + pilih.val())
        getG(2021, pilih.val())
        // $('#type').select2('destroy');
        }
        };
        xhttp.open("GET", "getKota", true);
        xhttp.send();


        function open(){
          console.log("asasasa")
  window.location='http://127.0.0.1:8000/cetakproject?tahun='+tahunn.val()+'&bulan='+bulan.val()+'&kecamatan='+kecamatann.val()+'&qcstatus='+qc.val();
}
        </script>
<script>
    var button = document.getElementById('remBtn')

function removeReg(del_reg) {
  swal.fire({
      icon: "error",
      buttons: ['NO', 'YES'],
      dangerMode: true,
      html : ` <p style = "font-size: 20px; margin-left: 0px; text-align: left; border:0px solid black;">
        <b>Site yang akan dikerjakan Bulan ini</b>
      </p>
      <p style = "margin-left: 5%; border:0px solid black; text-align: left;">
        <i class="fa fa-arrow-circle-right" aria-hidden="true">Site Aripan akan dimulai dalam 1 Hari lagi</i>
      </p>
      <p style = "margin-left: 5%; border:0px solid black; text-align: left;">
        <i class="fa fa-arrow-circle-right" aria-hidden="true">Site Talago Biru Sitiung IV akan dimulai dalam 3 Hari lagi</i>
      </p>
      `
    })
    .then(function(value) {
      console.log('returned value:', value);
    });
}
var bt = document.getElementById('bt')
bt.addEventListener('click', function() {
 open()
});

button.addEventListener('click', function() {
  console.log('clicked on button')
  removeReg('SomeCustomRegName');
});


</script>


<script>
var timers = {};

var i;
var data = <?php echo $datas; ?>;

// for(i=0;i<data.length;i++){
//   var d = new Date(data[i].tanggal_mulai);
// timers.i = new Timer(document.getElementById(i));
// timers.i.countDown(new Date(data[i].tanggal_habiskontrak), new Date(data[i].tanggal_mulai), data[i].id, i);
// }

console.log("data" + data[0].id)
             function Timer(holder) {

var controller = {
    holder: holder,
    end: null,
    now : null,
    id : null,
    position : null,
    intervalID:0,
    display: function () {
    
    var noww = new Date();
        if(controller.now <= noww){
        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;

        var msg = "";

        
        var distance = controller.end - noww;
        if (distance < 0) {

            clearInterval(controller.intervalID);
            controller.holder.innerHTML = 'Tenggat Waktu';
            console.log(controller.position)
            if(data[controller.position].qc_status != 'Closed'){
              console.log('id: ' + controller.id + 'posotiton : ' + controller.position)
            qcUpdate(controller.id, 1)
            }
            return;
        }
        if(data[controller.position].qc_status != 'Waiting'){
              console.log('id: ' + controller.id + 'posotiton : ' + controller.position + 'mode : ' + data[controller.position].qc_status)
            qcUpdate(controller.id, 2)
            }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
        controller.holder.innerHTML = days + ' Hari | ' + hours + ' Jam | ' + minutes + ' Menit | ' + seconds + ' Seconds ';
        }else{
          if(data[controller.position].qc_status != 'Not Yet'){
              console.log('id: ' + controller.id + 'posotiton : ' + controller.position + 'mode : ' + data[controller.position].qc_status)
            qcUpdate(controller.id, 3)
            }
        controller.holder.innerHTML = 'Belum Mulai';
        }

    }
}

this.countDown = function (end, now, id, position) {
    controller.end = end;
    controller.now = now;
    controller.id = id;
    controller.position = position;
    controller.intervalID = setInterval(controller.display, 1000);
}
}




function qcUpdate(id, mode){

state = true;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  var html = ''
  console.log(this.response)
  document.location.reload(true)
}
};
xhttp.open("GET", "qc?id="+id+"&mode=" + mode, true);
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
// getGrafik(tahunn.val(), kecamatann.val())
}
};
xhttp.open("GET", "getKecamatan?q="+kecamatan, true);
xhttp.send();
}

  </script>
    

    
@endsection


