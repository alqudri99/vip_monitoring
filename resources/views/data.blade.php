@extends('adminlte::page')

@section('content')


<style>
  @charset "UTF-8";
  @import "//fonts.googleapis.com/css?family=Open+Sans";

  .steps {
    list-style: none;
    margin: 0;
    padding: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
    color: #929292;
    height: 4rem;
  }

  .steps>.step {
    position: relative;
    display: table-cell;
    text-align: center;
    font-size: 0.875rem;
    color: #6D6875;
  }

  .steps>.step:before {
    content: attr(data-step);
    display: block;
    margin: 0 auto;
    background: #ffffff;
    border: 2px solid #e6e6e6;
    color: #e6e6e6;
    width: 2rem;
    height: 2rem;
    text-align: center;
    margin-bottom: -4.2rem;
    line-height: 1.9rem;
    border-radius: 100%;
    position: relative;
    z-index: 1;
    font-weight: 700;
    font-size: 1rem;
  }

  .steps>.step:after {
    content: "";
    position: absolute;
    display: block;
    background: #e6e6e6;
    width: 100%;
    height: 0.125rem;
    top: 1rem;
    left: 50%;
  }

  .steps>.step:last-child:after {
    display: none;
  }

  .steps>.step.is-complete {
    color: #6D6875;
  }

  .steps>.step.is-complete:before {
    content: "✓";
    color: #f68e20;
    background: #fef0e2;
    border: 2px solid #f68e20;
  }

  .steps>.step.is-complete:after {
    background: #f68e20;
  }

  .steps>.step.is-active {
    font-size: 2.5rem;
  }

  .steps>.step.is-active:before {
    color: #FFF;
    border: 2px solid #f68e20;
    background: #f68e20;
    margin-bottom: -4.9rem;
  }

  /**
     * Some Generic Styling
     */
  *,
  *:after,
  *:before {
    box-sizing: border-box;
  }

  h1 {
    margin-bottom: 1.5em;
  }

  .steps {
    margin-bottom: 3em;
  }

  /* body {
      font-family: "Open Sans", sans-serif;
      text-align: center;
      color: #6D6875;
    } */

  .column {
    float: left;
    width: 25%;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 250px;
    margin-left: 15px;
    margin-bottom: 30px;
  }

  div.container4 {
    height: 10em;
    position: relative
  }

  div.container4 p {
    margin: 0;
    background: yellow;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
  }
 
</style>

{{-- <script>
      window.console = window.console || function(t) {};
    </script>
    
      
      
      <script>
      if (document.location.search.match(/type=embed/gi)) {
        window.parent.postMessage("resize", "*");
      }
    </script> --}}
    @if ($datas->step_3 == 2)
        <a href="">Fuck</a>
    @endif

  
<div class="row">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Default Box Example</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
     
    <div class="row">
      @if( $datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 != 1 && $datas->step_4 != 1)
    
      <div class="column"><img src="{{$datas->step_1}}" alt="Paris"> </div>
      <div class="column"><img src="{{$datas->step_2}}" alt="Paris"> </div>
      <div class="column"><img src="{{$datas->step_3}}" alt="Paris"> </div>
      <div class="column"><img src="{{$datas->step_4}}" alt="Paris"> </div>
    
      @elseif($datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 != 1 && $datas->step_4 == 1) 
    
      <div class="column"><img src="{{$datas->step_1}}" alt="Paris"> </div>
      <div class="column"><img src="{{$datas->step_2}}" alt="Paris"> </div>
      <div class="column"><img src="{{$datas->step_3}}" alt="Paris"> </div>
    
      <input type="file" id="selectedFile" style="display: none;" />
      <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"
        onclick="document.getElementById('selectedFile').click();"> </div>
    
      
      
            
        @elseif($datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
        
        
        <div class="column"><img src="{{$datas->step_1}}" alt="Paris"> </div>
        <div class="column"><img src="{{$datas->step_2}}" alt="Paris"> </div>
        
        <input type="file" id="selectedFile" style="display: none;" />
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"
          onclick="document.getElementById('selectedFile').click();"> </div>
    
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        
            
        @elseif($datas->step_1 != 1 && $datas->step_2 == 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
    
        <div class="column"><img src="{{$datas->step_1}}" alt="Paris"> </div>
        
        <input type="file" id="selectedFile" style="display: none;" />
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"
          onclick="document.getElementById('selectedFile').click();"> </div>
        
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        
        @elseif($datas->step_1 == 1 && $datas->step_2 == 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
    
        <input type="file" id="selectedFile" style="display: none;" />
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"
          onclick="document.getElementById('selectedFile').click();"> </div>
    
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        <div class="column"><img src="https://content.hostgator.com/img/weebly_image_sample.png" alt="Paris"> </div>
        
            
          
    @endif
    </div>


      @if( $datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 != 1 && $datas->step_4 != 1)
    
      <ol class="steps">
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="1">
          Lokasi Site
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="2">
          Hasil DT
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="3">
          Proses Hasil DT
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="4">
          Report Dari Telkomsel
        </li>
      </ol>
      @elseif($datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 != 1 && $datas->step_4 == 1) 
      <ol class="steps">
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="1">
          Lokasi Site
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="2">
          Hasil DT
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
          data-step="3">
          Proses Hasil DT
        </li>
        <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-active"
          data-step="4">
          Report Dari Telkomsel
        </li>
      </ol>
        @elseif($datas->step_1 != 1 && $datas->step_2 != 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
        <ol class="steps">
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
            data-step="1">
            Lokasi Site
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
            data-step="2">
            Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-active"
            data-step="3">
            Proses Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="4">
            Report Dari Telkomsel
          </li>
        </ol>
        @elseif($datas->step_1 != 1 && $datas->step_2 == 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
        <ol class="steps">
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-complete"
            data-step="1">
            Lokasi Site
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step is-active"
            data-step="2">
            Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="3">
            Proses Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="4">
            Report Dari Telkomsel
          </li>
        </ol>
        
        @elseif($datas->step_1 == 1 && $datas->step_2 == 1 && $datas->step_3 == 1 && $datas->step_4 == 1) 
    
        <ol class="steps">
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step  is-active"
            data-step="1">
            Lokasi Site
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="2">
            Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="3">
            Proses Hasil DT
          </li>
          <li style="font-family: Open Sans, sans-serif;text-align: center;color: #6D6875;" class="step" data-step="4">
            Report Dari Telkomsel
          </li>
        </ol>
          
    @endif
    </div>
  </div>
  <!-- /.box -->
</div>



<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detail SIte Project</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th>Nama Site</th>
                <th>Nama BTS</th>
                <th>Alamat</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($datasite as $item)
              <tr>
                <td>{{$item['site_name']}}</td>
                <td>{{$item['nama_bts']}}</td>
                <td>{{$item['nama_kecamatan']}}, {{$item['name_kota']}}</td>
              </tr> 
              @endforeach 

            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Detail Crew Project</h3>
        </div>
        <div class="box-body">
          <table class="table" id="tabel">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Nomor HP</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach ($crew as $item)
              <tr>
                <td>{{$no}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['nama_jabatan']}}</td>
                <td>{{$item['no_hp']}}</td>
                <td>{{$item['email']}}</td>
              </tr>
              @php
              $no++;
              @endphp
              @endforeach 

            </tbody>
          </table>
        </div>



  </div>

</div>

<script>
  var data = <?php echo $datas; ?>;
  var mode = 0;
  if(data.step_1 != 1 && data.step_2 != 1 && data.step_3 != 1 && data.step_4 != 1 ){

  }else if(data.step_1 != 1 && data.step_2 != 1 && data.step_3 != 1 && data.step_4 == 1 ){
    mode = 4;
  }
  else if(data.step_1 != 1 && data.step_2 != 1 && data.step_3 == 1 && data.step_4 == 1 ){
    mode = 3;
  }
  else if(data.step_1 != 1 && data.step_2 == 1 && data.step_3 == 1 && data.step_4 == 1 ){
    mode = 2;
  }else if(data.step_1 == 1 && data.step_2 == 1 && data.step_3 == 1 && data.step_4 == 1 ){
    mode = 1;
  }
  document.getElementById('selectedFile').onchange = function(e) { 
   

    
            console.log('sasasasa')

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            let formData = new FormData();

            formData.append("file", document.getElementById('selectedFile').files[0]);
           $('#image-input-error').text('');
    
           $.ajax({
              type:'POST',
              url: `http://127.0.0.1:8000/api/up?id=` + data.id_project+'&mode=' + mode  ,
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                 if (response) {
                  // document.getElementById('selectedFile').reset();
                  document.location.reload(true)
                  //  alert('Image has been uploaded successfully');
                 }
               },
               error: function(response){
                  console.log(response);
                    // $('#image-input-error').text(response.responseJSON.errors.file);
               }
           });
          };
</script>

@endsection