@extends('adminlte::page')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          Input Data
        </div>
        <div class="card-body">
          {!! Form::model($data, ['route'=> ['site.update', $data->id], 'method'=>'PATCH']) !!}
          <div class="form-group">
            <label>Merek BTS</label>
            <select id="id_bts" name="id_bts" class="form-control select2" style="width: 100%;">
              @foreach ($bts as $item)
              <?php if($data->id_bts == $item->id) : ?>
              <option value="{{$item->id}}" selected="selected">{{$item->nama_bts}}</option>
              <?php else : ?>
              <option value="{{$item->id}}">{{$item->nama_bts}}</option>
              <?php endif; ?>
              @endforeach
            </select>
          </div>
          <label>Site Name</label>
          <div class="form-group">
            {!! Form::text('site_name', null, ['class'=>'form-control', 'id'=>'site_name ', 'required' => 'required'])
            !!}
          </div>
          <label>Acceptance Date</label>
          <div class="form-group">
            {!! Form::date('acceptance_date', null, ['class'=>'form-control', 'id'=>'acceptance_date ', 'required' =>
            'required', 'disabled'=>'disabled']) !!}
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