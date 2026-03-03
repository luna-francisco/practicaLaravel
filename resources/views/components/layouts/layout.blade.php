<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instituto</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


    @vite (["resources/css/app.css", "resources/js/app.js"])

</head>
<body class="min-h-screen flex flex-col">
<div class="site-chrome-wrap">
    <div class="site-chrome-shell">
        <x-layouts.header />
        <x-layouts.nav />
    </div>
</div>


<main class="site-main">
    {{$slot}}
</main>
<x-layouts.footer />

</body>
</html>
