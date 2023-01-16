<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" content="dDhseOwsnFY2dfhWnxE80orXXKfTjqHNyhDO8FgY" name="csrf-token"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{ env('APP_NAME') }}</title>
  
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/">
  
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />  

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/css/spinkit.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-faq.css') }}">
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
  <style>
    .loader{
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      width: 100%;
      background-color: white;
      opacity: 100%;
      position: absolute;
      z-index: 9999;
    }
  </style>
  @stack('css')  
</head>

  <body>
    <div class="loader">
      <div class="spinner-border spinner-border-lg text-primary" role="status">
      </div>
    </div>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('partials.sidebar')
        <div class="layout-page">
          @include('partials.header')
          <div class="content-wrapper">            
            <div class="container-xxl flex-grow-1 container-p-y" id="content">
              <h4 class="fw-bold py-3 ">
                @yield('title','Dashboard')
              </h4>
              @yield('content')
            </div>                
            @include('partials.footer')    
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    @stack('js')
    <script>
        $(".loader").fadeOut();
    </script>
  </body>
</html>
