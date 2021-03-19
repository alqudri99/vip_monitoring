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
            {!! Form::model($datas, ['route'=> ['karyawan.update', $datas->id], 'method'=>'PATCH']) !!}
            <div class="form-group">
              <label>Id karyawan</label>
                {!! Form::text('id_karyawan', null, ['class'=>'form-control', 'id'=>'id_karyawan ']) !!}
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <select id="id_jabatan" name="id_jabatan" class="form-control select2" style="width: 100%;">
                @foreach ($jabatan as $item)
                <?php if($datas->id_jabatan == $item->id) : ?>
              <option value="{{$item->id}}" selected="selected">{{$item->nama_jabatan}}</option>
                    <?php else : ?>
              <option  value="{{$item->id}}">{{$item->nama_jabatan}}</option>
                    <?php endif; ?>
                @endforeach
              </select>
            </div>
            <label>Nama</label>
            <div class="form-group">
                {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name ', 'required' => 'required']) !!}
            </div>
            <label>Email</label>
            <div class="form-group">
                {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'email ', 'required' => 'required']) !!}
            </div>
            <label>Tempat Lahir</label>
            <div class="form-group">
                {!! Form::text('tempat_lahir', null, ['class'=>'form-control', 'id'=>'email ', 'required' => 'required']) !!}
            </div>
            <label>Tanggal Lahir</label>
            <div class="form-group">
                {!! Form::date('tanggal_lahir', null, ['class'=>'form-control', 'id'=>'email ', 'required' => 'required']) !!}
            </div>
            <label>Nomor HP</label>
            <div class="form-group">
                {!! Form::text('no_hp', null, ['class'=>'form-control', 'id'=>'no_hp ', 'required' => 'required']) !!}
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