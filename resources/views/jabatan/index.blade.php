@extends('adminlte::page')
@section('content')
<div class="container">
  <div class = "row">
      <div class = "col-md-10">

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Data Karyawan</h3>
  
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
              <th>Id Jabatan</th>
              <th>Jabatan</th>
              <th>Aksi</th>
              </tr>
          </thead>
        <tbody>

          @foreach($datas as $data)
          <tr>
          <td>{{$data->id}}</td>
          <td>{{$data->nama_jabatan}}</td>
          <td>
          <a href="{{route('jabatan.edit', ['id'=>$data->id])}}" class="btn-sm btn-warning">Edit</a>
          <form action="{{route('jabatan.destroy',['id'=>$data->id])}}" method="POST">
          {{-- <input type="hidden" name="_method" value="DELETE"> --}}
          @csrf
          <input type="hidden" name="_method" value="DELETE">
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          <button type="submit" class="btn-sm btn-danger">Hapus</button>
          
            </form>
          </td>
          </tr>
          @endforeach
          <button id="remBtn" class="btn-sm btn-success">Remove Registered Name</button>
              <span id="cd-days">00</span> Days 
              <span id="cd-hours">00</span> Hours
              <span id="cd-minutes">00</span> Minutes
              <span id="cd-seconds">00</span> Seconds
        </tbody>
        </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          </div>
        </div>
        <!-- /.box -->
          
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
 
//using the function
const today = new Date()
const tomorrow = new Date(today)
tomorrow.setDate(tomorrow.getDate() + 1)
timer(tomorrow);
</script>
    

    
@endsection


