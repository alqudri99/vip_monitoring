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
          <form action="{{route('jabatan.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="id_jabatan">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan"   placeholder="Nama jabatan">
          </div>
        
        
        
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
          </div>
        </div>
        </div>
        </div>
</div>

@endsection