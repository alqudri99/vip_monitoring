@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
          <a href="{{route('project.create')}}" class="btn-sm btn-danger">Tambah Project</a>
          
        <div class="card">
          <div class="card-header">
            Input Data
          </div>
          <div class="card-body">
          <form action="{{route('project.store')}}" method="POST">
          @csrf
          <div class="form-group">
          <label>Lokasi Project</label>
              <select id="id_site" name="id_site" class="form-control select2" style="width: 100%;">
                @foreach ($tempat as $item)
              <option  value="{{$item->id}}">{{$item->site_name}}</option>
                @endforeach
              </select>
            </div>
          <div class="form-group">
            <label for="activity_name">Activity Name</label>
            <input type="text" name="activity_name" class="form-control" id="activity_name"   placeholder="Activity Name">
          </div>

          <div class="form-group">
            <label for="method">Methode</label>
            <input type="text" name="methode" class="form-control" id="methode"   placeholder="Methode">
          </div>

      
          <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" class="form-control" id="tanggal_mulai"   placeholder="Tanggal Mulai">
          </div>

          <div class="form-group">
            <label for="acceptance_date">Acepptance Date</label>
            <input type="datetime-local" name="acceptance_date" class="form-control" id="acceptance_date"   placeholder="acceptance_date">
          </div>

          <div class="form-group">
            <label>Project Crew :</label>
            <select class="category related-post form-control" name="category[]" multiple>
              @foreach ($user as $item)
            <option  value="{{$item->id}}">{{$item->nama_jabatan}} - {{$item->name}}</option>
              @endforeach
            </select>
        </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
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