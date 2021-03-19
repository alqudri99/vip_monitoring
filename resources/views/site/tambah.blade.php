@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
        <a href="{{route('jabatan.create')}}" class="btn-sm btn-danger">Tambah Pegawai</a>
        <div class="card">
    
          <div class="card-header">
            <b>Input Data BTS</b>
          </div>

          <div class="card-body">
          <form action="{{route('site.store')}}" method="POST">
          @csrf
          <label>Wilayah</label>
          <select class="cari form-control"  name="id_kecamatan" id="id_kecamatan"></select>
          <div class="form-group">
            <label>Merek BTS</label>
            <select id="id_bts" name="id_bts" class="form-control select2" style="width: 100%;">
              @foreach ($data as $item)
              <option  value="{{$item->id}}">{{$item->nama_bts}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="site_name">Nama Site</label>
            <input type="text" name="site_name" class="form-control" id="site_name"   placeholder="Nama Site">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
          </div>
        </div>
        </div>
        </div>
</div>


<script>
  $(document).ready(function(){
    $('#country').change(function(){
      loadState($(this).find(':selected').val())
    })
    $('#state').change(function(){
      loadCity($(this).find(':selected').val())
    })
  
  
  })
  
  function loadCountry(){
          $.ajax({
              type: "POST",
              url: "ajax/ajax.php",
              data: "get=country"
              }).done(function( result ) {
                  $(result).each(function(){
                      $("#country").append($('<option>', {
                          value: this.id,
                          text: this.name,
                      }));
                  })
              });
  }
  function loadState(countryId){
          $("#state").children().remove()
          $.ajax({
              type: "POST",
              url: "ajax/ajax.php",
              data: "get=state&countryId=" + countryId
              }).done(function( result ) {
                  $(result).each(function(){
                      $("#state").append($('<option>', {
                          value: this.id,
                          text: this.name,
                      }));
                  })
              });
  }
  function loadCity(stateId){
          $("#city").children().remove()
          $.ajax({
              type: "POST",
              url: "ajax/ajax.php",
              data: "get=city&stateId=" + stateId
              }).done(function( result ) {
                  $(result).each(function(){
                      $("#city").append($('<option>', {
                          value: this.id,
                          text: this.name,
                      }));
                  })
              });
  }
  
  // init the countries
  loadCountry();
  </script>
<script type="text/javascript">
  $(document).ready(function() {
      $('.countryWrap').select2();
  });
</script>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $('.cari').select2({
    placeholder: 'Cari...',
    ajax: {
      url: '/cari',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.name_kota + ' - ' + item.nama_kecamatan,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

</script>
@endsection