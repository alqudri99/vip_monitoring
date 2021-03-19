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
          <form action="{{route('kota.store')}}" method="POST">
          @csrf
          {{-- <div class="form-group">
            <label>Jabatan</label>
            <select id="id_jabatan" name="id_jabatan" class="form-control select2" style="width: 100%;">
              @foreach ($data as $item)
              <option  value="{{$item->id}}">{{$item->nama_bts}}</option>
              @endforeach
            </select>
          </div> --}}
          <div class="form-group">
            <label for="name_kota">Nama Kota</label>
            <input type="text" name="name_kota" class="form-control" id="name_kota"   placeholder="Nama Kota">
          </div>
          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
          </div>
        </div>
        </div>
        </div>
</div>

@endsection