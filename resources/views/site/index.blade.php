@extends('adminlte::page')
@section('content')
<div class="container">
   
<div class="row">
 

  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="type">
    </select>
  </div>
  <div class="col-md-2 col-sm-6 col-xs-12">

    <select style="width:200px" id="type1">
    </select>
  </div>
  
  <div class="col-md-2 col-sm-6 col-xs-12">
    <button id="bt" class="btn-sm btn-warning">Cetak</button>
  </div>
  



</div>

  <div class = "row">
      <div class = "col-md-10">

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Data Site</h3>
  
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            
        <table class = "table table-striped" id="data_users_reguler">
          <thead>
            <tr>
              <th>Nama BTS</th>
              <th>Nama Site</th>
              <th>Alamat Site</th>
              <th>Aksi</th>
              </tr>
          </thead>
        <tbody>
            @foreach($datas as $data)
            <tr>
            <td>{{$data->nama_bts}}</td>
            <td>{{$data->site_name}}</td>
            <td>{{$data->name_kota}}, {{$data->nama_kecamatan}}</td>
            <td>
            <a href="{{route('site.edit', ['id'=>$data->id])}}" class="btn-sm btn-warning">Edit</a>
            <form action="{{route('site.destroy',['id'=>$data->id])}}" method="POST">
            {{-- <input type="hidden" name="_method" value="DELETE"> --}}
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            <button type="submit" class="btn-sm btn-danger">Hapus</button>
            
              </form>
            </td>
            </tr>
            @endforeach
        </tbody>
        </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button id="bt" class="btn-sm btn-warning">Cetak</button>
          </div>
        </div>
        <!-- /.box -->
          
      {{-- @push('script') --}}


      <script>

        var pilih =  $('#type').select2();
      var kecamatann = $('#type1').select2();
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
window.location='http://127.0.0.1:8000/cetaksite?kecamatan='+kecamatann.val();
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

        <script>
          $(document).ready(function() {
          $('#data_users_reguler').DataTable();
      } );
      </script>
<script>
    var button = document.getElementById('remBtn')

function removeReg(del_reg) {
  swal.fire({
      text: "Are you sure you want to delete? \n the reg name : " + del_reg,
      icon: "error",
      buttons: ['NO', 'YES'],
      dangerMode: true
    })
    .then(function(value) {
      console.log('returned value:', value);
    });
}

button.addEventListener('click', function() {
  console.log('clicked on button')
  removeReg('SomeCustomRegName');
});
</script>

{{-- @push('script') --}}
<script>
    function removeReg(del_reg) {
  swal.fire({
      text: "Are you sure you want to delete? \n the reg name : " + del_reg,
      icon: "error",
      buttons: ['NO', 'YES'],
      dangerMode: true
    })
    .then(function(value) {
      console.log('returned value:', value);
    });
}
    let timer = function (date) {
    let timer = Math.round(new Date(date).getTime()/1000) - Math.round(new Date().getTime()/1000);
		let minutes, seconds;
		setInterval(function () {
            if (--timer < 0) {
				timer = 0;
			}
			days = parseInt(timer / 60 / 60 / 24, 10);
			hours = parseInt((timer / 60 / 60) % 24, 10);
			minutes = parseInt((timer / 60) % 60, 10);
			seconds = parseInt(timer % 60, 10);

			days = days < 10 ? "0" + days : days;
			hours = hours < 10 ? "0" + hours : hours;
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

            if(days == 0 && hours == 23 && minutes == 59 && seconds == 50){
                removeReg('ajhsja');
            }

			document.getElementById('cd-days').innerHTML = days;
			document.getElementById('cd-hours').innerHTML = hours;
			document.getElementById('cd-minutes').innerHTML = minutes;
			document.getElementById('cd-seconds').innerHTML = seconds;
		}, 1000);
	}
  var bt = document.getElementById('bt')
bt.addEventListener('click', function() {
 open()
});
//using the function
const today = new Date()
const tomorrow = new Date(today)
tomorrow.setDate(tomorrow.getDate() + 1)
timer(tomorrow);
</script>
    

    
@endsection


