<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tasko' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .brand {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="min-h-screen bg-[#f7f6f3]">

    {{-- Navbar --}}
    <nav class="bg-[#0f0f14] px-6 py-4">
        <div class="max-w-2xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-indigo-500 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="brand text-white text-xl">Tasko</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-400 text-sm hidden sm:block truncate max-w-32">{{ auth()->user()->name }}</span>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="text-xs text-gray-500 hover:text-red-400 transition-colors duration-200 border border-gray-700 hover:border-red-400/50 px-3 py-1.5 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <main class="max-w-2xl mx-auto px-4 py-10">
        {{ $slot }}
    </main>
    {{-- Toast Notification --}}
    <div x-data="{
        toasts: [],
        add(message, type = 'success') {
            const id = Date.now();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.remove(id), 3000);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }" x-on:toast.window="add($event.detail.message, $event.detail.type)"
        class="fixed bottom-4 left-4 right-4 sm:left-auto sm:right-6 sm:bottom-6 z-50 space-y-2" <template
        x-for="toast in toasts" :key="toast.id">
        <div x-show="true" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border text-sm font-medium w-[90vw] sm:min-w-64 sm:w-auto"
            :class="{
                'bg-white border-gray-100 text-gray-700': toast.type === 'success',
                'bg-red-50 border-red-200 text-red-600': toast.type === 'error',
                'bg-amber-50 border-amber-200 text-amber-600': toast.type === 'warning'
            }">
            {{-- Icon --}}
            <span x-show="toast.type === 'success'" class="text-indigo-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </span>
            <span x-show="toast.type === 'error'" class="text-red-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            <span x-show="toast.type === 'warning'" class="text-amber-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M12 3a9 9 0 100 18A9 9 0 0012 3z" />
                </svg>
            </span>

            {{-- Message --}}
            <span x-text="toast.message"></span>

            {{-- Close --}}
            <button @click="remove(toast.id)" class="ml-auto text-gray-300 hover:text-gray-500 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        </template>
    </div>
    @livewireScripts
</body>

</html>