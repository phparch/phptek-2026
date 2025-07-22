<!-- Privacy Policy Modal -->
<div x-data="{ open: false }"
     @open-privacy-policy-modal.window="open = true">

    <!-- Modal overlay -->
    <div x-show="open"
         x-transition.opacity
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4"
         @click="open = false"
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
            <div
                class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-slate-600 flex-shrink-0">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Privacy Policy</h2>
                <button @click="open = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 overflow-y-auto" style="max-height: calc(90vh - 200px);">
                <div class="prose prose-gray dark:prose-invert max-w-none">
                    <h3 class="text-xl font-semibold mb-4 text-tek-blue-800 dark:text-tek-blue-400">Our Commitment</h3>
                    <p class="mb-6">
                        Whenever you visit our site, we track basic anonymous statistical information. We do this so
                        that we can
                        better
                        tailor our site to the needs of our users, and we only share the information collected with the
                        companies
                        that
                        provide us with statistical analysis. All personal information collected through making a
                        purchase remains
                        in
                        our possession and is shared with third parties only for the purpose of providing you with the
                        services we
                        provide. We do not sell or lease our attendee list to anyone. You will need to directly interact
                        with a
                        sponsor
                        at our event for that sponsor to gain access to your email address. We may, from time to time,
                        contact you
                        with
                        special offers and promotions. We take this privilege very seriously and do not intend to abuse
                        it; however,
                        you
                        can remove yourself from our mailing list by using the links at the bottom of any email we send.
                        You must be
                        older than 13 to use this website. We reserve the right to modify the terms of this Privacy
                        Policy at any
                        time
                        by posting such changes on our website no later than fifteen days before such changes take
                        effect.
                    </p>
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
