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
          <form action="{{route('kecamatan.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label>Kota</label>
            <select id="id_kota" name="id_kota" class="form-control select2" style="width: 100%;">
              @foreach ($data as $item)
              <option  value="{{$item->id}}">{{$item->name_kota}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="name_kota">Nama Kecamatan</label>
            <input type="text" name="nama_kecamatan" class="form-control" id="nam_kecamatan"   placeholder="Nama Kota">
          </div>
          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
          </div>
        </div>
        </div>
        </div>
</div>

@endsection