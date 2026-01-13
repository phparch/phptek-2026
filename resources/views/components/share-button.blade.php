<!-- Share Button Component -->
<div x-data="{ shareDropdown: false }" class="relative">
    <!-- Share Button -->
    <button @click="shareDropdown = !shareDropdown"
            class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-tek-blue-500 focus:ring-opacity-50"
            aria-label="Share options"
            :aria-expanded="shareDropdown.toString()"
            :aria-controls="'share-dropdown'"
            @keydown.escape="shareDropdown = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
        </svg>
        <span class="hidden sm:inline text-sm font-medium text-gray-700 dark:text-gray-200">Share</span>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="shareDropdown"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         x-trap="shareDropdown"
         @click.away="shareDropdown = false"
         @keydown.escape="shareDropdown = false"
         id="share-dropdown"
         class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-gray-200 dark:border-slate-600 py-2 z-50"
         role="menu"
         aria-label="Share menu"
         aria-labelledby="share-button"
         style="display: none;">

        <!-- X (formerly Twitter) -->
        <button onclick="shareOnX(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
                class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
                role="menuitem"
                aria-label="Share on X (formerly Twitter)">
            <svg class="h-4 w-4 mr-3 text-gray-900 dark:text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
            Share on X
        </button>

        <!-- Bluesky -->
        <button
            onclick="shareOnBluesky(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Share on Bluesky">
            <svg class="h-4 w-4 mr-3 text-blue-500" fill="currentColor" viewBox="0 0 24 12" aria-hidden="true">
                <path
                    d="M12 8 C9 2, 2 0, 1 4 c-1 2, 2 4, 5 4 -3 1-4 4-1 4 s6-3, 6-4 M12 8 C15 2, 22 0, 23 4 c1 2-2 4-5 4 3 1 4 4 1 4 s-6-3-6-4"/>
            </svg>
            Share on Bluesky
        </button>

        <!-- Mastodon -->
        <button
            onclick="shareOnMastodon(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Share on Mastodon">
            <svg class="h-4 w-4 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z"/>
            </svg>
            Share on Mastodon
        </button>

        <!-- Facebook -->
        <button
            onclick="shareOnFacebook(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Share on Facebook">
            <svg class="h-4 w-4 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            Share on Facebook
        </button>

        <!-- LinkedIn -->
        <button
            onclick="shareOnLinkedIn(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Share on LinkedIn">
            <svg class="h-4 w-4 mr-3 text-blue-700" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
            Share on LinkedIn
        </button>

        <!-- Email -->
        <button
            onclick="shareViaEmail(); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Share via email">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Share via Email
        </button>

        <!-- Divider -->
        <div class="border-t border-gray-200 dark:border-slate-600 my-2"></div>

        <!-- Copy Link -->
        <button
            onclick="copyToClipboard(this); document.querySelector('[x-data*=shareDropdown]').__x.$data.shareDropdown = false"
            class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors"
            role="menuitem"
            aria-label="Copy link to clipboard">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            Copy Link
        </button>
    </div>
</div>

<script>
    function shareOnX() {
        const siteTitle = 'PHP Tek 2026 - The Premier PHP Conference';
        const siteUrl = window.location.href;
        const text = encodeURIComponent(`Check out ${siteTitle}! 🚀`);
        const url = encodeURIComponent(siteUrl);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
    }

    function shareOnBluesky() {
        const siteTitle = 'PHP Tek 2026 - The Premier PHP Conference';
        const siteUrl = window.location.href;
        const text = encodeURIComponent(`Check out ${siteTitle}! 🚀\n\n${siteUrl}`);
        window.open(`https://bsky.app/intent/compose?text=${text}`, '_blank');
    }

    function shareOnMastodon() {
        const siteTitle = 'PHP Tek 2026 - The Premier PHP Conference';
        const siteUrl = window.location.href;
        const text = encodeURIComponent(`Check out ${siteTitle}! 🚀\n\n${siteUrl}`);
        // Opens the default Mastodon instance - users can change the instance if needed
        window.open(`https://phpc.social/share?text=${text}`, '_blank');
    }

    function shareOnFacebook() {
        const siteUrl = window.location.href;
        const url = encodeURIComponent(siteUrl);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    }

    function shareOnLinkedIn() {
        const siteTitle = 'PHP Tek 2026 - The Premier PHP Conference';
        const siteUrl = window.location.href;
        const url = encodeURIComponent(siteUrl);
        const title = encodeURIComponent(siteTitle);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}&title=${title}`, '_blank');
    }

    function shareViaEmail() {
        const siteTitle = 'PHP Tek 2026 - The Premier PHP Conference';
        const siteUrl = window.location.href;
        const subject = encodeURIComponent(siteTitle);
        const body = encodeURIComponent(`I wanted to share this with you: ${siteTitle}\n\n${siteUrl}\n\nJoin us for the premier PHP conference featuring expert speakers, hands-on workshops, and networking opportunities!`);
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
    }

    function copyToClipboard(button) {
        const siteUrl = window.location.href;

        // Try modern Clipboard API first
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(siteUrl).then(() => {
                showCopySuccess(button);
            }).catch(() => {
                fallbackCopyToClipboard(siteUrl, button);
            });
        } else {
            // Fallback for older browsers or non-HTTPS
            fallbackCopyToClipboard(siteUrl, button);
        }
    }

    function showCopySuccess(button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<span class="text-green-600 dark:text-green-400">✓ Copied!</span>';

        // Announce to screen readers
        const liveRegion = document.getElementById('live-region');
        if (liveRegion) {
            liveRegion.textContent = 'Link copied to clipboard';
        }

        setTimeout(() => {
            button.innerHTML = originalText;
        }, 2000);
    }

    function fallbackCopyToClipboard(text, button) {
        // Create a temporary textarea element
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            showCopySuccess(button);
        } catch (err) {
            // If all else fails, show the URL to the user
            button.innerHTML = '<span class="text-red-600 dark:text-red-400">Copy failed</span>';
            setTimeout(() => {
                button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />></svg>Copy Link';
            }, 2000);
            // Optionally, you could also show an alert or prompt with the URL
            alert('Copy failed. Here is the URL to copy manually: ' + text);
        }

        document.body.removeChild(textArea);
    }
</script>
