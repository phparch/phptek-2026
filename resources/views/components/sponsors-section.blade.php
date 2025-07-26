<!-- Sponsors section -->
<section id="sponsors" class="py-20 bg-gray-50 dark:bg-slate-800 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Our Sponsors</h2>
            <p class="text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">
                PHP Tek 2026 is made possible thanks to the support of our amazing sponsors.
            </p>
        </div>

        <div class="space-y-12">
            @foreach($sponsorsByLevel as $level => $sponsors)
                <div class="text-center">
                    <h3 class="text-xl font-bold mb-6">{{ $getLevelDisplayName($level) }}</h3>
                    <div class="flex justify-center">
                        <div class="grid {{ $getGridClasses($level) }} gap-6 mx-auto">
                            @foreach($sponsors as $sponsor)
                                <div
                                    class="bg-white dark:bg-slate-700 rounded-xl shadow-md dark:shadow-slate-900/50 {{ $getCardClasses($level) }} cursor-pointer transition-transform hover:scale-105"
                                    onclick="openSponsorModal('{{ $sponsor->uuid }}')"
                                    data-sponsor-uuid="{{ $sponsor->uuid }}">
                                    <div class="flex flex-col items-center justify-center h-full">
                                        @if($sponsor->logo)
                                            @if(str_starts_with($sponsor->logo, 'http'))
                                                <img src="{{ $sponsor->logo }}" alt="{{ $sponsor->name }}"
                                                     class="max-h-16 max-w-full object-contain mb-2">
                                            @elseif(file_exists(public_path($sponsor->logo)))
                                                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                                     class="max-h-16 max-w-full object-contain mb-2">
                                            @else
                                                <div
                                                    class="w-16 h-16 bg-gray-200 dark:bg-slate-600 rounded-lg flex items-center justify-center mb-2">
                                                    <span
                                                        class="text-xs font-bold text-gray-500 dark:text-slate-400">LOGO</span>
                                                </div>
                                            @endif
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gray-200 dark:bg-slate-600 rounded-lg flex items-center justify-center mb-2">
                                                <span
                                                    class="text-xs font-bold text-gray-500 dark:text-slate-400">LOGO</span>
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <p class="font-semibold text-sm">{{ $sponsor->name }}</p>
                                            @if($level === 'other' && $sponsor->pivot->sponsorship_level_details)
                                                <p class="text-xs text-gray-600 dark:text-slate-400 mt-1">{{ $sponsor->pivot->sponsorship_level_details }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-16">
            <p class="text-gray-600 dark:text-slate-300 mb-4">
                Interested in sponsoring PHP Tek 2026?
            </p>
            <a href="#" class="inline-flex items-center text-tek-blue-700 dark:text-tek-blue-400 font-medium">
                View Sponsorship Opportunities
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Sponsor Modal -->
    <div id="sponsor-modal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4"
         onclick="closeSponsorModal()">
        <div
            class="bg-white dark:bg-slate-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col"
            onclick="event.stopPropagation()">
            <!-- Header -->
            <div
                class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-slate-600 flex-shrink-0">
                <h3 id="modal-sponsor-name" class="text-2xl font-bold text-gray-900 dark:text-white"></h3>
                <button onclick="closeSponsorModal()"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 overflow-y-auto">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/3">
                        <div id="modal-sponsor-logo"
                             class="bg-gray-100 dark:bg-slate-700 rounded-lg p-4 flex items-center justify-center h-32">
                            <!-- Logo will be inserted here -->
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Website</h4>
                                <a id="modal-sponsor-website" href="#" target="_blank"
                                   class="text-tek-blue-700 dark:text-tek-blue-400 hover:underline">
                                    <!-- Website URL will be inserted here -->
                                </a>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">About</h4>
                                <div id="modal-sponsor-description"
                                     class="text-gray-600 dark:text-slate-300 prose prose-sm dark:prose-invert max-w-none">
                                    <!-- Description will be inserted here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Store sponsor data for modal
        const sponsorData = @json($sponsorsByLevel->flatten()->keyBy('uuid'));

        // Make functions global
        window.openSponsorModal = function (sponsorUuid) {
            const sponsor = sponsorData[sponsorUuid];
            if (!sponsor) {
                console.error('Sponsor not found:', sponsorUuid);
                return;
            }

            console.log('Opening modal for sponsor:', sponsor.name);

            document.getElementById('modal-sponsor-name').textContent = sponsor.name;
            document.getElementById('modal-sponsor-website').href = sponsor.website;
            document.getElementById('modal-sponsor-website').textContent = sponsor.website;
            document.getElementById('modal-sponsor-description').innerHTML = sponsor.description || 'No description available.';

            // Update logo
            const logoContainer = document.getElementById('modal-sponsor-logo');
            if (sponsor.logo) {
                let logoSrc;
                if (sponsor.logo.startsWith('http')) {
                    logoSrc = sponsor.logo;
                } else {
                    logoSrc = `{{ asset('') }}${sponsor.logo}`;
                }
                logoContainer.innerHTML = `<img src="${logoSrc}" alt="${sponsor.name}" class="max-h-24 max-w-full object-contain">`;
            } else {
                logoContainer.innerHTML = `<span class="text-2xl font-bold text-gray-300 dark:text-slate-500">LOGO</span>`;
            }

            // Show modal
            document.getElementById('sponsor-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };

        window.closeSponsorModal = function () {
            document.getElementById('sponsor-modal').classList.add('hidden');
            document.body.style.overflow = '';
        };

        // Close modal on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                window.closeSponsorModal();
            }
        });
    });
</script>
