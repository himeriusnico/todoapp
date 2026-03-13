<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

new #[Layout('layouts::guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register()
    {
        $this->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user);
        session()->regenerate();
        return $this->redirect('/', navigate: true);
    }
};
?>

<div class="w-full bg-[#1a1a24] rounded-2xl border border-white/5 p-6 sm:p-8 shadow-2xl">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="brand text-white text-3xl mb-1">Tasko</h1>
        <p class="text-gray-400 text-sm">Create your account and start organizing.</p>
    </div>

    <form wire:submit="register" class="space-y-4">

        <div>
            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Name</label>
            <input wire:model="name" type="text" placeholder="John Doe"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 text-sm transition-all duration-200" />
            @error('name')
                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Email</label>
            <input wire:model="email" type="email" placeholder="you@example.com"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 text-sm transition-all duration-200" />
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

        <div>
            <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Confirm
                Password</label>
            <input wire:model="password_confirmation" type="password" placeholder="••••••••"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 text-sm transition-all duration-200" />
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-3 rounded-xl transition-all duration-200 text-sm mt-2 data-loading:opacity-60 data-loading:cursor-not-allowed">
            <span wire:loading.remove>Create Account</span>
            <span wire:loading>Creating account...</span>
        </button>

    </form>

    <div class="mt-6 pt-6 border-t border-white/5 text-center">
        <p class="text-gray-500 text-sm">
            Already have an account?
            <a href="/login" wire:navigate
                class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors">Log in</a>
        </p>
    </div>

</div>