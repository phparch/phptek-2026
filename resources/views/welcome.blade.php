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
<body class="bg-gray-900 text-gray-100 antialiased">

<header class="bg-gray-800 shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-orange">
            {{ $conference->name }}
        </h1>
        <nav class="space-x-4">
            <a href="#about" class="text-gray-300 hover:text-orange">About</a>
            <a href="#speakers" class="text-gray-300 hover:text-orange">Speakers</a>
            <a href="#schedule" class="text-gray-300 hover:text-orange">Schedule</a>
            <a href="#venue" class="text-gray-300 hover:text-orange">Venue</a>
            <a href="#partners" class="text-gray-300 hover:text-orange">Partners</a>
            <a href="https://ti.to/phptek/phptek-2026" class="text-gray-300 hover:text-orange">Register</a>
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
        <div class="bg-gray-800 text-gray-100 inline-block p-6 md:p-8 rounded-lg shadow-2xl max-w-2xl mx-auto border border-gray-700">
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
        <div class="bg-gray-800 text-gray-100 inline-block p-6 md:p-8 rounded-lg shadow-2xl max-w-2xl mx-auto border border-gray-700">
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
        <div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
            <p class="text-lg text-gray-300 leading-relaxed mb-4">
                PHP TEK is a long-standing, highly respected conference dedicated to the PHP programming language and
                related web technologies.
                Join us for multiple tracks of in-depth sessions, hands-on workshops, and invaluable networking
                opportunities with experts and peers from around the globe.
            </p>
            <p class="text-lg text-gray-300 leading-relaxed">
                Whether you're looking to deepen your existing skills, explore new frameworks, or connect with the
                vibrant PHP community, {{ $conference->name }} is the place to be.
            </p>
        </div>
    </section>

    <section id="inspired" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            MEET MAINTAINERS AND CREATORS
        </h2>
        <div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg text-center border border-gray-700">
            <p class="text-lg text-gray-300 mb-4">
                Come learn from and meet some of the developers behind the PHP language and its most popular frameworks and libraries.
            </p>
        </div>
    </section>

    <section id="speakers" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            Featured <span class="text-orange">Speakers</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Speaker Card 1 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <img src="https://placehold.co/300x300/333333/CCCCCC?text=Speaker+1" alt="Speaker 1" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue mb-2">John Doe</h3>
                    <p class="text-gray-300 mb-2">PHP Core Developer</p>
                    <p class="text-gray-400 mb-4">
                        Expert in PHP internals with contributions to the language core and performance optimization.
                    </p>
                    <div class="flex items-center text-gray-400">
                        <span class="text-sm">Keynote Speaker</span>
                    </div>
                </div>
            </div>

            <!-- Speaker Card 2 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <img src="https://placehold.co/300x300/333333/CCCCCC?text=Speaker+2" alt="Speaker 2" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue mb-2">Jane Smith</h3>
                    <p class="text-gray-300 mb-2">Laravel Framework Expert</p>
                    <p class="text-gray-400 mb-4">
                        Renowned for her work on Laravel and modern PHP application architecture.
                    </p>
                    <div class="flex items-center text-gray-400">
                        <span class="text-sm">Workshop Presenter</span>
                    </div>
                </div>
            </div>

            <!-- Speaker Card 3 -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
                <img src="https://placehold.co/300x300/333333/CCCCCC?text=Speaker+3" alt="Speaker 3" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue mb-2">Alex Johnson</h3>
                    <p class="text-gray-300 mb-2">Security Specialist</p>
                    <p class="text-gray-400 mb-4">
                        Leading authority on PHP application security and best practices.
                    </p>
                    <div class="flex items-center text-gray-400">
                        <span class="text-sm">Featured Speaker</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <p class="text-gray-300 mb-4">
                More speakers will be announced soon. Check back for updates!
            </p>
        </div>
    </section>

    <section id="schedule" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            Conference <span class="text-orange">Schedule</span>
        </h2>
        <div class="max-w-4xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700">
            <!-- Day 1 -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-blue mb-4">Day 1 - {{ $conference->formattedStartDate('F j, Y') }}</h3>
                <div class="space-y-4">
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">8:00 AM - 9:00 AM</p>
                        <h4 class="text-lg font-medium text-gray-200">Registration & Breakfast</h4>
                        <p class="text-gray-300">Welcome to PHP TEK 2026!</p>
                    </div>
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">9:00 AM - 10:30 AM</p>
                        <h4 class="text-lg font-medium text-gray-200">Opening Keynote</h4>
                        <p class="text-gray-300">The Future of PHP in 2026 and Beyond</p>
                        <p class="text-gray-400">John Doe, PHP Core Developer</p>
                    </div>
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">11:00 AM - 12:30 PM</p>
                        <h4 class="text-lg font-medium text-gray-200">Concurrent Sessions</h4>
                        <p class="text-gray-300">Multiple tracks with various topics</p>
                    </div>
                </div>
            </div>

            <!-- Day 2 -->
            <div class="mb-8">
                <h3 class="text-2xl font-semibold text-blue mb-4">Day 2 - {{ Carbon\Carbon::parse($conference->formattedStartDate())->addDay()->format('F j, Y') }}</h3>
                <div class="space-y-4">
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">9:00 AM - 10:30 AM</p>
                        <h4 class="text-lg font-medium text-gray-200">Morning Workshops</h4>
                        <p class="text-gray-300">Hands-on learning experiences</p>
                    </div>
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">1:00 PM - 4:30 PM</p>
                        <h4 class="text-lg font-medium text-gray-200">Advanced Topics</h4>
                        <p class="text-gray-300">Deep dives into PHP internals and frameworks</p>
                    </div>
                </div>
            </div>

            <!-- Day 3 -->
            <div>
                <h3 class="text-2xl font-semibold text-blue mb-4">Day 3 - {{ $conference->formattedEndDate('F j, Y') }}</h3>
                <div class="space-y-4">
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">9:00 AM - 12:00 PM</p>
                        <h4 class="text-lg font-medium text-gray-200">Community Contributions</h4>
                        <p class="text-gray-300">How to get involved in PHP open source</p>
                    </div>
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">2:00 PM - 3:30 PM</p>
                        <h4 class="text-lg font-medium text-gray-200">Closing Keynote</h4>
                        <p class="text-gray-300">Reflections and Future Directions</p>
                    </div>
                    <div class="border-l-4 border-orange pl-4 py-2">
                        <p class="text-gray-400">3:30 PM - 5:00 PM</p>
                        <h4 class="text-lg font-medium text-gray-200">Networking & Farewell</h4>
                        <p class="text-gray-300">Final opportunities to connect with peers</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <p class="text-gray-300">
                Full schedule with all sessions and workshops will be published closer to the event date.
            </p>
        </div>
    </section>

    <section id="venue" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            Conference <span class="text-orange">Venue</span>
        </h2>
        <div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded-lg shadow-lg text-center border border-gray-700">
            <img src="https://placehold.co/600x300/333333/CCCCCC?text=Sheraton+Suites+Chicago+O%E2%80%99Hare"
                 alt="{{ $conference->getVenueName() }}" class="mx-auto mb-6 rounded-lg shadow-md"
                 onerror="this.onerror=null; this.src='https://placehold.co/600x300/3672A5/CCCCCC?text=Venue+Image';">
            <h3 class="text-2xl font-semibold text-blue mb-2">{{ $conference->getVenueName() }}</h3>
            <p class="text-lg text-gray-300 mb-4">
                Located conveniently near O'Hare International Airport, the Sheraton Suites offers comfortable
                accommodations and excellent facilities for our conference.
            </p>
            <a href="https://www.marriott.com/en-us/hotels/chios-sheraton-suites-chicago-ohare/overview/"
               target="_blank" rel="noopener noreferrer" class="text-orange hover:underline font-medium">
                Learn more about the hotel
            </a>
        </div>
    </section>

    <section id="stay-updated" class="text-center py-12 bg-gray-800 rounded-lg mb-16 border border-gray-700">
        <h2 class="text-3xl font-bold text-blue mb-4">
            Stay <span class="text-orange">Updated!</span>
        </h2>
        <p class="text-lg text-gray-300 mb-8 max-w-xl mx-auto">
            Sign up for our newsletter to receive the latest updates, speaker announcements, and early bird registration
            offers for {{ $conference->name }}.
        </p>
        <form class="max-w-md mx-auto">
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Enter your email"
                       class="flex-grow p-3 border border-gray-600 bg-gray-700 text-white rounded-lg focus:ring-2 focus:ring-orange focus:border-transparent outline-none"
                       required>
                <button type="submit"
                        class="btn-orange font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    Subscribe
                </button>
            </div>
        </form>
    </section>

    <section id="partners" class="mb-16">
        <h2 class="text-3xl font-bold text-center text-blue mb-8">
            Our <span class="text-orange">Partners</span>
        </h2>
        <div class="max-w-5xl mx-auto">
            <!-- Platinum Partners -->
            <div class="mb-12">
                <h3 class="text-2xl font-semibold text-center text-blue mb-6">Platinum Partners</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/400x200/333333/CCCCCC?text=Platinum+Partner+1" alt="Platinum Partner 1" class="mx-auto mb-4">
                        <h4 class="text-xl font-medium text-blue mb-2">Acme Technologies</h4>
                        <p class="text-gray-300 mb-4">
                            Leading provider of PHP development tools and services.
                        </p>
                        <a href="#" class="text-orange hover:underline">Visit Website</a>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/400x200/333333/CCCCCC?text=Platinum+Partner+2" alt="Platinum Partner 2" class="mx-auto mb-4">
                        <h4 class="text-xl font-medium text-blue mb-2">WebScale Solutions</h4>
                        <p class="text-gray-300 mb-4">
                            Cloud infrastructure optimized for PHP applications.
                        </p>
                        <a href="#" class="text-orange hover:underline">Visit Website</a>
                    </div>
                </div>
            </div>

            <!-- Gold Partners -->
            <div class="mb-12">
                <h3 class="text-2xl font-semibold text-center text-blue mb-6">Gold Partners</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/300x150/333333/CCCCCC?text=Gold+Partner+1" alt="Gold Partner 1" class="mx-auto mb-3">
                        <h4 class="text-lg font-medium text-blue mb-1">Framework Co.</h4>
                        <p class="text-gray-300 text-sm mb-2">
                            Modern PHP frameworks for rapid development.
                        </p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/300x150/333333/CCCCCC?text=Gold+Partner+2" alt="Gold Partner 2" class="mx-auto mb-3">
                        <h4 class="text-lg font-medium text-blue mb-1">DevOps Pro</h4>
                        <p class="text-gray-300 text-sm mb-2">
                            CI/CD solutions for PHP applications.
                        </p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/300x150/333333/CCCCCC?text=Gold+Partner+3" alt="Gold Partner 3" class="mx-auto mb-3">
                        <h4 class="text-lg font-medium text-blue mb-1">Security Shield</h4>
                        <p class="text-gray-300 text-sm mb-2">
                            Application security for PHP developers.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Silver Partners -->
            <div>
                <h3 class="text-2xl font-semibold text-center text-blue mb-6">Silver Partners</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto">
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/200x100/333333/CCCCCC?text=Silver+1" alt="Silver Partner 1" class="mx-auto mb-2">
                        <h4 class="text-md font-medium text-blue">Database Pro</h4>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/200x100/333333/CCCCCC?text=Silver+2" alt="Silver Partner 2" class="mx-auto mb-2">
                        <h4 class="text-md font-medium text-blue">API Connect</h4>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/200x100/333333/CCCCCC?text=Silver+3" alt="Silver Partner 3" class="mx-auto mb-2">
                        <h4 class="text-md font-medium text-blue">Testing Tools</h4>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg text-center border border-gray-700">
                        <img src="https://placehold.co/200x100/333333/CCCCCC?text=Silver+4" alt="Silver Partner 4" class="mx-auto mb-2">
                        <h4 class="text-md font-medium text-blue">Cloud Host</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-12">
            <p class="text-lg text-gray-300 mb-6">
                Interested in partnering with PHP TEK 2026?
            </p>
            <a href="#" class="btn-orange font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                Become a Partner
            </a>
        </div>
    </section>
</main>

<footer class="bg-gray-950 text-white py-8 mt-16 border-t border-gray-800">
    <div class="container mx-auto px-6 text-center">
        <p class="mb-2">&copy; {{ date('Y') }} PHP TEK Conference. All rights reserved.</p>
        <p class="text-sm text-gray-400">
            PHP TEK is organized by the PHP community, for the PHP community.
        </p>
        <div class="mt-4">
            <!-- <a href="#" class="text-gray-400 hover:text-white mx-2">Facebook</a>
            <a href="#" class="text-gray-400 hover:text-white mx-2">Twitter</a>
            <a href="#" class="text-gray-400 hover:text-white mx-2">LinkedIn</a> -->
        </div>
    </div>
</footer>

</body>
</html>
