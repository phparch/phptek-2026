<!-- Schedule section -->
<section id="schedule" class="py-20 bg-gray-50 dark:bg-slate-800 transition-colors duration-300">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Schedule</h2>
        </div>

        <div id="schedule-grid"></div>
        <script>
            (function () {
                var container = document.getElementById('schedule-grid');
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://sessionize.com/api/v2/7u1xfdke/view/GridSmart?under=True', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        container.innerHTML = xhr.responseText;
                        if (typeof sessionize !== 'undefined' && typeof sessionize.onLoad === 'function') {
                            sessionize.onLoad();
                        }
                    }
                };
                xhr.send();
            })();
        </script>
    </div>
</section>
