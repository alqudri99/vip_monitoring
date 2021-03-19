@extends('adminlte::page')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detail SIte Project</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th>Nama Site</th>
                <th>Nama BTS</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($datasite as $item)
              <tr>
                <td>{{$item['site_name']}}</td>
                <td>{{$item['nama_bts']}}</td>
                <td>{{$item['nama_kecamatan']}}, {{$item['name_kota']}}</td>
              </tr> 
              @endforeach 

            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detail Crew Project</h3>
        </div>
        <div class="box-body">
          <table class="table" id="tabel">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Nomor HP</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($crew as $item)
              <tr>
                <td>{{$no}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['nama_jabatan']}}</td>
                <td>{{$item['no_hp']}}</td>
                <td>{{$item['email']}}</td>
              </tr>
              @php
              $no++;
              @endphp
              @endforeach 

            </tbody>
          </table>
        </div>



  </div>

</div>

@endsection

@push('script')
<script>
  $(document).ready(function (){
    $('#tabel').DataTable()
  })
</script>
@endpush