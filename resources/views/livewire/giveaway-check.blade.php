<?php

use App\Services\GiveawayEligibility;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    /** @var array<string, mixed>|null */
    public ?array $status = null;

    public function check(GiveawayEligibility $eligibility): void
    {
        $this->validate();

        $this->status = $eligibility->statusForEmail(trim(strtolower($this->email)));
    }

    public function reset_(): void
    {
        $this->email = '';
        $this->status = null;
        $this->resetErrorBag();
    }
}; ?>

<div class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-10">
    <div class="pointer-events-none absolute inset-0 -z-10 opacity-60">
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-orange-500/40 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-amber-500/40 blur-3xl"></div>
        <div class="absolute top-1/3 left-1/2 h-96 w-96 -translate-x-1/2 rounded-full bg-orange-600/30 blur-3xl"></div>
    </div>

    <div class="w-full max-w-xl">
        <div class="rounded-3xl border border-white/10 bg-black/40 p-8 shadow-2xl backdrop-blur sm:p-10">
            <div class="text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-orange-300">PHP Tek 2026</p>
                <h1 class="mt-1 bg-gradient-to-r from-orange-300 via-amber-200 to-orange-400 bg-clip-text text-4xl font-black text-transparent sm:text-5xl">
                    Am I Eligible?
                </h1>
                <p class="mt-3 text-sm text-orange-200/80">
                    Enter the email from your conference badge to see your giveaway progress.
                </p>
            </div>

            @if (! $status)
                <form wire:submit="check" class="mt-8 space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input
                            id="email"
                            wire:model="email"
                            type="email"
                            autocomplete="email"
                            inputmode="email"
                            autofocus
                            placeholder="you@example.com"
                            class="w-full rounded-2xl border border-white/15 bg-white/5 px-5 py-4 text-center text-lg text-white placeholder:text-white/30 focus:border-orange-400 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-orange-400/40"
                        />
                        @error('email')
                            <p class="mt-3 text-center text-sm text-rose-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full rounded-2xl bg-gradient-to-r from-orange-500 to-amber-400 px-8 py-4 text-lg font-black uppercase tracking-widest text-white shadow-2xl shadow-orange-500/40 transition hover:scale-[1.02] disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:scale-100"
                    >
                        <span wire:loading.remove>Check My Status</span>
                        <span wire:loading>Checking&hellip;</span>
                    </button>
                </form>
            @else
                <div class="mt-8 space-y-5">
                    @if ($status['qualified'])
                        <div class="rounded-2xl border border-amber-300/60 bg-gradient-to-br from-orange-500/20 to-amber-400/20 p-5 text-center shadow-lg shadow-orange-500/20">
                            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-amber-300">&#x1F389; Congratulations</p>
                            <p class="mt-2 bg-gradient-to-r from-orange-300 via-amber-200 to-orange-300 bg-clip-text text-2xl font-black text-transparent">
                                You're qualified for the giveaway!
                            </p>
                            <p class="mt-1 text-sm text-orange-200/80">Stick around for the drawing.</p>
                        </div>
                    @elseif ($status['required_count'] === 0)
                        <div class="rounded-2xl border border-amber-400/40 bg-amber-500/10 p-5 text-center">
                            <p class="text-amber-200">No giveaway is configured for the current conference yet.</p>
                        </div>
                    @else
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5 text-center">
                            <p class="text-xs font-semibold uppercase tracking-[0.4em] text-orange-300">Keep going!</p>
                            <p class="mt-2 text-2xl font-black text-white">
                                {{ $status['scanned_count'] }} of {{ $status['required_count'] }} vendors scanned
                            </p>
                            <p class="mt-1 text-sm text-orange-200/80">
                                Visit the remaining vendors at the conference and have them scan your badge.
                            </p>
                        </div>
                    @endif

                    @if (! empty($status['rows']))
                        <ul class="divide-y divide-white/10 overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                            @foreach ($status['rows'] as $row)
                                <li class="flex items-center justify-between gap-4 px-5 py-4">
                                    <span class="text-base font-medium text-white">{{ $row['name'] }}</span>
                                    @if ($row['scanned'])
                                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-emerald-500/20 text-xl font-bold text-emerald-300 ring-1 ring-emerald-400/50" aria-label="Scanned">&check;</span>
                                    @else
                                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-rose-500/15 text-xl font-bold text-rose-300 ring-1 ring-rose-400/50" aria-label="Not scanned">&times;</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <button
                        type="button"
                        wire:click="reset_"
                        class="w-full rounded-2xl border border-white/15 bg-white/5 px-6 py-3 text-sm font-semibold text-white/80 transition hover:bg-white/10"
                    >
                        Check another email
                    </button>
                </div>
            @endif
        </div>

        <p class="mt-6 text-center text-xs uppercase tracking-[0.3em] text-orange-300/60">
            Looking for the drawing? <a href="{{ route('giveaway') }}" class="text-orange-200 underline-offset-4 hover:underline">/giveaway</a>
        </p>
    </div>
</div>
