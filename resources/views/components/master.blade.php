@props(['title' => 'Accueil'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{ $styles }}
</head>

<body>
    <x-navbr />
    <header>
        {{ $header }}
    </header>
    
    <main>
        {{ $alert }}
        <div class="m-3">
            {{ $main }}
        </div>

    </main>
    <script src="{{ asset('js/app.js') }}"></script>

    {{ $javascript }}
</body>

</html>
