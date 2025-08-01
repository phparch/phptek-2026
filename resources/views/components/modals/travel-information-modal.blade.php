<!-- Travel Information Modal -->
<div x-data="{ open: false }"
     @open-travel-modal.window="open = true">

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
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-slate-600 flex-shrink-0">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Travel Information</h2>
                <button @click="open = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 overflow-y-auto" style="max-height: calc(90vh - 200px);">
                <div class="flex items-center justify-center min-h-[200px]">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-tek-blue-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">Coming Soon</h3>
                        <p class="text-gray-600 dark:text-slate-300 text-lg">
                            Travel information and recommendations will be available soon.
                        </p>
                        <p class="text-gray-500 dark:text-slate-400 text-sm mt-2">
                            Check back later for details about transportation, accommodations, and local attractions.
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