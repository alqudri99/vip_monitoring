@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
        <a href="{{route('jabatan.create')}}" class="btn-sm btn-danger">Tambah Pegawai</a>
        <div class="card">
          <div class="card-header">
            Input Data
          </div>
          <div class="card-body">
          <form action="{{route('databts.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="nama_bts">Nama BTS</label>
            <input type="text" name="nama_bts" class="form-control" id="nama_bts"   placeholder="Nama BTS">
          </div>
          <div class="form-group">
            <label for="rbs_type">RBS Type</label>
            <input type="text" name="rbs_type" class="form-control" id="rbs_type"   placeholder="RBS Type">
          </div>

          <div class="form-group">
            <label for="type_ru">Type RU</label>
            <input type="text" name="type_ru" class="form-control" id="type_ru"   placeholder="Type RU">
          </div>

          <div class="form-group">
            <label for="company">Company</label>
            <input type="text" name="company" class="form-control" id="company"   placeholder="Company">
          </div>

          <div class="form-group">
            <label for="bandwidth">Frekuensi</label>
            <input type="text" name="frekuensi" class="form-control" id="frekuensi"   placeholder="Frekuensi">
          </div>

          <div class="form-group">
            <label for="band">Band</label>
            <input type="text" name="band" class="form-control" id="band"   placeholder="Band">
          </div>

          <div class="form-group">
            <label for="band">TAC</label>
            <input type="text" name="tac" class="form-control" id="tac"   placeholder="TAC">
          </div>

          <div class="form-group">
            <label for="band">CI</label>
            <input type="text" name="ci" class="form-control" id="ci"   placeholder="CI">
          </div>

          <div class="form-group">
            <label for="band">Ip Address</label>
            <input type="text" name="ip_address" class="form-control" id="ip_address"   placeholder="Ip Address">
          </div>
        
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
          </div>
        </div>
        </div>
        </div>
</div>

@endsection