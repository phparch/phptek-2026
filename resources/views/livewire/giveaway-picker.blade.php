<?php

use App\Services\GiveawayEligibility;
use Livewire\Volt\Component;

new class extends Component
{
    /** @var array<int, array{badge_uuid: string, name: ?string}> */
    public array $attendees = [];

    public function mount(GiveawayEligibility $eligibility): void
    {
        $this->attendees = $eligibility->eligibleAttendees()->all();
    }
}; ?>

<div
    x-data="giveawayPicker(@js($attendees))"
    class="relative flex min-h-screen flex-col items-center overflow-hidden px-6 py-10"
>
    <div class="pointer-events-none absolute inset-0 -z-10 opacity-60"
         :class="isRolling ? 'animate-pulse' : ''">
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-orange-500/40 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-amber-500/40 blur-3xl"></div>
        <div class="absolute top-1/3 left-1/2 h-96 w-96 -translate-x-1/2 rounded-full bg-orange-600/30 blur-3xl"></div>
    </div>

    <div class="w-full max-w-5xl">
        <header class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.4em] text-orange-300">PHP Tek 2026</p>
            <h1 class="mt-2 bg-gradient-to-r from-orange-300 via-amber-200 to-orange-400 bg-clip-text text-5xl font-black text-transparent sm:text-6xl">
                Giveaway Drawing
            </h1>
            <p class="mt-4 text-orange-200/90">
                <span class="text-3xl font-bold text-white tabular-nums" x-text="remaining.length"></span>
                <span class="ml-1">of</span>
                <span class="text-xl font-semibold text-white tabular-nums" x-text="attendees.length"></span>
                <span class="ml-1">attendees still in the pool</span>
            </p>
        </header>

        <div
            class="relative mt-10 flex h-[28rem] items-center justify-center overflow-hidden rounded-3xl border bg-black/40 shadow-2xl backdrop-blur transition-all duration-500 sm:h-[36rem]"
            :class="isRolling
                ? 'border-orange-400/80 shadow-orange-500/40 ring-4 ring-orange-500/30'
                : (winner ? 'border-amber-300/80 shadow-amber-400/40 ring-4 ring-amber-300/40' : 'border-white/10')"
        >
            <div
                x-show="phase === 'idle' && !winner && remaining.length > 0"
                x-transition.opacity
                class="text-center"
            >
                <p class="text-2xl font-medium text-orange-100 sm:text-3xl">Press DRAW to pick a winner</p>
                <p class="mt-2 text-sm uppercase tracking-[0.3em] text-orange-300">Good luck!</p>
            </div>

            <div
                x-show="phase === 'idle' && !winner && remaining.length === 0 && attendees.length > 0"
                x-transition.opacity
                class="text-center"
            >
                <p class="text-3xl font-bold text-amber-300">All winners drawn!</p>
                <p class="mt-2 text-sm uppercase tracking-[0.3em] text-amber-300/70">Press Reset to start over</p>
            </div>

            <div
                x-show="phase === 'idle' && attendees.length === 0"
                x-transition.opacity
                class="text-center"
            >
                <p class="text-2xl font-medium text-orange-100 sm:text-3xl">No attendees are eligible yet</p>
            </div>

            <div
                x-show="isRolling && phase === 'spin'"
                x-transition.opacity
                class="flex w-full flex-col items-center"
            >
                <p class="text-xs uppercase tracking-[0.5em] text-orange-300">Drawing&hellip;</p>
                <div
                    class="mt-4 max-w-[90%] truncate text-4xl font-extrabold tracking-tight text-white drop-shadow-[0_0_18px_rgba(249,115,22,0.7)] sm:text-5xl"
                    x-text="rollDisplay"
                ></div>
            </div>

            <div
                x-show="isRolling && phase === 'anticipation'"
                x-transition.scale.duration.300ms
                class="flex flex-col items-center"
            >
                <p class="text-sm uppercase tracking-[0.5em] text-orange-300">drumroll please&hellip;</p>
                <div
                    class="mt-3 text-9xl font-black text-white drop-shadow-[0_0_30px_rgba(249,115,22,0.75)]"
                    x-text="countdown"
                    :key="countdown"
                    x-transition.scale.duration.250ms.opacity
                ></div>
            </div>

            <div
                x-show="winner && !isRolling"
                x-transition:enter="transition duration-700 ease-out"
                x-transition:enter-start="opacity-0 scale-50"
                x-transition:enter-end="opacity-100 scale-100"
                class="px-6 text-center"
            >
                <p class="text-sm font-semibold uppercase tracking-[0.5em] text-amber-300">Winner!</p>
                <p
                    class="mt-4 break-words bg-gradient-to-r from-amber-200 via-white to-orange-300 bg-clip-text text-[9rem] font-black leading-none text-transparent drop-shadow-[0_0_30px_rgba(251,146,60,0.7)] sm:text-[13.5rem]"
                    x-text="winner?.name ?? winner?.badge_uuid"
                ></p>
                <p class="mt-4 text-2xl">&#x1F389;&nbsp;Congratulations!&nbsp;&#x1F389;</p>
            </div>

            <div
                x-ref="confetti"
                class="pointer-events-none absolute inset-0 overflow-hidden"
            ></div>
        </div>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <button
                type="button"
                @click="draw()"
                :disabled="isRolling || remaining.length === 0"
                class="group relative overflow-hidden rounded-full bg-gradient-to-r from-orange-500 to-amber-400 px-12 py-5 text-xl font-black uppercase tracking-widest text-white shadow-2xl shadow-orange-500/40 transition hover:scale-105 hover:shadow-orange-500/60 disabled:cursor-not-allowed disabled:from-stone-600 disabled:to-stone-700 disabled:text-stone-300 disabled:shadow-none disabled:hover:scale-100"
            >
                <span x-show="!isRolling && remaining.length > 0">&#x1F3B2;&nbsp;Draw a Winner</span>
                <span x-show="isRolling">Drawing&hellip;</span>
                <span x-show="!isRolling && remaining.length === 0">All Drawn</span>
            </button>

            <button
                type="button"
                @click="reset()"
                :disabled="isRolling || (drawn.length === 0 && !winner)"
                class="rounded-full border border-white/20 bg-white/5 px-6 py-3 text-sm font-medium text-white/80 transition hover:bg-white/10 disabled:cursor-not-allowed disabled:opacity-40"
            >
                Reset
            </button>
        </div>

        <p class="mt-8 text-center text-xs uppercase tracking-[0.3em] text-orange-300/60">
            Drawn winners are excluded from subsequent draws in this session
        </p>
    </div>

    <script>
        function giveawayPicker(attendees) {
            return {
                attendees,
                drawn: [],
                winner: null,
                isRolling: false,
                rollDisplay: '',
                phase: 'idle',
                countdown: '',

                get remaining() {
                    return this.attendees.filter(a => !this.drawn.includes(a.badge_uuid));
                },

                draw() {
                    if (this.isRolling || this.remaining.length === 0) {
                        return;
                    }

                    const pool = this.remaining;
                    const winner = pool[Math.floor(Math.random() * pool.length)];
                    const labelOf = (a) => a.name ?? a.badge_uuid;

                    this.winner = null;
                    this.isRolling = true;
                    this.phase = 'spin';

                    const displayPool = this.attendees.length > 1 ? this.attendees : pool;
                    let elapsed = 0;
                    let interval = 50;
                    const spinDuration = 2400;

                    const spin = () => {
                        const pick = displayPool[Math.floor(Math.random() * displayPool.length)];
                        this.rollDisplay = labelOf(pick);
                        elapsed += interval;

                        if (elapsed >= spinDuration) {
                            this.anticipate(winner);
                            return;
                        }

                        interval = Math.min(220, interval * 1.06);
                        setTimeout(spin, interval);
                    };

                    setTimeout(spin, interval);
                },

                anticipate(winner) {
                    this.phase = 'anticipation';
                    const beats = ['3', '2', '1'];
                    let i = 0;

                    const tick = () => {
                        if (i >= beats.length) {
                            this.reveal(winner);
                            return;
                        }
                        this.countdown = beats[i++];
                        setTimeout(tick, 650);
                    };

                    tick();
                },

                reveal(winner) {
                    this.winner = winner;
                    this.drawn = [...this.drawn, winner.badge_uuid];
                    this.phase = 'reveal';
                    this.isRolling = false;
                    this.launchConfetti();
                },

                launchConfetti() {
                    const container = this.$refs.confetti;
                    if (!container) return;

                    const colors = ['#f97316', '#fb923c', '#fbbf24', '#fde047', '#f59e0b', '#ffffff'];
                    const pieces = 90;

                    for (let i = 0; i < pieces; i++) {
                        const el = document.createElement('span');
                        const size = 6 + Math.random() * 8;
                        const left = 40 + Math.random() * 20;
                        const dx = (Math.random() - 0.5) * 600;
                        const dy = -200 - Math.random() * 250;
                        const rot = (Math.random() - 0.5) * 720;
                        const duration = 1400 + Math.random() * 1100;
                        const delay = Math.random() * 250;

                        el.style.cssText = `
                            position:absolute;
                            top:50%; left:${left}%;
                            width:${size}px; height:${size * 0.4}px;
                            background:${colors[i % colors.length]};
                            transform:translate(-50%,-50%);
                            border-radius:2px;
                            opacity:0;
                            pointer-events:none;
                            will-change:transform,opacity;
                        `;

                        container.appendChild(el);

                        requestAnimationFrame(() => {
                            el.animate(
                                [
                                    { transform: 'translate(-50%, -50%) rotate(0deg)', opacity: 1 },
                                    { transform: `translate(calc(-50% + ${dx}px), calc(-50% + ${dy}px)) rotate(${rot / 2}deg)`, opacity: 1, offset: 0.3 },
                                    { transform: `translate(calc(-50% + ${dx * 1.4}px), calc(-50% + 380px)) rotate(${rot}deg)`, opacity: 0 },
                                ],
                                {
                                    duration,
                                    delay,
                                    easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
                                    fill: 'forwards',
                                }
                            );
                            setTimeout(() => el.remove(), duration + delay + 100);
                        });
                    }
                },

                reset() {
                    if (this.isRolling) return;

                    const drawnCount = this.drawn.length;
                    const message = drawnCount === 0
                        ? 'Clear the current winner and return to the start?'
                        : `Reset the drawing?\n\nThis will clear ${drawnCount} previously drawn winner${drawnCount === 1 ? '' : 's'} and put ${drawnCount === 1 ? 'them' : 'them all'} back into the pool. They will be eligible to be drawn again.\n\nThis cannot be undone.`;

                    if (!window.confirm(message)) return;

                    this.drawn = [];
                    this.winner = null;
                    this.rollDisplay = '';
                    this.countdown = '';
                    this.phase = 'idle';
                },
            };
        }
    </script>
</div>
