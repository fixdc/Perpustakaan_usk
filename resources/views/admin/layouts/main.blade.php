<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard</title>
<link rel="stylesheet" href="{{ asset('assets/select2.css') }}">
<script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/select2.js') }}"></script>
    <script async src="https://unpkg.com/es-module-shims@1.2.0/dist/es-module-shims.js"></script>
    <script type="importmap-shim">
      {
        "imports": {
          "@hotwired/stimulus": "https://unpkg.com/@hotwired/stimulus/dist/stimulus.js"
        }
      }
    </script>
  
    <script type="module-shim">
      import { Application } from '@hotwired/stimulus'
      import { Autocomplete } from './stimulus-autocomplete.js'
  
      const application = Application.start()
      application.register('autocomplete', Autocomplete)
    </script>
  
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-cool">
    @include('admin/partials/sidebar')
    <div class="">
      <div class="2xl:container">
        <div>
        @yield('container')
        </div>
      </div>
    </div>
  </body>
<html>
