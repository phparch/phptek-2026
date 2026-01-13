<!-- Code of Conduct Modal -->
<div x-data="{ open: false }"
     @open-coc-modal.window="open = true"
     @keydown.escape.window="open = false">

    <!-- Modal overlay -->
    <div x-show="open"
         x-transition.opacity
         x-trap="open"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click="open = false"
         role="dialog"
         aria-modal="true"
         aria-labelledby="coc-title"
         style="display: none;"
         x-cloak>

        <!-- Modal content -->
        <div x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             @click.stop
             class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-slate-600 flex-shrink-0">
                <h2 id="coc-title" class="text-2xl font-bold text-gray-900 dark:text-white">Code of Conduct</h2>
                <button @click="open = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-tek-blue-500 rounded"
                        aria-label="Close code of conduct modal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 overflow-y-auto" style="max-height: calc(90vh - 200px);">
                <div class="prose prose-gray dark:prose-invert max-w-none">
                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Our Commitment</h3>
                    <p class="mb-6">
                        PHP Tek is dedicated to providing a harassment-free conference experience for everyone, regardless of gender, gender identity and expression, age, sexual orientation, disability, physical appearance, body size, race, ethnicity, religion (or lack thereof), or technology choices.
                    </p>

                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Expected Behavior</h3>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Be respectful and inclusive in speech and actions</li>
                        <li>Refrain from demeaning, discriminatory, or harassing behavior and speech</li>
                        <li>Be mindful of your surroundings and of your fellow participants</li>
                        <li>Alert conference organizers if you notice violations of this Code of Conduct</li>
                        <li>Respect the conference venue and equipment</li>
                    </ul>

                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Unacceptable Behavior</h3>
                    <p class="mb-4">
                        Unacceptable behaviors include: intimidating, harassing, abusive, discriminatory, derogatory or demeaning speech or actions by any participant in our community online, at all related events and in one-on-one communications carried out in the context of community business.
                    </p>
                    <p class="mb-6">
                        Harassment includes: harmful or prejudicial verbal or written comments related to gender, sexual orientation, race, religion, disability; inappropriate use of nudity and/or sexual images; inappropriate depictions of violence; deliberate intimidation, stalking or following; harassing photography or recording; sustained disruption of talks or other events; inappropriate physical contact, and unwelcome sexual attention.
                    </p>

                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Consequences</h3>
                    <p class="mb-6">
                        Anyone asked to stop unacceptable behavior is expected to comply immediately. If a participant engages in unacceptable behavior, conference organizers may take any action they deem appropriate, including warning the offender or expulsion from the conference without refund.
                    </p>

                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Reporting</h3>
                    <p class="mb-4">
                        If you are subject to or witness unacceptable behavior, or have any other concerns, please notify a conference organizer as soon as possible.
                    </p>
                    <p class="mb-6">
                        You can report incidents by:
                    </p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Email: <a href="mailto:tek@phparch.com" class="text-tek-blue-700 dark:text-tek-blue-400 hover:underline">tek@phparch.com</a></li>
                        <li>Speaking to any conference organizer or volunteer</li>
                        <li>DM'ing one of the conference organizers or volunteers from the conference Discord server</li>
                    </ul>

                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Scope</h3>
                    <p class="mb-6">
                        This Code of Conduct applies to all conference venues and conference-related social events. We expect all conference participants to abide by this Code of Conduct at all conference venues and conference-related events.
                    </p>

                    <div class="bg-tek-blue-50 dark:bg-tek-blue-900/20 p-4 rounded-lg">
                        <p class="text-sm text-tek-blue-800 dark:text-tek-blue-300 font-medium">
                            This Code of Conduct is adapted from the Conference Code of Conduct and licensed under Creative Commons Attribution-ShareAlike.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end p-6 border-t border-gray-200 dark:border-slate-600 flex-shrink-0">
                <button @click="open = false"
                        class="px-6 py-2 bg-tek-blue-700 hover:bg-tek-blue-800 dark:bg-tek-blue-600 dark:hover:bg-tek-blue-700 text-white rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
