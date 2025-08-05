<!-- Navigation -->
<nav
    class="fixed top-0 left-0 right-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm transition-colors duration-300 border-b border-gray-200/50 dark:border-slate-700/50"
    x-data="{
         darkMode: localStorage.getItem('darkMode') !== 'false',
         toggleTheme() {
             this.darkMode = !this.darkMode;
             localStorage.setItem('darkMode', this.darkMode);
             document.documentElement.classList.toggle('dark', this.darkMode);
         }
     }"
    x-init="document.documentElement.classList.toggle('dark', darkMode)">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="flex items-center">
                    <img src="https://cdn.phparch.social/phptek2026/logos/phptek_2026_logo.svg" alt="PHP Tek 2026 Logo"
                         class="h-10 w-10 mr-3">
                    <span class="text-3xl font-display font-bold text-tek-blue-800 dark:text-tek-blue-400">PHPTek</span>
                    <span
                        class="ml-1 bg-tek-orange-900 dark:bg-tek-orange-600 text-white text-sm font-bold py-1 px-2 rounded">2026</span>
                </a>
            </div>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="#about"
                   class="font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">About</a>
                <a href="#speakers"
                   class="font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Speakers</a>
                {{--                <a href="#schedule" class="font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Schedule</a>--}}
                <a href="#venue"
                   class="font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Venue</a>
                <a href="#sponsors"
                   class="font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Partners</a>
                <a href="#register"
                   class="bg-tek-orange-900 dark:bg-tek-orange-600 text-white px-5 py-2 rounded-lg hover:bg-tek-orange-800 dark:hover:bg-tek-orange-700 transition-all shadow-md hover:shadow-lg">Register
                    Now</a>

                <!-- Theme toggle button -->
                <button @click="toggleTheme()" class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 focus:outline-none">
                    <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
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
                     class="absolute top-full right-0 left-0 bg-white dark:bg-slate-800 shadow-lg rounded-b-lg p-6 space-y-4 z-40 border border-gray-200 dark:border-slate-700">
                    <a href="#about" @click="mobileMenu = false"
                       class="block font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">About</a>
                    <a href="#speakers" @click="mobileMenu = false"
                       class="block font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Speakers</a>
                    {{--                    <a href="#schedule" @click="mobileMenu = false" class="block font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Schedule</a>--}}
                    <a href="#venue" @click="mobileMenu = false"
                       class="block font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Venue</a>
                    <a href="#sponsors" @click="mobileMenu = false"
                       class="block font-medium hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">Partners</a>
                    <a href="#register" @click="mobileMenu = false"
                       class="block bg-tek-orange-900 dark:bg-tek-orange-600 text-white px-5 py-2 rounded-lg text-center">Register
                        Now</a>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-slate-600">
                        <span class="text-sm text-gray-600 dark:text-slate-400">Theme</span>
                        <button @click="toggleTheme()"
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
                </div>
            </div>
        </div>
    </div>
</nav>
