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
    .steps > .step {
      position: relative;
      display: table-cell;
      text-align: center;
      font-size: 0.875rem;
      color: #6D6875;
    }
    .steps > .step:before {
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
    .steps > .step:after {
      content: "";
      position: absolute;
      display: block;
      background: #e6e6e6;
      width: 100%;
      height: 0.125rem;
      top: 1rem;
      left: 50%;
    }
    .steps > .step:last-child:after {
      display: none;
    }
    .steps > .step.is-complete {
      color: #6D6875;
    }
    .steps > .step.is-complete:before {
      content: "✓";
      color: #f68e20;
      background: #fef0e2;
      border: 2px solid #f68e20;
    }
    .steps > .step.is-complete:after {
      background: #f68e20;
    }
    .steps > .step.is-active {
      font-size: 1.5rem;
    }
    .steps > .step.is-active:before {
      color: #FFF;
      border: 2px solid #f68e20;
      background: #f68e20;
      margin-bottom: -4.9rem;
    }
    
    /**
     * Some Generic Styling
     */
    *, *:after, *:before {
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
          width: 200px;
          margin-left: 15px; 
          margin-bottom: 30px; 
        }

        /* Container */
.container{
   margin: 0 auto;
   border: 0px solid black;
   width: 50%;
   height: 250px;
   border-radius: 3px;
   background-color: ghostwhite;
   text-align: center;
}
/* Preview */
.preview{
   width: 100px;
   height: 100px;
   border: 1px solid black;
   margin: 0 auto;
   background: white;
}

.preview img{
   display: none;
}
/* Button */
.button{
   border: 0px;
   background-color: deepskyblue;
   color: white;
   padding: 5px 15px;
   margin-left: 10px;
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
    
    <input type="file" id="selectedFile" style="display: none;" />
    <input type="button" value="Browse..." onclick="document.getElementById('selectedFile').click();" />
     
      <script>
          document.getElementById('selectedFile').onchange = function(e) { 
            console.log('sasasasa')
          };
          h()
          function h(){
              console.log('sasasasa')
          }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
       $('#upload-image-form').submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error').text('');
    
           $.ajax({
              type:'POST',
              url: `/file-import`,
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                 if (response) {
                   this.reset();
                   alert('Image has been uploaded successfully');
                 }
               },
               error: function(response){
                  console.log(response);
                    $('#image-input-error').text(response.responseJSON.errors.file);
               }
           });
      });
    
    </script>
      
      
@endsection