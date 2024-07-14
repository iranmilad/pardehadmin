<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'File Manager') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{asset('css/style-rtl.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/global/plugins.bundle.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/global/plugins.bundle.rtl.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
  <style>
    .fm{
      background: none;
    }
    .fm-navbar , .fm-body , .fm-info-block{
      border: none !important;
    }
    .fm-tree{
      border: none !important;
    }
    .fm-info-block , .fm-content, .fm-tree{
      background: white;
      border-radius: 8px;
      padding: 12px !important;
      box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
    }
    .fm-tree{
      margin-left: 4px;
    }
    .fm-breadcrumb .breadcrumb.active-manager , .fm-tree .fm-tree-disk {
      background: #f9fafb;
      color: #1f2937;
    }
    .fm-table table thead{
      background: #f9fafb;
    }
    .fm-table table thead tr{
      color: #1f2937;
    }
    
    .fm-table table thead tr th{
      font-size: 14px !important;
      font-weight: 600 !important;
      background: none !important;
    }
    #fm > div > div.fm-body.d-flex > div.fm-content.d-flex.flex-column.col-8.col-md-9 > div.fm-disk-list > ul > li > span i{
      margin-left: 5px;
    }
    .btn-info{
      color: white !important;
    }
    .btn-info:hover{
      color: black !important;
    }
    #fm > div > div.fm-navbar.mb-3 > div > div:nth-child(1) > div:nth-child(4) > button{
      margin-right: 5px;
    }
    #fm > div > div.fm-navbar.mb-3 > div > div.col-auto.text-right > div:nth-child(3) > button{
      margin-right: 5px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" id="fm-main-block">
        <div id="fm"></div>
      </div>
    </div>
  </div>

  <!-- File manager -->
  <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // set fm height
      document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');

      // Add callback to file manager
      fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
          window.opener.fmSetLink(fileUrl);
          window.close();
        });
    });
  </script>
</body>

</html>