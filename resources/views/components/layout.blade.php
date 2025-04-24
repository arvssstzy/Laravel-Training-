<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Laravel App' }}</title>

    {{-- Bootstrap CSS --}}
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap Bundle JS (for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="{{ asset('asset/style/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/style/crud.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    @stack('styles')  
</head>

<body>

 <div class="content">
        @include('components.sidebar')
        <div>
        <nav class="header">      
            <h2>LEE SYSTEM TECHNOLOGY</h2>
        </nav> 
        </div>
        <main class="main-content" id="mainContent">   
        @yield('content')
        </main>
    </div>
    @include('components.footer')

    <script src="{{ asset('js/student.js') }}"> </script>
    
    <script src="{{ asset('js/invoice.js') }}"> </script>
    @vite(['resources/js/app.js'])

</body>
</html>
