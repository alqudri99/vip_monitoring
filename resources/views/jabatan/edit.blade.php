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
            {!! Form::model($datas, ['route'=> ['jabatan.update', $datas->id], 'method'=>'PUT']) !!}
            <div class="form-group">
                {!! Form::text('nama_jabatan', null, ['class'=>'form-control', 'id'=>'nama_jabatan ']) !!}
            </div>
           
            <div class="form-group">
                {!! Form::submit('Edit', ['class'=>'btn-sm btn-success']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        </div>
        </div>
</div>

@endsection