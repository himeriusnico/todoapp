<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts::guest')] class extends Component {
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'These credentials do not match our records.');
            return;
        }

        session()->regenerate();
        return $this->redirect('/', navigate: true);
    }
};
?>

<div class="w-full bg-[#1a1a24] rounded-2xl border border-white/5 p-8 shadow-2xl">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="brand text-white text-3xl mb-1">Tasko</h1>
        <p class="text-gray-400 text-sm">Welcome back. Let's get things done.</p>
    </div>

    {{-- Form --}}
    <form wire:submit="login" class="space-y-4">

        <div>
            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Email</label>
            <input wire:model="email" type="email" placeholder="you@example.com"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 focus:bg-white/8 text-sm transition-all duration-200" />
            @error('email')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Password</label>
            <input wire:model="password" type="password" placeholder="••••••••"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 text-sm transition-all duration-200" />
            @error('password')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2 pt-1">
            <input wire:model="remember" type="checkbox" id="remember"
                class="rounded border-gray-600 bg-white/5 text-indigo-500">
            <label for="remember" class="text-sm text-gray-400">Remember me</label>
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-3 rounded-xl transition-all duration-200 text-sm mt-2 data-loading:opacity-60 data-loading:cursor-not-allowed">
            <span wire:loading.remove>Log in</span>
            <span wire:loading>Logging in...</span>
        </button>

    </form>

    <div class="mt-6 pt-6 border-t border-white/5 text-center">
        <p class="text-gray-500 text-sm">
            No account?
            <a href="/register" wire:navigate
                class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Sign up free</a>
        </p>
    </div>

</div>