<!-- Cookie Policy Modal -->
<div x-data="{ open: false }"
     @open-cookie-policy-modal.window="open = true">

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
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Cookie Policy</h2>
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
                    <section class="max-w-3xl mx-auto px-4 py-10 text-accent dark:text-white">
                        <div class="text-center mb-8">
                            <h1 class="text-4xl font-bold mb-2">🍪 Cookie Policy</h1>
                        </div>

                        <p class="mb-6">
                            At <span class="font-semibold">PHP Architect</span>, we are committed to protecting
                            your privacy and ensuring transparency in how we collect and use your data. This Cookie
                            Policy explains what cookies are, how we use them, and your choices regarding their use.
                        </p>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">1. What Are Cookies?</h2>
                        <p class="mb-6">
                            Cookies are small text files stored on your device when you visit a website. They help the
                            site remember your preferences, enhance functionality, and improve your browsing experience.
                            Some cookies are essential for the site to function properly; others are used for analytics
                            or personalization.
                        </p>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">2. Types of Cookies We Use</h2>
                        <ul class="list-disc list-inside space-y-4">
                            <li>
                                <strong>Essential Cookies</strong><br>
                                These cookies are necessary for the basic operation of our website. They enable core
                                functionality such as page navigation and secure access to certain areas. Our website
                                cannot function properly without these cookies.
                            </li>
                            <li>
                                <strong>Performance & Analytics Cookies</strong><br>
                                These cookies help us understand how visitors interact with our website by collecting
                                and reporting information anonymously. We use services like Google Analytics to analyze
                                usage patterns and improve the site over time.
                            </li>
                            <li>
                                <strong>Functionality Cookies</strong><br>
                                These cookies allow us to remember choices you’ve made (such as language preferences or
                                login credentials) to provide a more personalized experience.
                            </li>
                            <li>
                                <strong>Marketing & Third-Party Cookies</strong><br>
                                These cookies may be set by third-party services that appear on our site or are used for
                                advertising purposes. We only use these with your explicit consent.
                            </li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">3. How We Use Cookies</h2>
                        <p class="mb-6">
                            We use cookies to:
                        </p>
                        <ul class="list-disc list-inside mb-6 space-y-2">
                            <li>Ensure the website works as intended</li>
                            <li>Understand how visitors use our site</li>
                            <li>Improve website performance and content</li>
                            <li>Enable certain features such as login and user preferences</li>
                            <li>Serve relevant content and advertisements, where applicable</li>
                        </ul>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">4. Your Choices and Control</h2>
                        <p class="mb-6">
                            You can manage or disable cookies through your browser settings. Most browsers allow you to
                            refuse or delete cookies. However, disabling certain cookies may affect site functionality
                            and user experience.
                        </p>
                        <p class="mb-6">
                            Additionally, upon your first visit to our site, you will be prompted with a cookie banner
                            where you can manage your cookie preferences, including opting out of non-essential cookies.
                        </p>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">5. Third-Party Cookies</h2>
                        <p class="mb-6">
                            Some features on our website may rely on third-party services that may place their own
                            cookies. We do not control these cookies and recommend that you review the cookie policies
                            of those third parties for more information.
                        </p>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">6. Updates to This Policy</h2>
                        <p class="mb-6">
                            We may update this Cookie Policy from time to time to reflect changes in technology, legal
                            requirements, or our practices. When we do, we will revise the "Last Updated" date at the
                            top of this page.
                        </p>

                        <h2 class="text-2xl font-semibold mt-8 mb-4">7. Contact Us</h2>
                        <p>
                            If you have any questions or concerns about this Cookie Policy or our data practices, please
                            contact us at:
                        </p>
                        <address class="mt-4 not-italic text-gray-700">
                            <strong>PHP Architect</strong><br>
                            <a href="mailto:support@phparch.com" class="text-blue-600 hover:underline">support@phparch.com</a><br>
                            9245 Twin Trails DR, #720503, San Diego CA 92129 United States
                        </address>
                    </section>
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
