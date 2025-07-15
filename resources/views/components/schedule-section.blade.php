<!-- Schedule section -->
<section id="schedule" class="py-20 bg-gray-50 dark:bg-slate-800 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Conference Schedule</h2>
            <p class="text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">
                Five days of engaging talks, workshops, and networking events.
            </p>
        </div>

        <div class="bg-white dark:bg-slate-700 rounded-xl shadow-md dark:shadow-slate-900/50 overflow-hidden"
             x-data="{ activeDay: 'day1' }">
            <!-- Tab navigation -->
            <div class="flex flex-wrap border-b border-gray-200 dark:border-slate-600">
                <button @click="activeDay = 'day1'"
                        :class="{ 'border-tek-blue-700 dark:border-tek-blue-400 text-tek-blue-700 dark:text-tek-blue-400': activeDay === 'day1' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">
                    Day 1: May 19
                </button>
                <button @click="activeDay = 'day2'"
                        :class="{ 'border-tek-blue-700 dark:border-tek-blue-400 text-tek-blue-700 dark:text-tek-blue-400': activeDay === 'day2' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">
                    Day 2: May 20
                </button>
                <button @click="activeDay = 'day3'"
                        :class="{ 'border-tek-blue-700 dark:border-tek-blue-400 text-tek-blue-700 dark:text-tek-blue-400': activeDay === 'day3' }"
                        class="py-4 px-6 font-medium border-b-2 border-transparent hover:text-tek-blue-700 dark:hover:text-tek-blue-400 transition-colors">
                    Day 3: May 21
                </button>
            </div>

            <!-- Day 1 Schedule -->
            <div x-show="activeDay === 'day1'" class="p-6 space-y-6">
                <div class="border-l-4 border-tek-orange-700 dark:border-tek-orange-400 pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Workshops Day</h3>
                    <p class="text-gray-600 dark:text-slate-300">Intensive hands-on workshops to level up your
                        skills</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div
                        class="p-6 border border-gray-200 dark:border-slate-600 rounded-lg hover:shadow-md transition-shadow bg-white dark:bg-slate-600/50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-gray-600 dark:text-slate-400">9:00 AM - 12:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">Advanced Laravel Architecture</h4>
                            </div>
                            <span
                                class="bg-tek-orange-100 dark:bg-tek-orange-800/20 text-tek-orange-800 dark:text-tek-orange-300 text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-gray-600 dark:text-slate-300 text-sm mb-4">
                            Deep dive into Laravel's architecture patterns, service containers, and advanced dependency
                            injection.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Sarah Johnson</p>
                                <p class="text-sm text-gray-600 dark:text-slate-400">Laravel Core Team</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-slate-600 rounded-lg hover:shadow-md transition-shadow bg-white dark:bg-slate-600/50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-gray-600 dark:text-slate-400">9:00 AM - 12:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">PHP Security Masterclass</h4>
                            </div>
                            <span
                                class="bg-tek-orange-100 dark:bg-tek-orange-800/20 text-tek-orange-800 dark:text-tek-orange-300 text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-gray-600 dark:text-slate-300 text-sm mb-4">
                            Hands-on security workshop covering OWASP Top 10, security best practices, and real-world
                            examples.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Emma Rodriguez</p>
                                <p class="text-sm text-gray-600 dark:text-slate-400">Security Expert</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-slate-600 rounded-lg hover:shadow-md transition-shadow bg-white dark:bg-slate-600/50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-gray-600 dark:text-slate-400">1:00 PM - 4:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">High-Performance PHP Applications</h4>
                            </div>
                            <span
                                class="bg-tek-orange-100 dark:bg-tek-orange-800/20 text-tek-orange-800 dark:text-tek-orange-300 text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-gray-600 dark:text-slate-300 text-sm mb-4">
                            Optimize PHP applications for maximum performance, from code-level optimizations to caching
                            strategies.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Michael Chen</p>
                                <p class="text-sm text-gray-600 dark:text-slate-400">PHP Core Contributor</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-6 border border-gray-200 dark:border-slate-600 rounded-lg hover:shadow-md transition-shadow bg-white dark:bg-slate-600/50">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-sm text-gray-600 dark:text-slate-400">1:00 PM - 4:00 PM</span>
                                <h4 class="font-bold text-lg mt-1">Symfony Components Deep Dive</h4>
                            </div>
                            <span
                                class="bg-tek-orange-100 dark:bg-tek-orange-800/20 text-tek-orange-800 dark:text-tek-orange-300 text-xs py-1 px-2 rounded">Workshop</span>
                        </div>
                        <p class="text-gray-600 dark:text-slate-300 text-sm mb-4">
                            Explore Symfony's powerful components and learn how to leverage them in any PHP project.
                        </p>
                        <div class="flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Speaker"
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">James Wilson</p>
                                <p class="text-sm text-gray-600 dark:text-slate-400">Symfony Maintainer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="#" class="text-tek-blue-700 dark:text-tek-blue-400 font-medium inline-flex items-center">
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
                <div class="border-l-4 border-tek-orange-700 dark:border-tek-orange-400 pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 1</h3>
                    <p class="text-gray-600 dark:text-slate-300">Main conference tracks with keynotes and technical
                        sessions</p>
                </div>
                <p class="text-center text-gray-600 dark:text-slate-300">Full schedule coming soon...</p>
            </div>

            <div x-show="activeDay === 'day3'" class="p-6 space-y-6">
                <div class="border-l-4 border-tek-orange-700 dark:border-tek-orange-400 pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 2</h3>
                    <p class="text-gray-600 dark:text-slate-300">Main conference tracks with keynotes and technical
                        sessions</p>
                </div>
                <p class="text-center text-gray-600 dark:text-slate-300">Full schedule coming soon...</p>
            </div>

            <div x-show="activeDay === 'day4'" class="p-6 space-y-6">
                <div class="border-l-4 border-tek-orange-700 dark:border-tek-orange-400 pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Conference Day 3</h3>
                    <p class="text-gray-600 dark:text-slate-300">Main conference tracks with keynotes and technical
                        sessions</p>
                </div>
                <p class="text-center text-gray-600 dark:text-slate-300">Full schedule coming soon...</p>
            </div>

            <div x-show="activeDay === 'day5'" class="p-6 space-y-6">
                <div class="border-l-4 border-tek-orange-700 dark:border-tek-orange-400 pl-4 py-2 mb-8">
                    <h3 class="font-bold text-xl">Community Day</h3>
                    <p class="text-gray-600 dark:text-slate-300">Community-driven unconference and networking events</p>
                </div>
                <p class="text-center text-gray-600 dark:text-slate-300">Full schedule coming soon...</p>
            </div>
        </div>
    </div>
</section>
