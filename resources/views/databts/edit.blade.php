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
            {!! Form::model($datas, ['route'=> ['databts.update', $datas->id], 'method'=>'PUT']) !!}
            <div class="form-group">
              {!! Form::text('nama_bts', null, ['class'=>'form-control', 'id'=>'nama_bts ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('rbs_type', null, ['class'=>'form-control', 'id'=>'rbs_type ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('type_ru', null, ['class'=>'form-control', 'id'=>'type_ru']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('company', null, ['class'=>'form-control', 'id'=>'company ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('frekuensi', null, ['class'=>'form-control', 'id'=>'frekuensi ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('band', null, ['class'=>'form-control', 'id'=>'nama_jabatan ']) !!}
            </div>

            <div class="form-group">
              {!! Form::text('tac', null, ['class'=>'form-control', 'id'=>'tac ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('ci', null, ['class'=>'form-control', 'id'=>'ci ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('ip_address', null, ['class'=>'form-control', 'id'=>'ip_address ']) !!}
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