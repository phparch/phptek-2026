<?php

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component
{
    #[Validate('required|string')]
    public string $password = '';

    public bool $hasError = false;

    public function unlock(): void
    {
        $this->hasError = false;
        $this->validate();

        $key = 'giveaway-unlock:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->hasError = true;

            throw ValidationException::withMessages([
                'password' => "Too many attempts. Try again in {$seconds} seconds.",
            ]);
        }

        $expected = config('tek.giveaway.password');

        if (empty($expected) || ! hash_equals((string) $expected, $this->password)) {
            RateLimiter::hit($key, 60);
            $this->hasError = true;
            $this->password = '';

            throw ValidationException::withMessages([
                'password' => 'Nope. Try again.',
            ]);
        }

        RateLimiter::clear($key);
        session()->put('giveaway_authed', true);
        session()->save();

        $this->redirect('/giveaway', navigate: false);
    }
}; ?>

<div
    x-data="{ shake: @entangle('hasError') }"
    class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-10"
>
    <div class="pointer-events-none absolute inset-0 -z-10 opacity-60">
        <div class="absolute -top-32 -left-32 h-96 w-96 rounded-full bg-fuchsia-500/40 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-96 w-96 rounded-full bg-cyan-500/40 blur-3xl"></div>
        <div class="absolute top-1/3 left-1/2 h-96 w-96 -translate-x-1/2 rounded-full bg-indigo-500/30 blur-3xl"></div>
    </div>

    <div
        class="w-full max-w-md"
        :class="shake ? 'animate-[shake_0.45s_cubic-bezier(.36,.07,.19,.97)_both]' : ''"
        @animationend="shake = false"
    >
        <div class="rounded-3xl border border-white/10 bg-black/40 p-10 shadow-2xl backdrop-blur">
            <div class="text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-fuchsia-500 to-cyan-500 text-4xl shadow-lg shadow-fuchsia-500/30">
                    &#x1F511;
                </div>
                <p class="mt-6 text-xs font-semibold uppercase tracking-[0.4em] text-indigo-300">PHP Tek 2026</p>
                <h1 class="mt-1 bg-gradient-to-r from-fuchsia-300 via-white to-cyan-300 bg-clip-text text-4xl font-black text-transparent">
                    Unlock the Drawing
                </h1>
                <p class="mt-2 text-sm text-indigo-200/80">Enter the secret phrase to proceed.</p>
            </div>

            <form wire:submit="unlock" class="mt-8 space-y-4">
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input
                        id="password"
                        wire:model="password"
                        type="password"
                        autocomplete="off"
                        autofocus
                        placeholder="&bull; &bull; &bull; &bull; &bull; &bull;"
                        class="w-full rounded-2xl border border-white/15 bg-white/5 px-5 py-4 text-center text-2xl tracking-[0.4em] text-white placeholder:text-white/30 focus:border-fuchsia-400 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-400/40"
                        @class([
                            'border-rose-400/70 focus:border-rose-400 focus:ring-rose-400/40' => $hasError,
                        ])
                    />
                    @error('password')
                        <p class="mt-3 text-center text-sm text-rose-300" wire:transition>{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-fuchsia-500 to-cyan-500 px-8 py-4 text-lg font-black uppercase tracking-widest text-white shadow-2xl shadow-fuchsia-500/40 transition hover:scale-[1.02] hover:shadow-fuchsia-500/60 disabled:cursor-not-allowed disabled:opacity-60 disabled:hover:scale-100"
                >
                    <span wire:loading.remove>&#x1F513;&nbsp;Unlock</span>
                    <span wire:loading>Checking&hellip;</span>
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-xs uppercase tracking-[0.3em] text-indigo-300/60">
            Authorized hosts only
        </p>
    </div>

    <style>
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-6px, 0, 0); }
            40%, 60% { transform: translate3d(6px, 0, 0); }
        }
    </style>
</div>
