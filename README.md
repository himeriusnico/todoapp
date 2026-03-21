# Tasko ✅

[cite_start]**A minimal, full-stack Todo application built as a portfolio project to demonstrate proficiency in Laravel 12 and Livewire 4[cite: 5, 6].**

[cite_start]Tasko allows multiple users to register, log in, and manage personal todo lists with real-time reactivity—all without writing a single line of custom JavaScript for the core features[cite: 6]. [cite_start]It serves as a practical implementation of **Livewire 4 Single File Components (SFC)** and **Tailwind CSS v4**[cite: 4, 8, 11].

[cite_start][**✨ Explore the Live Demo**](https://porto-dyce.site) 

---

## 🛠️ Tech Stack

| Layer | Technology | Version |
| :--- | :--- | :--- |
| **Backend Framework** | [cite_start]Laravel [cite: 14] | [cite_start]12 [cite: 14] |
| **Reactivity Layer** | [cite_start]Livewire [cite: 14] | [cite_start]4 [cite: 14] |
| **CSS Framework** | [cite_start]Tailwind CSS [cite: 14] | [cite_start]4 [cite: 14] |
| **Database** | [cite_start]MySQL [cite: 14] | [cite_start]8+ [cite: 14] |
| **Build Tool** | [cite_start]Vite [cite: 14] | [cite_start]6 [cite: 14] |
| **Hosting** | [cite_start]Hostinger [cite: 14] | [cite_start]Shared [cite: 14] |

---

## ✨ Features

### 📝 Reactive Todo CRUD
* [cite_start]**Scoped Creation**: Tasks are created via `Auth::user()->todos()->create()` to ensure they are scoped strictly to the logged-in user[cite: 109].
* [cite_start]**Real-time Toggle**: Tasks can be marked as complete or reopened with instant UI updates and contextual toast notifications[cite: 118, 120].
* [cite_start]**Inline Editing**: Double-clicking a task title triggers an edit mode powered by Alpine.js and Livewire for seamless title updates[cite: 134, 135].
* [cite_start]**Safety Deletion**: Uses `wire:confirm` to show a safety confirmation dialog before permanently removing a task[cite: 122].

### 📅 Smart Filters & Due Dates
* [cite_start]**Dynamic Filtering**: Filter tasks by "All", "Active", or "Completed" using reactive `$filter` properties[cite: 126].
* [cite_start]**Urgency Indicators**: Tasks feature color-coded dates: **Amber** for today, **Red** for overdue, and **Gray** for future tasks[cite: 142].

### 🔐 Custom Authentication
* [cite_start]**Hand-rolled System**: Built without starter kits like Breeze or Jetstream to demonstrate core Laravel auth proficiency[cite: 53].
* [cite_start]**SPA Navigation**: Uses `wire:navigate` for fast, SPA-style navigation between auth pages without full browser reloads[cite: 104].

### 🔔 Interactive UI
* [cite_start]**Luxury Productivity Aesthetic**: Features a clean design with Dark Navy (#0f0f14) and warm Cream (#f7f6f3) color palettes[cite: 153, 158].
* [cite_start]**Toast Notifications**: Real-time feedback via an Alpine.js-managed toast system for all mutations (Success, Warning, Error)[cite: 130, 131, 132].

---

## 📂 Project Structure

[cite_start]The project follows Livewire 4 conventions, utilizing the `⚡` emoji prefix to make Single File Components instantly identifiable in your editor[cite: 16, 40].

```text
tasko/
├── app/
│   ├── Http/Controllers/AuthController.php  ← Handles logout [cite: 20]
│   └── Models/ (User & Todo)                ← User hasMany Todos [cite: 22, 23]
├── resources/views/
│   ├── layouts/ (app & guest)               ← Namespace: layouts:: [cite: 149]
│   └── pages/                               ← Namespace: pages:: [cite: 148]
│       ├── auth/ (⚡login, ⚡register)       ← Livewire 4 SFCs [cite: 34, 35]
│       └── todos/ (⚡todo-manager)           ← Core app logic [cite: 37]
└── routes/web.php                           ← Uses Route::livewire() [cite: 39, 104]
