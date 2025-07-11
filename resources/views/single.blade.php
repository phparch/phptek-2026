<!-- resources/views/phptek.blade.php -->
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Tek 2026 - The Premier PHP Conference</title>
    <meta name="description"
          content="Join us at PHP Tek 2026, the premier PHP conference featuring expert speakers, hands-on workshops, and networking opportunities.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }"
      class="font-sans bg-white dark:bg-background-dark text-text-primary-light dark:text-text-primary-dark transition-colors duration-300">

<!-- Hero section with navigation -->
<header class="relative overflow-hidden">
    <!-- Navigation -->
    <nav
        class="relative z-10 bg-white/80 dark:bg-background-dark/80 backdrop-blur-sm sticky top-0 transition-colors duration-300">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="#" class="flex items-center">
                        <span
                            class="text-3xl font-display font-bold text-primary-light dark:text-primary-dark">PHPTek</span>
                        <span
                            class="ml-1 bg-primary-light dark:bg-primary-dark text-white text-sm font-bold py-1 px-2 rounded">2026</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#about"
                       class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">About</a>
                    <a href="#speakers"
                       class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Speakers</a>
                    <a href="#schedule"
                       class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Schedule</a>
                    <a href="#venue"
                       class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Venue</a>
                    <a href="#sponsors"
                       class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Sponsors</a>
                    <a href="#register"
                       class="bg-primary-light dark:bg-primary-dark text-white px-5 py-2 rounded-lg hover:bg-opacity-90 transition-all shadow-md hover:shadow-lg">Register
                        Now</a>

                    <!-- Theme toggle button -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                            class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 focus:outline-none">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden" x-data="{ mobileMenu: false }">
                    <button @click="mobileMenu = !mobileMenu" class="focus:outline-none">
                        <svg x-show="!mobileMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenu" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Mobile menu -->
                    <div x-show="mobileMenu"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute top-20 right-0 left-0 bg-white dark:bg-background-dark shadow-lg rounded-b-lg p-6 space-y-4 z-20">
                        <a href="#about" @click="mobileMenu = false"
                           class="block font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">About</a>
                        <a href="#speakers" @click="mobileMenu = false"
                           class="block font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Speakers</a>
                        <a href="#schedule" @click="mobileMenu = false"
                           class="block font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Schedule</a>
                        <a href="#venue" @click="mobileMenu = false"
                           class="block font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Venue</a>
                        <a href="#sponsors" @click="mobileMenu = false"
                           class="block font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Sponsors</a>
                        <a href="#register" @click="mobileMenu = false"
                           class="block bg-primary-light dark:bg-primary-dark text-white px-5 py-2 rounded-lg text-center">Register
                            Now</a>

                        <div
                            class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Theme</span>
                            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                                    class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 focus:outline-none">
                                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5 text-yellow-300" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero content -->
    <div class="relative pt-12 pb-24 md:pt-20 md:pb-40 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <span
                            class="inline-block py-1 px-3 rounded-full bg-secondary-light/10 dark:bg-secondary-dark/10 text-secondary-light dark:text-secondary-dark font-medium text-sm mb-4">May 18-22, 2026</span>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold leading-tight">
                            The Premier <span class="text-primary-light dark:text-primary-dark">PHP</span> Conference of
                            2026
                        </h1>
                    </div>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-lg md:text-xl max-w-xl">
                        Join us for 5 days of expert-led sessions, hands-on workshops, and unparalleled networking
                        opportunities with the PHP community.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#register"
                           class="bg-primary-light dark:bg-primary-dark text-white px-8 py-3 rounded-lg text-center font-medium hover:bg-opacity-90 transition-all shadow-md hover:shadow-lg">
                            Register Now
                        </a>
                        <a href="#speakers"
                           class="border border-gray-300 dark:border-gray-700 px-8 py-3 rounded-lg text-center font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                            View Speakers
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center">
                            <div class="flex -space-x-2">
                                <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Attendee"
                                     class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Attendee"
                                     class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                                <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Attendee"
                                     class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Attendee"
                                     class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 border-2 border-white dark:border-background-dark text-sm font-medium">
                                    +2K
                                </div>
                            </div>
                            <p class="ml-4 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                <span class="font-medium">2,000+</span> developers already registered
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative hidden md:block">
                    <div
                        class="absolute -top-10 -right-10 w-72 h-72 bg-secondary-light/10 dark:bg-secondary-dark/10 rounded-full filter blur-3xl opacity-70"></div>
                    <div
                        class="absolute -bottom-10 -left-10 w-72 h-72 bg-primary-light/10 dark:bg-primary-dark/10 rounded-full filter blur-3xl opacity-70"></div>
                    <img
                        src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop"
                        alt="PHP Tek Conference"
                        class="rounded-2xl shadow-2xl relative z-10 transform hover:-translate-y-2 transition-transform duration-300">
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div
                class="absolute -top-24 -left-24 w-96 h-96 bg-primary-light/5 dark:bg-primary-dark/5 rounded-full"></div>
            <div
                class="absolute top-1/3 right-0 w-64 h-64 bg-secondary-light/5 dark:bg-secondary-dark/5 rounded-full"></div>
            <div
                class="absolute bottom-0 left-1/4 w-80 h-80 bg-primary-light/5 dark:bg-primary-dark/5 rounded-full"></div>
        </div>
    </div>
</header>

<!-- About section -->
<section id="about" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">About PHP Tek 2026</h2>
            <p class="text-text-secondary-light dark:text-text-secondary-dark max-w-2xl mx-auto">
                The premier PHP conference focused on modern development, best practices, and emerging technologies.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md p-8 transition-transform hover:-translate-y-1 duration-300">
                <div
                    class="w-14 h-14 bg-primary-light/10 dark:bg-primary-dark/10 rounded-lg flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-light dark:text-primary-dark"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Expert Speakers</h3>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">
                    Learn from 50+ industry experts and PHP core developers sharing their knowledge and experience.
                </p>
            </div>

            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md p-8 transition-transform hover:-translate-y-1 duration-300">
                <div
                    class="w-14 h-14 bg-primary-light/10 dark:bg-primary-dark/10 rounded-lg flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-light dark:text-primary-dark"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Hands-on Workshops</h3>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">
                    Participate in intensive workshops on advanced PHP techniques, frameworks, and tooling.
                </p>
            </div>

            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md p-8 transition-transform hover:-translate-y-1 duration-300">
                <div
                    class="w-14 h-14 bg-primary-light/10 dark:bg-primary-dark/10 rounded-lg flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-light dark:text-primary-dark"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Networking Opportunities</h3>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">
                    Connect with 2,000+ PHP developers, community leaders, and industry professionals.
                </p>
            </div>
        </div>

        <div class="mt-16 grid md:grid-cols-4 gap-6 text-center">
            <div class="p-6">
                <div class="text-4xl font-bold text-primary-light dark:text-primary-dark mb-2">50+</div>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">Expert Speakers</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-primary-light dark:text-primary-dark mb-2">100+</div>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">Technical Sessions</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-primary-light dark:text-primary-dark mb-2">25+</div>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">Hands-on Workshops</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-primary-light dark:text-primary-dark mb-2">2,000+</div>
                <p class="text-text-secondary-light dark:text-text-secondary-dark">Attendees</p>
            </div>
        </div>
    </div>
</section>

<!-- Speakers section -->
<section id="speakers" class="py-20 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Meet Our Speakers</h2>
            <p class="text-text-secondary-light dark:text-text-secondary-dark max-w-2xl mx-auto">
                Learn from the brightest minds in the PHP ecosystem and beyond.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Speaker 1 -->
            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md overflow-hidden transition-transform hover:-translate-y-1 duration-300">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Speaker Name"
                         class="w-full h-60 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="text-white">
                            <h3 class="font-bold text-lg">Sarah Johnson</h3>
                            <p class="text-sm text-gray-200">Laravel Core Team</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                        Expert in modern PHP architecture, Laravel, and scalable application design.
                    </p>
                    <div class="flex space-x-2">
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Laravel</span>
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Architecture</span>
                    </div>
                </div>
            </div>

            <!-- Speaker 2 -->
            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md overflow-hidden transition-transform hover:-translate-y-1 duration-300">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Speaker Name"
                         class="w-full h-60 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="text-white">
                            <h3 class="font-bold text-lg">Michael Chen</h3>
                            <p class="text-sm text-gray-200">PHP Core Contributor</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                        PHP core contributor and performance optimization specialist.
                    </p>
                    <div class="flex space-x-2">
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">PHP Core</span>
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Performance</span>
                    </div>
                </div>
            </div>

            <!-- Speaker 3 -->
            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md overflow-hidden transition-transform hover:-translate-y-1 duration-300">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Speaker Name"
                         class="w-full h-60 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="text-white">
                            <h3 class="font-bold text-lg">Emma Rodriguez</h3>
                            <p class="text-sm text-gray-200">Security Expert</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                        Leading authority on PHP application security and best practices.
                    </p>
                    <div class="flex space-x-2">
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Security</span>
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">OWASP</span>
                    </div>
                </div>
            </div>

            <!-- Speaker 4 -->
            <div
                class="bg-white dark:bg-background-dark rounded-xl shadow-md overflow-hidden transition-transform hover:-translate-y-1 duration-300">
                <div class="relative">
                    <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Speaker Name"
                         class="w-full h-60 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="text-white">
                            <h3 class="font-bold text-lg">James Wilson</h3>
                            <p class="text-sm text-gray-200">Symfony Maintainer</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                        Symfony framework maintainer and distributed systems architect.
                    </p>
                    <div class="flex space-x-2">
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Symfony</span>
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Symfony</span>
                        <span
                            class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Distributed Systems</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center text-primary-light dark:text-primary-dark font-medium">
                View All Speakers
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Schedule section -->
<section id="schedule" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Conference Schedule</h2>
            <p class="text-text-secondary-light dark:text-text-secondary-dark max-w-2xl mx-auto">
                Five days of engaging talks, workshops, and networking events.
            </p>
        </div>

        <div class="bg-white dark:bg-background-dark rounded-xl shadow-md overflow-hidden"
             x-data="{ activeDay: 'day1' }">
            <!-- Tab navigation -->
            <div class="flex flex-wrap border-b border-gray-200 dark:border-gray-700">
                <button @click="activeDay = 'day1'"
                        :class="{ 'border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark': activeDay === 'day1' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                    Day 1: May 18
                </button>
                <button @click="activeDay = 'day2'"
                        :class="{ 'border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark': activeDay === 'day2' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                    Day 2: May 19
                </button>
                <button @click="activeDay = 'day3'"
                        :class="{ 'border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark': activeDay === 'day3' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                    Day 3: May 20
                </button>
                <button @click="activeDay = 'day4'"
                        :class="{ 'border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark': activeDay === 'day4' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                    Day 4: May 21
                </button>
                <button @click="activeDay = 'day5'"
                        :class="{ 'border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark': activeDay === 'day5' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                    Day 5: May 22
                </button>
            </div>

            <!-- Day 1 Schedule -->
            <div x-show="activeDay === 'day1'" class="p-6 space-y-6">
                <div class="border-l-4 border-primary-light dark:border-primary-dark pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Workshops Day</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark">Intensive hands-on workshops to
                        level up your skills</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div
                        class="p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">9:00 AM - 12:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">Advanced Laravel Architecture</h4>
                            </div>
                            <span
                                class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                            Deep dive into Laravel's architecture patterns, service containers, and advanced dependency
                            injection.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Sarah Johnson</p>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Laravel Core
                                    Team</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">9:00 AM - 12:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">PHP Security Masterclass</h4>
                            </div>
                            <span
                                class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                            Hands-on security workshop covering OWASP Top 10, security best practices, and real-world
                            examples.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Emma Rodriguez</p>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Security
                                    Expert</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">1:00 PM - 4:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">High-Performance PHP Applications</h4>
                            </div>
                            <span
                                class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                            Optimize PHP applications for maximum performance, from code-level optimizations to caching
                            strategies.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Michael Chen</p>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">PHP Core
                                    Contributor</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-text-secondary-light dark:text-text-secondary-dark">1:00 PM - 4:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">Symfony Components Deep Dive</h4>
                            </div>
                            <span
                                class="bg-primary-light/10 dark:bg-primary-dark/10 text-primary-light dark:text-primary-dark text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-4">
                            Explore Symfony's powerful components and learn how to leverage them in any PHP project.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">James Wilson</p>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Symfony
                                    Maintainer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="#" class="text-primary-light dark:text-primary-dark font-medium inline-flex items-center">
                        View Complete Day 1 Schedule
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Day 2-5 Schedules -->
            <div x-show="activeDay === 'day2'" class="p-6 space-y-6">
                <div class="border-l-4 border-primary-light dark:border-primary-dark pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 1</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark">Main conference tracks with
                        keynotes and technical sessions</p>
                </div>
                <!-- Day 2 schedule content -->
                <p class="text-center text-text-secondary-light dark:text-text-secondary-dark">Full schedule coming
                    soon...</p>
            </div>

            <div x-show="activeDay === 'day3'" class="p-6 space-y-6">
                <div class="border-l-4 border-primary-light dark:border-primary-dark pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 2</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark">Main conference tracks with
                        keynotes and technical sessions</p>
                </div>
                <!-- Day 3 schedule content -->
                <p class="text-center text-text-secondary-light dark:text-text-secondary-dark">Full schedule coming
                    soon...</p>
            </div>

            <div x-show="activeDay === 'day4'" class="p-6 space-y-6">
                <div class="border-l-4 border-primary-light dark:border-primary-dark pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 3</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark">Main conference tracks with
                        keynotes and technical sessions</p>
                </div>
                <!-- Day 4 schedule content -->
                <p class="text-center text-text-secondary-light dark:text-text-secondary-dark">Full schedule coming
                    soon...</p>
            </div>

            <div x-show="activeDay === 'day5'" class="p-6 space-y-6">
                <div class="border-l-4 border-primary-light dark:border-primary-dark pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Community Day</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark">Community-driven unconference and
                        networking events</p>
                </div>
                <!-- Day 5 schedule content -->
                <p class="text-center text-text-secondary-light dark:text-text-secondary-dark">Full schedule coming
                    soon...</p>
            </div>
        </div>
    </div>
</section>

<!-- Venue section -->
<section id="venue" class="py-20 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-display font-bold mb-6">Conference Venue</h2>
                <p class="text-text-secondary-light dark:text-text-secondary-dark mb-6">
                    PHP Tek 2026 will be held at the prestigious Tech Convention Center in Chicago, a state-of-the-art
                    facility designed to provide the perfect environment for learning and networking.
                </p>

                <div class="space-y-4 mb-8">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-primary-light dark:text-primary-dark mt-0.5 mr-3 flex-shrink-0"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-lg">Location</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark">
                                Tech Convention Center<br>
                                123 Innovation Drive<br>
                                Chicago, IL 60601
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-primary-light dark:text-primary-dark mt-0.5 mr-3 flex-shrink-0"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-lg">Accommodation</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark">
                                Special rates available at partner hotels within walking distance of the venue. Booking
                                links will be provided upon registration.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6 text-primary-light dark:text-primary-dark mt-0.5 mr-3 flex-shrink-0"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-bold text-lg">Transportation</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark">
                                The venue is easily accessible via public transportation and is just 20 minutes from
                                Chicago O'Hare International Airport.
                            </p>
                        </div>
                    </div>
                </div>

                <a href="#" class="inline-flex items-center text-primary-light dark:text-primary-dark font-medium">
                    View Venue Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <div class="relative">
                <div
                    class="absolute -top-6 -right-6 w-64 h-64 bg-primary-light/10 dark:bg-primary-dark/10 rounded-full filter blur-xl opacity-70"></div>
                <img src="https://images.unsplash.com/photo-1577959198872-6ffb4b242c9a?q=80&w=2071&auto=format&fit=crop"
                     alt="Tech Convention Center" class="rounded-xl shadow-xl relative z-10">
                <div
                    class="absolute -bottom-6 -left-6 w-64 h-64 bg-secondary-light/10 dark:bg-secondary-dark/10 rounded-full filter blur-xl opacity-70"></div>
            </div>
        </div>
    </div>
</section>

<!-- Sponsors section -->
<section id="sponsors" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Our Sponsors</h2>
            <p class="text-text-secondary-light dark:text-text-secondary-dark max-w-2xl mx-auto">
                PHP Tek 2026 is made possible thanks to the support of our amazing sponsors.
            </p>
        </div>

        <div class="space-y-12">
            <!-- Platinum sponsors -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-center">Platinum Sponsors</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md flex items-center justify-center h-32">
                        <span class="text-2xl font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md flex items-center justify-center h-32">
                        <span class="text-2xl font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-8 rounded-xl shadow-md flex items-center justify-center h-32">
                        <span class="text-2xl font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                </div>
            </div>

            <!-- Gold sponsors -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-center">Gold Sponsors</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div
                        class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-md flex items-center justify-center h-24">
                        <span class="text-lg font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-md flex items-center justify-center h-24">
                        <span class="text-lg font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-md flex items-center justify-center h-24">
                        <span class="text-lg font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-md flex items-center justify-center h-24">
                        <span class="text-lg font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                </div>
            </div>

            <!-- Silver sponsors -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-center">Silver Sponsors</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                    <div
                        class="bg-white dark:bg-background-dark p-4 rounded-lg shadow-md flex items-center justify-center h-20">
                        <span class="text-md font-bold text-gray-300 dark:text-gray-700">Sponsor Logo</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-text-secondary-light dark:text-text-secondary-dark mb-6">
                Interested in sponsoring PHP Tek 2026?
            </p>
            <a href="#"
               class="bg-primary-light dark:bg-primary-dark text-white px-6 py-3 rounded-lg inline-block font-medium hover:bg-opacity-90 transition-all shadow-md hover:shadow-lg">
                Become a Sponsor
            </a>
        </div>
    </div>
</section>

<!-- Registration section -->
<section id="register" class="py-20 relative overflow-hidden transition-colors duration-300">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary-light/5 dark:bg-primary-dark/5 rounded-full"></div>
        <div
            class="absolute bottom-0 left-1/4 w-80 h-80 bg-secondary-light/5 dark:bg-secondary-dark/5 rounded-full"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Register Now</h2>
                <p class="text-text-secondary-light dark:text-text-secondary-dark max-w-2xl mx-auto">
                    Secure your spot at PHP Tek 2026 and join the PHP community for an unforgettable experience.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Early Bird ticket -->
                <div
                    class="bg-white dark:bg-background-dark rounded-xl shadow-lg overflow-hidden border-t-4 border-primary-light dark:border-primary-dark transition-transform hover:-translate-y-1 duration-300">
                    <div class="p-8">
                        <h3 class="font-bold text-xl mb-2">Early Bird</h3>
                        <div class="flex items-baseline mb-6">
                            <span class="text-4xl font-bold">$599</span>
                            <span class="text-text-secondary-light dark:text-text-secondary-dark ml-2">USD</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-6">
                            Available until December 31, 2025
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Full conference access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Workshop access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Conference materials</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Lunch and refreshments</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Evening reception</span>
                            </li>
                        </ul>
                        <a href="#"
                           class="block bg-primary-light dark:bg-primary-dark text-white text-center py-3 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                            Register Now
                        </a>
                    </div>
                </div>

                <!-- Standard ticket -->
                <div
                    class="bg-white dark:bg-background-dark rounded-xl shadow-lg overflow-hidden border-t-4 border-secondary-light dark:border-secondary-dark relative transform scale-105 md:scale-110 z-10 transition-transform hover:-translate-y-1 duration-300">
                    <div
                        class="absolute top-0 right-0 bg-secondary-light dark:bg-secondary-dark text-white text-xs font-bold py-1 px-3 rounded-bl-lg">
                        POPULAR
                    </div>
                    <div class="p-8">
                        <h3 class="font-bold text-xl mb-2">Standard</h3>
                        <div class="flex items-baseline mb-6">
                            <span class="text-4xl font-bold">$799</span>
                            <span class="text-text-secondary-light dark:text-text-secondary-dark ml-2">USD</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-6">
                            Available until April 15, 2026
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Full conference access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Workshop access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Conference materials</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Lunch and refreshments</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Evening reception</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Conference t-shirt</span>
                            </li>
                        </ul>
                        <a href="#"
                           class="block bg-secondary-light dark:bg-secondary-dark text-white text-center py-3 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                            Register Now
                        </a>
                    </div>
                </div>

                <!-- Late ticket -->
                <div
                    class="bg-white dark:bg-background-dark rounded-xl shadow-lg overflow-hidden border-t-4 border-primary-light dark:border-primary-dark transition-transform hover:-translate-y-1 duration-300">
                    <div class="p-8">
                        <h3 class="font-bold text-xl mb-2">Late Registration</h3>
                        <div class="flex items-baseline mb-6">
                            <span class="text-4xl font-bold">$999</span>
                            <span class="text-text-secondary-light dark:text-text-secondary-dark ml-2">USD</span>
                        </div>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-6">
                            After April 15, 2026
                        </p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Full conference access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Workshop access</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Conference materials</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Lunch and refreshments</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <span>Evening reception</span>
                            </li>
                        </ul>
                        <a href="#"
                           class="block bg-primary-light dark:bg-primary-dark text-white text-center py-3 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                            Register Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 bg-white dark:bg-background-dark rounded-xl shadow-md p-8">
                <h3 class="font-bold text-xl mb-4">Group Discounts</h3>
                <p class="text-text-secondary-light dark:text-text-secondary-dark mb-6">
                    Save on registration when you bring your team. Special discounts are available for groups of 3 or
                    more.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#"
                       class="bg-primary-light dark:bg-primary-dark text-white px-6 py-3 rounded-lg text-center font-medium hover:bg-opacity-90 transition-all">
                        Contact for Group Rates
                    </a>
                    <a href="#"
                       class="border border-gray-300 dark:border-gray-700 px-6 py-3 rounded-lg text-center font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                        Download Registration PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter signup -->
<section class="py-16 bg-primary-light dark:bg-primary-dark text-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-display font-bold mb-6">Stay Updated</h2>
            <p class="text-white/80 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter to receive updates about speakers, schedules, and special promotions.
            </p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                <input type="email" placeholder="Enter your email address"
                       class="flex-1 px-4 py-3 rounded-lg text-text-primary-light dark:text-text-primary-dark focus:outline-none">
                <button type="submit"
                        class="bg-white text-primary-light dark:text-primary-dark px-6 py-3 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer
    class="bg-white dark:bg-background-dark py-12 border-t border-gray-200 dark:border-gray-800 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-1">
                <a href="#" class="flex items-center mb-4">
                    <span
                        class="text-2xl font-display font-bold text-primary-light dark:text-primary-dark">PHPTek</span>
                    <span
                        class="ml-1 bg-primary-light dark:bg-primary-dark text-white text-xs font-bold py-1 px-2 rounded">2026</span>
                </a>
                <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm mb-6">
                    The premier PHP conference of 2026, bringing together developers, experts, and community leaders.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                       class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="h-5 w-5">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                        </svg>
                    </a>
                    <a href="#"
                       class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="h-5 w-5">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                    <a href="#"
                       class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="h-5 w-5">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="#"
                       class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="h-5 w-5">
                            <path
                                d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#about"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">About</a>
                    </li>
                    <li><a href="#speakers"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Speakers</a>
                    </li>
                    <li><a href="#schedule"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Schedule</a>
                    </li>
                    <li><a href="#venue"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Venue</a>
                    </li>
                    <li><a href="#sponsors"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Sponsors</a>
                    </li>
                    <li><a href="#register"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Register</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Resources</h4>
                <ul class="space-y-2">
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Code
                            of Conduct</a></li>
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">FAQs</a>
                    </li>
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Travel
                            Information</a></li>
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Accommodation</a>
                    </li>
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Speaker
                            Guidelines</a></li>
                    <li><a href="#"
                           class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary-light dark:hover:text-primary-dark transition-colors">Press
                            Kit</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-4">Contact Us</h4>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-text-secondary-light dark:text-text-secondary-dark mr-2 mt-0.5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-text-secondary-light dark:text-text-secondary-dark">info@phptek2026.com</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-text-secondary-light dark:text-text-secondary-dark mr-2 mt-0.5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-text-secondary-light dark:text-text-secondary-dark">+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5 text-text-secondary-light dark:text-text-secondary-dark mr-2 mt-0.5"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-text-secondary-light dark:text-text-secondary-dark">
                                Tech Convention Center<br>
                                123 Innovation Drive<br>
                                Chicago, IL 60601
                            </span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-gray-200 dark:border-gray-700 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">
                &copy; 2026 PHP Tek Conference. All rights reserved.
            </p>
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="#"
                   class="text-text-secondary-light dark:text-text-secondary-dark text-sm hover:text-primary-light dark:hover:text-primary-dark transition-colors">Privacy
                    Policy</a>
                <a href="#"
                   class="text-text-secondary-light dark:text-text-secondary-dark text-sm hover:text-primary-light dark:hover:text-primary-dark transition-colors">Terms
                    of Service</a>
                <a href="#"
                   class="text-text-secondary-light dark:text-text-secondary-dark text-sm hover:text-primary-light dark:hover:text-primary-dark transition-colors">Cookie
                    Policy</a>
            </div>
        </div>
    </div>
</footer>
<!-- Back to top button -->
<button id="backToTop"
        x-data="{ showButton: false }"
        x-init="window.addEventListener('scroll', () => { showButton = window.scrollY > 500 })"
        x-show="showButton"
        x-transition.opacity
        @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-6 right-6 bg-primary-light dark:bg-primary-dark text-white p-3 rounded-full shadow-lg hover:bg-opacity-90 transition-all z-50 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
    </svg>
</button>

@vite('resources/js/app.js')
<script>
    // Check for user preference or system preference for dark mode
    if (localStorage.getItem('darkMode') === null) {
        // Check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
    }
</script>
</body>
</html>
