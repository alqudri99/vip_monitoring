@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
        <div class="card">
          <div class="card-header">
            Input Data
          </div>
          <div class="card-body">
            {!! Form::model($data, ['route'=> ['kota.update', $data->id], 'method'=>'PATCH']) !!}
            <label>Nama kota</label>
            <div class="form-group">
                {!! Form::text('name_kota', null, ['class'=>'form-control', 'id'=>'name_kota ', 'required' => 'required']) !!}
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