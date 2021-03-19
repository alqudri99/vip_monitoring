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
            {!! Form::model($data, ['route'=> ['kecamatan.update', $data->id], 'method'=>'PATCH']) !!}
            <div class="form-group">
              <label>Kota</label>
              <select id="id_kota" name="id_kota" class="form-control select2" style="width: 100%;">
                @foreach ($kota as $item)
                <option  value="{{$item->id}}">{{$item->name_kota}}</option>
                @endforeach
              </select>
            </div>
            <label>Nama Kecamatan</label>
            <div class="form-group">
                {!! Form::text('nama_kecamatan', null, ['class'=>'form-control', 'id'=>'nama_kecamatan ', 'required' => 'required']) !!}
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