<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasko | Project Documentation</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        body { font-family: 'DM Sans', sans-serif; background-color: #f7f6f3; color: #0f0f14; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        .navy-bg { background-color: #0f0f14; }
        .accent-indigo { color: #4F46E5; }
        code { background-color: #e5e7eb; padding: 0.2rem 0.4rem; border-radius: 0.25rem; font-size: 0.9em; }
    </style>
</head>
<body class="antialiased">

    <header class="navy-bg text-white py-8 px-6 shadow-xl">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-4xl">Tasko ✅</h1>
                <p class="text-gray-400 mt-2">Laravel 12 + Livewire 4 Full-Stack Todo App [cite: 3]</p>
            </div>
            <a href="https://porto-dyce.site" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-lg font-medium transition">Live Demo</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto py-12 px-6 space-y-16">

        <section>
            <h2 class="text-3xl border-b border-gray-300 pb-2 mb-6 text-indigo-900">1. Project Overview</h2>
            <p class="leading-relaxed text-lg">
                Tasko is a minimal, full-stack application built to demonstrate proficiency in modern Laravel development[cite: 6]. 
                The primary goal was to implement real-time CRUD operations without writing custom JavaScript, utilizing Livewire 4's 
                new Single File Component (SFC) architecture[cite: 6, 8, 10].
            </p>
        </section>

        <section>
            <h2 class="text-3xl border-b border-gray-300 pb-2 mb-6 text-indigo-900">2. Tech Stack</h2>
            <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
                <table class="w-full text-left bg-white">
                    <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-600">
                        <tr>
                            <th class="px-6 py-4">Layer [cite: 14]</th>
                            <th class="px-6 py-4">Technology [cite: 14]</th>
                            <th class="px-6 py-4">Version [cite: 14]</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr><td class="px-6 py-4 font-medium">Backend</td><td class="px-6 py-4">Laravel</td><td class="px-6 py-4">12</td></tr>
                        <tr><td class="px-6 py-4 font-medium">Reactivity</td><td class="px-6 py-4">Livewire</td><td class="px-6 py-4">4 (SFC)</td></tr>
                        <tr><td class="px-6 py-4 font-medium">Styling</td><td class="px-6 py-4">Tailwind CSS</td><td class="px-6 py-4">4</td></tr>
                        <tr><td class="px-6 py-4 font-medium">Build Tool</td><td class="px-6 py-4">Vite</td><td class="px-6 py-4">6</td></tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-2xl mb-4 accent-indigo text-indigo-900">⚡ Core Features</h3>
                <ul class="space-y-3 text-gray-700">
                    <li>• <strong>Hand-rolled Auth:</strong> No starter kits (Breeze/Jetstream)[cite: 53].</li>
                    <li>• <strong>Inline Edit:</strong> Double-click titles to edit via Livewire + Alpine[cite: 133, 134].</li>
                    <li>• <strong>Smart Filters:</strong> View All, Active, or Completed tasks instantly[cite: 126].</li>
                    <li>• <strong>Due Dates:</strong> Color-coded urgency indicators (Today, Overdue, Future)[cite: 140, 142].</li>
                </ul>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-2xl mb-4 accent-indigo text-indigo-900">🎨 UI/UX Design</h3>
                <ul class="space-y-3 text-gray-700">
                    <li>• <strong>SPA Navigation:</strong> Uses <code>wire:navigate</code> for instant page loads[cite: 104].</li>
                    <li>• <strong>Toasts:</strong> Interactive Alpine.js notifications for all CRUD actions[cite: 129, 130].</li>
                    <li>• <strong>Glassmorphism:</strong> Tailwind v4 opacity and blur effects[cite: 162, 163].</li>
                </ul>
            </div>
        </section>

        <section>
            <h2 class="text-3xl border-b border-gray-300 pb-2 mb-6 text-indigo-900">3. Architecture (Livewire 4 SFC)</h2>
            <p class="mb-4">The project uses the <code>⚡</code> emoji prefix to identify Single File Components[cite: 40].</p>
            <pre class="bg-[#1a1a24] text-indigo-300 p-6 rounded-lg overflow-x-auto text-sm">
tasko/
├── app/Models/
│   ├── User.php [cite: 22]
│   └── Todo.php [cite: 23]
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php [cite: 30]
│   │   └── guest.blade.php [cite: 31]
│   └── pages/ 
│       ├── auth/
│       │   ├── ⚡login.blade.php [cite: 34]
│       │   └── ⚡register.blade.php [cite: 35]
│       └── todos/
│           └── ⚡todo-manager.blade.php [cite: 37]
            </pre>
        </section>

        <section class="bg-indigo-900 text-white p-10 rounded-3xl">
            <h2 class="text-3xl mb-6">Future Improvements (v2)</h2>
            <div class="grid sm:grid-cols-3 gap-6">
                <div class="border border-white/20 p-4 rounded-xl">
                    <p class="font-bold text-lg mb-1">Drag & Drop</p>
                    <p class="text-sm text-indigo-200">Using wire:sort [cite: 213]</p>
                </div>
                <div class="border border-white/20 p-4 rounded-xl">
                    <p class="font-bold text-lg mb-1">Search</p>
                    <p class="text-sm text-indigo-200">Real-time filtering [cite: 213]</p>
                </div>
                <div class="border border-white/20 p-4 rounded-xl">
                    <p class="font-bold text-lg mb-1">Alpine Rebuild</p>
                    <p class="text-sm text-indigo-200">Learning exercise [cite: 214]</p>
                </div>
            </div>
        </section>

    </main>

    <footer class="py-12 text-center text-gray-500 border-t border-gray-200">
        <p>&copy; 2026 Portfolio Project by Nico Isao Jowi</p>
        <p class="text-xs mt-2 uppercase tracking-widest">Built with Passion and PHP</p>
    </footer>

</body>
</html>
