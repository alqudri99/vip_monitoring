@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('cust.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('cust.skin', 'blue') . ' sidebar-mini ' . (config('cust.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('cust.layout')] : '') . (config('cust.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">
        {{-- <body class="hold-transition skin-blue layout-top-nav">
            <div class="wrapper"> --}}
            
              <header class="main-header">
                <nav class="navbar navbar-static-top">
                  <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                            <!-- mini logo for sidebar mini 50x50 pixels -->
                            <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                            <!-- logo for regular state and mobile devices -->
                            <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                        </a>
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                      </button>
                    </div>
            
                    <!-- Collect the nav links, forms, and other content for toggling -->
                   
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                      <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
             
                        <!-- User Account Menu -->

                        @auth
                        <li class="dropdown user user-menu">
                          <!-- Menu Toggle Button -->
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{$datas[0]->name}}</span>
                          </a>

                           <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                              <img src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" class="img-circle" alt="User Image">
            
                              <p>
                                {{$datas[0]->name}} - {{$datas[0]->nama_jabatan}}
                              <small>{{$datas[0]->nama_jabatan}} Sejak {{$nama_bulan}}. {{$tahun}}</small>
                              </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                              <div class="row">
                                <div class="col-xs-4 text-center">
                                  <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                  <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                  <a href="#">Friends</a>
                                </div>
                              </div>
                              <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                              <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profihle</a>
                              </div>
                              <div class="pull-right">
                                <a  class="btn btn-default btn-flat" href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i ></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                              </div>

                          </li>
                         
                    @else
                    <li class="dropdown user user-menu">
                      <!-- Menu Toggle Button -->
                      <a href="login" >
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">Login</span>
                      </a>
                      </li>
        
                        @if (Route::has('register'))
                        <li class="dropdown user user-menu">
                          <!-- Menu Toggle Button -->
                          <a href="register" >
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">Register</span>
                          </a>
                          </li>
                        @endif
                    @endauth
                        
                        
                          
                              {{-- endnavbar --}}
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                  </div>
                  <!-- /.container-fluid -->
                </nav>
              </header>
              <!-- Full Width Column -->
              <div class="content-wrapper">
                <div class="container">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    @yield('content_header')
                </section>
    
                <!-- Main content -->
                <section class="content">
    
                  <style>
                    .bg-image {
                     /* image specified in seperate class  */
                     /* height: 240px; */
                     width: 100%; }
                   
                   .bg-image-wedding {
                     background-image: url(https://css-tricks.com/wp-content/uploads/2013/06/photo-wedding_1200x800.jpg);
                     /* lt ie8 */
                     -ms-background-position-x: center;
                     -ms-background-position-y: bottom;
                     /* default - may override with classes or media query */
                     background-position: center bottom;
                     /* scale bg image proportionately */
                     background-size: cover;
                     /* ie8 polyfill */
                     -ms-behavior: url(backgroundsize.min.htc);
                     /* prevent scaling past src width (or not) */
                     /* max-width: 1200px; */ }
                   
                   .bg-left-top {
                     -ms-background-position-x: left;
                     -ms-background-position-y: top;
                     background-position: left top; }
                   
                   .bg-center-center {
                     -ms-background-position-x: center;
                     -ms-background-position-y: center;
                     background-position: center center; }
                   
                   .bg-center-bottom {
                     -ms-background-position-x: center;
                     -ms-background-position-y: bottom;
                     background-position: center bottom; }
                   
                   .crop-height {
                     /* max-width: 1200px; /* native or declared width of img src (if known) */
                     max-height: 320px;
                     height: 320px; /* lt ie8 */
                     height: auto;
                     overflow: hidden; }
                   
                   img.scale, object.scale, .crop-height img {
                     display: block; /* corrects small inline gap at bottom of containing div */
                     max-width: 100%;
                     /* just in case, to force correct aspect ratio */
                     height: auto !important;
                     width: auto9; /* ie8+9 */
                     /* lt ie8 */
                     -ms-interpolation-mode: bicubic;
                     /* force a minimum size if img src size is known */
                         /* min-height: 320px; /* max-height of .crop-height */
                         /* min-width: 480px; /* consistent with image ratio */
                     /* optionally center if img src is not as wide as div */
                         /* margin: 0 auto; */ }
                   
                   .flip {
                     -webkit-transform: rotate(180deg);
                     -moz-transform:    rotate(180deg);
                     -ms-transform:     rotate(180deg);
                     -o-transform:      rotate(180deg);
                     transform:         rotate(180deg);
                     /* needed? not sure */
                     zoom: 1; }
                   
                   img.flip, img.rotate {
                     /* not needed if you set .crop-height max-width to img src width */
                     float: right;
                     /* clearfix after? */ }
                   
                   .invisible {
                     visibility: hidden; }
                   
                   .transparent {
                     /* trigger hasLayout for */
                     zoom: 1;
                     /* 0 value in filters retains layout */
                     -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
                     filter: alpha(opacity=0);
                     opacity: 0; }
                   
                   /* example media queries for background-image-only option */
                   @media
                     only screen and (min-width : 768px) {
                   
                       .bg-image {
                         height: 320px; }
                       }
                   
                   @media
                     only screen and (min-width : 1200px) {
                   
                       .bg-image {
                         height: 400px; }
                       }
                   
                   /* example media query for smaller non-retina devices */
                   @media
                       only screen and (max-device-width : 600px) and (-webkit-max-device-pixel-ratio: 1),
                       only screen and (max-device-width : 600px) and (   max--moz-device-pixel-ratio: 1),
                       only screen and (max-device-width : 600px) and (     -o-max-device-pixel-ratio: 1/1,
                       only screen and (max-device-width : 600px) and (        max-device-pixel-ratio: 1),
                       only screen and (max-device-width : 600px) and (                max-resolution: 144dpi),
                       only screen and (max-device-width : 600px) and (                max-resolution: 1dppx) {
                   
                           .bg-image-wedding {
                               background-image: url(https://css-tricks.com/wp-content/uploads/2013/06/photo-wedding_600x400.jpg); }
                       }
                   
                   /* example media query for larger retina devices */
                   @media
                       only screen and (min-device-width : 768px) and (-webkit-min-device-pixel-ratio: 1.5),
                       only screen and (min-device-width : 768px) and (   min--moz-device-pixel-ratio: 1.5),
                       only screen and (min-device-width : 768px) and (     -o-min-device-pixel-ratio: 3/2),
                       only screen and (min-device-width : 768px) and (        min-device-pixel-ratio: 1.5),
                       only screen and (min-device-width : 768px) and (                min-resolution: 144dpi),
                       only screen and (min-device-width : 768px) and (                min-resolution: 1.5dppx) {
                   
                           .bg-image-wedding {
                               background-image: url(https://css-tricks.com/wp-content/uploads/2013/06/photo-wedding_1200x800@1.5x.jpg); }
                       }
                   </style>
                   <div class="container">
                     <div class="row">
                       <div class="col-md-10">
                         
                   <div class="box box-solid">
                     <div class="box-header with-border">
                       <h3 class="box-title">Carousel</h3>
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body">
                       <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                         <ol class="carousel-indicators">
                           <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                           <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                           <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                         </ol>
                         <div class="carousel-inner">
                           <div class="item">
                             <div class="bg-image bg-image-wedding bg-center-bottom"></div>
                               {{-- <img class="image" src="https://cdn0-production-images-kly.akamaized.net/sSBPJQDB5jow52CK33IgtDnW_uA=/0x0:0x0/640x360/filters:quality(75):strip_icc():format(jpeg):watermark(kly-media-production/assets/images/watermarks/liputan6/watermark-gray-landscape-new.png,540,20,0)/kly-media-production/medias/2980379/original/093112600_1574929209-New_Project__3_.jpg" alt="First slide"> --}}
                        
                           
                    
                             <div class="carousel-caption">
                               First Slide
                             </div>
                           </div>
                           <div class="item">
                             <img src="http://placehold.it/900x500/3c8dbc/ffffff&amp;text=I+Hate+Bootstrap" alt="Second slide">
                    
                             <div class="carousel-caption">
                               Second Slide
                             </div>
                           </div>
                           <div class="item active">
                             <img src="http://placehold.it/900x500/f39c12/ffffff&amp;text=I+Love+Bootstrap" alt="Third slide">
                    
                             <div class="carousel-caption">
                               Third Slide
                             </div>
                           </div>
                         </div>
                         <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                           <span class="fa fa-angle-left"></span>
                         </a>
                         <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                           <span class="fa fa-angle-right"></span>
                         </a>
                       </div>
                     </div>
                     <!-- /.box-body -->
                   
                         <div class="box">
                           <div class="box-header">
                             <h2 class="box-title"><b>Sejarah PT. VIP</b></h2>
                             <div class="box-body">
                               <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <em>Visi Insan Pratama</em> ( VIP ) adalah perusahaan swasta nasional yang bergerak di bidang Telekomunikasi Implementasi &amp; layanan Rekayasa bagi pelanggan pribadi dan komersial. Tujuan PT. VIP adalah untuk mempromosikan jasa pada bidang implementasi Telekomunikasi &amp; layanan Teknik untuk mencapai standar kinerja &nbsp;yang tinggi. PT. VIP telah membangun reputasi sumber daya dengan pengalaman bertahun-tahun di tingkat nasional hingga internasional. Dengan sinergi keahlian &nbsp;dan dukungan keuangan PT. VIP menawarkan implementasi &amp; layanan rekayasa untuk <em>vendor</em> <em>nirkabel</em> atau operator di Indonesia dan luar negeri. Untuk melengkapi pelayanan kami dalam bidang <em>Telecomnication Implementation &amp; Engineering service</em>, sejak 2010 PT. VIP telah mengembangkan tim untuk Logistik &amp; Transportasi . Dengan tambahan kapasitas dan kemampuan ini bisa memberikan layanan kepada pelanggan dengan cara yang lebih efektif. Selama bertahun-tahun, sambil menawarkan layanan Implementasi, Teknik, Logistik, dan Transportasi. PT. VIP selalu memberikan persyaratan kepuasan pada pelanggan dan selalu berusaha menawarkan respon cepat dan dukungan terbaik untuk pelanggan. Mengambil pendekatan secara profesional, PT. VIP tidak pernah menghentikan langkah sepanjang jalan. Akhirnya, tanpa mengorbankan tujuan masa depan PT. VIP dan mempertahankan eksistensi kami dengan profesionalisme, PT. VIP akan menjadi solusi yang lebih baik dan mitra bisnis terbaik untuk proyek &nbsp;yang menjanjikan.</p>
                             </div>
                             <h2 class="box-title"><b>Visi dan Misi PT. VIP</b></h2>
                             <div class="box-body">
                               <h4 >Visi PT. VIP</h4>
                               <p>&nbsp;&nbsp; Membangun <em>value</em> yang berharga terhadap pelanggan dengan mendengarkan setiap kritikan dan saran dari pelanggan dan tetap tanggap terhadap kebutuhan pelanggan, serta memberikan pelayanan dengan standar yang tinggi.</p>
                             </div>
                   
                             <div class="box-body">
                               <h4 >Misi PT. VIP</h4>
                               <p>Menjadi bagian dari <em>Telecom Global Bussiness</em> dengan memberikan layanan yang cepat, handal dan komprehensif dalam industri bisnis Telekomunikasi.</p>
                             </div>
                   
                             <div class="box-body">
                               <h2 class="box-title">Logo Perusahaan PT. VIP</h2>
                               <img src="http://127.0.0.1:8000/images/download.jpg" alt="sljdlskd">
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
    
                </section>
                </div>
                <!-- /.container -->
              </div>
              <!-- /.content-wrapper -->
              <footer class="main-footer">
                <div class="container">
                  <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.13
                  </div>
                  <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
                  reserved.
                </div>
                <!-- /.container -->
              </footer>
            {{-- </div> --}}
            <!-- ./wrapper -->
            
            <!-- jQuery 3 -->
            <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- SlimScroll -->
            <script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- FastClick -->
            <script src="../../bower_components/fastclick/lib/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="../../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../../dist/js/demo.js"></script>
            {{-- </body> --}}
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
