<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tek 2026 - Giveaway Drawing</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
    @livewireStyles
    @fluxAppearance
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-950 via-purple-900 to-slate-950 text-white antialiased">
    <livewire:giveaway-picker />
    @livewireScripts
    @fluxScripts
</body>
</html>
