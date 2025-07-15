@props(['conference'])

<!-- Hero content -->
<div class="relative pt-12 pb-24 md:pt-20 md:pb-40 overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-tek-blue-100 dark:bg-tek-blue-800/20 text-tek-blue-800 dark:text-tek-blue-300 font-medium text-sm mb-4">
                        {{ $conference ? $conference->getFormattedDateRange() : 'May 18-22, 2026' }}
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold leading-tight">
                        The Premier <span class="text-tek-orange-900 dark:text-tek-orange-400">PHP</span> Conference of 2026
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-slate-300 text-lg md:text-xl max-w-xl">
                    Join us for 5 days of expert-led sessions, hands-on workshops, and unparalleled networking opportunities with the PHP community.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#register" class="bg-tek-orange-900 dark:bg-tek-orange-600 text-white px-8 py-3 rounded-lg text-center font-medium hover:bg-tek-orange-800 dark:hover:bg-tek-orange-700 transition-all shadow-md hover:shadow-lg">
                        Register Now
                    </a>
                    <a href="#speakers" class="border border-tek-blue-300 dark:border-tek-blue-700 text-tek-blue-800 dark:text-tek-blue-300 px-8 py-3 rounded-lg text-center font-medium hover:bg-tek-blue-50 dark:hover:bg-tek-blue-800/20 transition-all">
                        View Speakers
                    </a>
                </div>
                <div class="pt-4">
                    <div class="flex items-center">
                        <div class="flex -space-x-2">
                            <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Attendee" class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Attendee" class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Attendee" class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Attendee" class="w-10 h-10 rounded-full border-2 border-white dark:border-background-dark">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 border-2 border-white dark:border-background-dark text-sm font-medium">
                                +2K
                            </div>
                        </div>
                        <p class="ml-4 text-sm text-gray-600 dark:text-slate-300">
                            <span class="font-medium">2,000+</span> developers already registered
                        </p>
                    </div>
                </div>
            </div>
            <div class="relative hidden md:block">
                <div class="absolute -top-10 -right-10 w-72 h-72 bg-tek-blue-200/60 dark:bg-tek-blue-800/20 rounded-full filter blur-3xl opacity-80 dark:opacity-70"></div>
                <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-tek-orange-200/60 dark:bg-tek-orange-800/20 rounded-full filter blur-3xl opacity-80 dark:opacity-70"></div>
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop" alt="PHP Tek Conference" class="rounded-2xl shadow-2xl relative z-10 transform hover:-translate-y-2 transition-transform duration-300">
            </div>
        </div>
    </div>

    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-tek-orange-100/50 dark:bg-tek-orange-900/10 rounded-full"></div>
        <div class="absolute top-1/3 right-0 w-64 h-64 bg-tek-blue-100/50 dark:bg-tek-blue-900/10 rounded-full"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 bg-tek-orange-100/50 dark:bg-tek-orange-900/10 rounded-full"></div>
        <!-- Additional light mode circles -->
        <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-tek-blue-50/70 dark:bg-tek-blue-900/5 rounded-full filter blur-2xl"></div>
        <div class="absolute bottom-1/4 right-1/3 w-32 h-32 bg-tek-orange-50/80 dark:bg-tek-orange-900/5 rounded-full filter blur-xl"></div>
    </div>
</div>