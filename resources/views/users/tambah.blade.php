@extends('adminlte::page')
@section('content')
<div class="container">
    <div class = "row">
        <div class = "col-md-10">
        <div class="card">
    
          <div class="card-header">
            <b>Tambah Karyawan</b>
          </div>

          <div class="card-body">
          <form action="{{route('karyawan.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="site_name">Nama</label>
            <input type="text" name="name" class="form-control" id="name"   placeholder="Nama">
          </div>

          <div class="form-group">
            <label for="site_name">Email</label>
            <input type="email" name="email" class="form-control" id="email"   placeholder="Email">
          </div>

          <div class="form-group">
            <label for="site_name">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"   placeholder="Tempat Lahir">
          </div>

          <div class="form-group">
            <label for="site_name">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"   placeholder="Tanggal Lahir">
          </div>

          <div class="form-group">
            <label for="site_name">Mulai Kerja</label>
            <input type="date" name="mulai_kerja" class="form-control" id="mulai_kerja"   placeholder="Mulai Kerja">
          </div>

          <div class="form-group">
            <label for="site_name">Nomor HP</label>
            <input type="tel" name="no_hp" class="form-control" id="no_hp"   placeholder="Nomor HP">
          </div>

          
         <div class="form-group">
            <label>Jabatan</label>
            <select id="id_jabatan" name="id_jabatan" class="form-control select2" style="width: 100%;">
              @foreach ($data as $item)
              <option  value="{{$item->id}}">{{$item->nama_jabatan}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="site_name">Password</label>
            <input type="password" name="password" class="form-control" id="password"   placeholder="Password">
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