<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoundIT | Solusi Barang Hilang')</title>

    <!-- Fontttt -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Ikonnnnn -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        {!! file_get_contents(resource_path('css/app.css')) !!}
        {!! file_get_contents(resource_path('css/beranda.css')) !!}
        {!! file_get_contents(resource_path('css/detail.css')) !!}
        {!! file_get_contents(resource_path('css/footer.css')) !!}
        {!! file_get_contents(resource_path('css/header.css')) !!}
        {!! file_get_contents(resource_path('css/toggleWa.css')) !!}
        {!! file_get_contents(resource_path('css/jelajahi.css')) !!}
        {!! file_get_contents(resource_path('css/profile.css')) !!}
        {!! file_get_contents(resource_path('css/tentangKami.css')) !!}

    </style>
</head>
<body>

    @include('layouts.header')

    <main class="container">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        lucide.createIcons();

    </script>
</body>
</html>
