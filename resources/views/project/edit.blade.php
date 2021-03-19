@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
        <a href="{{route('project.create')}}" class="btn-sm btn-danger">Tambah Pegawai</a>
        <div class="card">
          <div class="card-header">
            Input project
          </div>
          <div class="card-body">
            {!! Form::model($project, ['route'=> ['project.update', $project->id], 'method'=>'PUT']) !!}

            <div class="form-group">
              <label>Site Name</label>
              <select id="id_site" name="id_site" class="form-control select2" style="width: 100%;">
                @foreach ($tempat as $item)
                <?php if($project->id_site == $item->id) : ?>
              <option value="{{$item->id}}" selected="selected">{{$item->site_name}}</option>
                    <?php else : ?>
              <option  value="{{$item->id}}">{{$item->site_name}}</option>
                    <?php endif; ?>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              {!! Form::text('activity_name', null, ['class'=>'form-control', 'id'=>'activity_name ']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('methode', null, ['class'=>'form-control', 'id'=>'methode ']) !!}
            </div>
            
            <div class="form-group">
              {!! Form::input('dateTime-local', 'tanggal_mulai', null, ['class'=>'form-control', 'id'=>'tanggal_mulai ']) !!}
            </div>
            <div class="form-group">
              {!! Form::input('dateTime-local', 'acceptance_date', null, ['class'=>'form-control', 'id'=>'tanggal_mulai ']) !!}
            </div>
 
            <div class="form-group">
              <label>Project Crew :</label>
              <select class="category related-post form-control" name="category[]" multiple>
                @foreach ($finaldata as $item)
                   
                    @if ($item['selected'])
              <option selected = "selected" value = "{{$item['value']->id}}">{{$item['value']->nama_jabatan}} - {{$item['value']->name}}</option>
                    @else
                    <option  value = "{{$item['value']->id}}">{{$item['value']->nama_jabatan}} - {{$item['value']->name}}</option> 
                    @endif
             
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label>QC Status</label>
            <select id="qc_status" name="qc_status" class="form-control select2" style="width: 100%;">
              <option {{old('qc_status', $project->qc_status)=="Closed"?'selected':''}} value = "Closed">Closed</option>
              <option {{old('qc_status', $project->qc_status)=="Waiting"?'selected':''}} value = "Waiting">Waiting</option>
              <option {{old('qc_status', $project->qc_status)=="Not Yet"?'selected':''}} value = "Not Yet">Not Yet</option>
            </select>
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

<script type="text/javascript">
  $(document).ready(function() {
      $('.category').select2();
  });
</script>

@endsection