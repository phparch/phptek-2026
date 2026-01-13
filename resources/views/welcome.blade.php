<!-- resources/views/phptek.blade.php -->
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tek 2026 - The Premier PHP Conference</title>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ config('app.url') }}">
    <meta name="keywords" content="php, web development, conference">
    <link rel="icon" href=" {{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/favicon-16x16.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/favicon-32x32.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/android-chrome-192x192.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/android-chrome-512x512.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/apple-touch-icon.png') }}" type="image/x-icon">

    <!-- Primary Meta Tags -->
    <meta name="title" content="PHP Tek 2026 - The Premier PHP Conference"/>
    <meta name="description"
          content="Join us at PHP Tek 2026, the premier PHP conference featuring expert speakers, hands-on workshops, and networking opportunities.">
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://phptek.io/" />
    <meta property="og:title" content="PHP Tek 2026 - The Premier PHP Conference" />
    <meta property="og:description" content="Join us at PHP Tek 2026, the premier PHP conference featuring expert speakers, hands-on workshops, and networking opportunities." />
    <meta property="og:image" content="https://cdn.phparch.social/phptek2026/logos/phptek_2026_logo.png" />
    <!-- Twitter (X) Meta Tags -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://phptek.io/" />
    <meta property="twitter:title" content="PHP Tek 2026 - The Premier PHP Conference" />
    <meta property="twitter:description" content="Join us at PHP Tek 2026, the premier PHP conference featuring expert speakers, hands-on workshops, and networking opportunities." />
    <meta property="twitter:image" content="https://cdn.phparch.social/phptek2026/logos/phptek_2026_logo.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap"
            rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function () {
            if (localStorage.getItem('darkMode') !== 'false') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body
        class="font-sans bg-white dark:bg-slate-900 text-gray-900 dark:text-slate-100 transition-colors duration-300 pt-20">

<!-- Live region for announcements -->
<div aria-live="polite" aria-atomic="true" class="sr-only" id="live-region"></div>

<!-- Skip to content link for keyboard users -->
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-tek-orange-900 text-white px-4 py-2 rounded z-[9999] focus:outline-none focus:ring-2 focus:ring-tek-orange-600">
    Skip to main content
</a>

<!-- Fixed navigation -->
<x-navigation/>

<!-- Hero section -->
<header class="relative overflow-hidden" role="banner">
    <x-hero-section :conference="null"/>
</header>

<main id="main-content" role="main">
    <x-cfp-section/>
    <x-about-section/>

{{-- <x-speakers-section/>  --}}

{{-- <x-schedule-section/> --}}

<x-venue-section/>

        <x-partners-section/>

<x-registration-section/>

{{-- <x-newsletter-section/> --}}

</main>

<x-footer/>

<x-modals.code-of-conduct-modal/>
<x-modals.privacy-policy-modal/>
<x-modals.cookie-policy-modal/>
<x-modals.travel-information-modal/>


<!-- Back to top button -->
<button id="backToTop"
        x-data="{ showButton: false }"
        x-init="window.addEventListener('scroll', () => { showButton = window.scrollY > 500 })"
        x-show="showButton"
        x-transition.opacity
        @click="window.scrollTo({top: 0, behavior: 'smooth'}); document.getElementById('live-region').textContent = 'Scrolled to top of page'"
        class="fixed bottom-6 right-6 bg-tek-orange-900 dark:bg-tek-orange-900 text-white p-3 rounded-full shadow-lg hover:bg-tek-orange-800 dark:hover:bg-tek-orange-700 transition-all z-50 focus:outline-none focus:ring-2 focus:ring-tek-orange-600"
        aria-label="Back to top of page">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
    </svg>
</button>

<script>
    // Dark mode is now the default - add dark class by default
    if (localStorage.getItem('darkMode') === null) {
        // Default to dark mode
        document.documentElement.classList.add('dark');
        localStorage.setItem('darkMode', 'true');
    } else if (localStorage.getItem('darkMode') === 'false') {
        // User explicitly chose light mode
        document.documentElement.classList.remove('dark');
    } else {
        // User has dark mode enabled
        document.documentElement.classList.add('dark');
    }
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V6GPXQJF9F"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-V6GPXQJF9F');
</script>

</body>
</html>
