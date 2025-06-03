<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href=" {{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon-16x16.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('android-chrome-192x192.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('android-chrome-512x512.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('apple-touch-icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-blue">
            {{ $conference->name }}
        </h1>
        <nav class="space-x-4">
            <!-- <a href="#about" class="text-gray-600 hover:text-orange">About</a>
            <a href="#speakers" class="text-gray-600 hover:text-orange">Speakers</a>
            <a href="#venue" class="text-gray-600 hover:text-orange">Venue</a>
            <a href="#register" class="text-gray-600 hover:text-orange">Register</a> -->
            <span class="text-sm text-gray-500">More info coming soon!</span>
        </nav>
    </div>
</header>

<section class="hero-gradient text-white py-20 md:py-32">
    <div class="container mx-auto px-6 text-center">
        <img src="{{ asset('images/PHPTek2026-Logo_500x500.png') }}" alt="PHP TEK"
             class="mx-auto mb-8 rounded-full bg-white shadow-2xl"
             onerror="this.onerror=null; this.src='https://placehold.co/150x150/FFFFFF/3672A5?text=Logo+Error';">
        <h2 class="text-4xl md:text-6xl font-bold mb-4">
            Welcome to {{ $conference->getName() }}
        </h2>
        <p class="text-lg md:text-2xl mb-8 text-gray-200">
            The premier conference for PHP and web development professionals.
        </p>
        <div class="bg-white text-gray-800 inline-block p-6 md:p-8 rounded-lg shadow-2xl max-w-2xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-semibold text-blue mb-4">Mark Your Calendars!</h3>
            <p class="text-xl md:text-2xl font-medium mb-2">
                <span class="text-orange font-semibold">Dates:</span> {{ $conference->getFormattedDateRange() }}
            </p>
            <p class="text-xl md:text-2xl font-medium">
                <span class="text-orange font-semibold">Location:</span> {{ $conference->getVenueName() }}
            </p>
        </div>
        <br/>
        <br/>
        <div class="bg-white text-gray-800 inline-block p-6 md:p-8 rounded-lg shadow-2xl max-w-2xl mx-auto">
            <h3 class="text-2xl md:text-3xl font-semibold text-blue mb-4">
                JOIN THE COMMUNITY OF PHP ARCHITECTS, DEDICATED TO CONTINUING EDUCATION!
            </h3>
            <div class="mt-12">
                <a href="https://ti.to/phptek/phptek-2026"
                   class="btn-orange font-bold py-3 px-8 rounded-lg text-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                    SECURE YOUR SPOT NOW!
                </a>
            </div>
        </div>
    </div>
</section>

<main class="container mx-auto px-6 py-12 md:py-16">
    <section id="about" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            What is {{ $conference->name }}?
        </h2>
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <p class="text-lg text-gray-700 leading-relaxed mb-4">
                PHP TEK is a long-standing, highly respected conference dedicated to the PHP programming language and
                related web technologies.
                Join us for multiple tracks of in-depth sessions, hands-on workshops, and invaluable networking
                opportunities with experts and peers from around the globe.
            </p>
            <p class="text-lg text-gray-700 leading-relaxed">
                Whether you're looking to deepen your existing skills, explore new frameworks, or connect with the
                vibrant PHP community, {{ $conference->name }} is the place to be.
            </p>
        </div>
    </section>

    <section id="inspired" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            MEET MAINTAINERS AND CREATORS
        </h2>
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
            <p class="text-lg text-gray-700 mb-4">
                Come learn from and meet some of the developers behind the PHP language and its most popular frameworks and libraries.
            </p>
        </div>
    </section>

    <section id="venue" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            Conference <span class="text-orange">Venue</span>
        </h2>
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
            <img src="https://placehold.co/600x300/CCCCCC/FFFFFF?text=Sheraton+Suites+Chicago+O%E2%80%99Hare"
                 alt="{{ $conference->getVenueName() }}" class="mx-auto mb-6 rounded-lg shadow-md"
                 onerror="this.onerror=null; this.src='https://placehold.co/600x300/3672A5/FFFFFF?text=Venue+Image';">
            <h3 class="text-2xl font-semibold text-blue mb-2">{{ $conference->getVenueName() }}</h3>
            <p class="text-lg text-gray-700 mb-4">
                Located conveniently near O'Hare International Airport, the Sheraton Suites offers comfortable
                accommodations and excellent facilities for our conference.
            </p>
            <a href="https://www.marriott.com/en-us/hotels/chios-sheraton-suites-chicago-ohare/overview/"
               target="_blank" rel="noopener noreferrer" class="text-orange hover:underline font-medium">
                Learn more about the hotel
            </a>
        </div>
    </section>

    <section id="stay-updated" class="text-center py-12 bg-gray-200 rounded-lg">
        <h2 class="text-3xl font-bold text-blue mb-4">
            Stay <span class="text-orange">Updated!</span>
        </h2>
        <p class="text-lg text-gray-700 mb-8 max-w-xl mx-auto">
            Sign up for our newsletter to receive the latest updates, speaker announcements, and early bird registration
            offers for {{ $conference->name }}.
        </p>
        <form class="max-w-md mx-auto">
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Enter your email"
                       class="flex-grow p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange focus:border-transparent outline-none"
                       required>
                <button type="submit"
                        class="btn-orange font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    Subscribe
                </button>
            </div>
        </form>
    </section>
</main>

<footer class="bg-blue text-white py-8 mt-16">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">&copy; {{ date('Y') }} PHP TEK Conference. All rights reserved.</p>
        <p class="text-sm text-gray-300">
            PHP TEK is organized by the PHP community, for the PHP community.
        </p>
        <div class="mt-4">
            <!-- <a href="#" class="text-gray-300 hover:text-white mx-2">Facebook</a>
            <a href="#" class="text-gray-300 hover:text-white mx-2">Twitter</a>
            <a href="#" class="text-gray-300 hover:text-white mx-2">LinkedIn</a> -->
        </div>
    </div>
</footer>

</body>
</html>
