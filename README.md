# [cite_start]Tasko ✅ [cite: 1]

[cite_start]**A minimal, luxury productivity Todo application built with Laravel 12 and Livewire 4.** [cite: 3, 6]

[cite_start]Tasko is a full-stack portfolio project designed to demonstrate proficiency in the latest PHP ecosystem features. [cite: 6] [cite_start]The application enables users to manage personal todo lists with real-time reactivity, achieving a modern SPA feel without writing custom JavaScript for core features. [cite: 6]

[cite_start][**✨ Live Demo**](https://porto-dyce.site) 

---

## [cite_start]🚀 Key Objectives [cite: 7]

* [cite_start]**Modern Architecture:** Apply Livewire 4 Single File Components (SFC) for streamlined development. [cite: 8]
* [cite_start]**Secure Auth:** Build a complete authentication system from scratch without using pre-made starter kits. [cite: 9, 53]
* [cite_start]**Reactive CRUD:** Implement real-time Create, Read, Update, and Delete operations using Livewire directives. [cite: 10]
* [cite_start]**Refined UI:** Create a responsive, polished interface using Tailwind CSS v4. [cite: 11]
* [cite_start]**Production Ready:** Successfully deploy to shared hosting (Hostinger) environments. [cite: 12, 168]

---

## [cite_start]🛠️ Tech Stack [cite: 13]

| Layer | Technology | Version |
| :--- | :--- | :--- |
| **Backend** | [cite_start]Laravel [cite: 14] | [cite_start]12 [cite: 14] |
| **Reactivity** | [cite_start]Livewire [cite: 14] | [cite_start]4 [cite: 14] |
| **Styling** | [cite_start]Tailwind CSS [cite: 14] | [cite_start]4 [cite: 14] |
| **Database** | [cite_start]MySQL [cite: 14] | [cite_start]10 [cite: 14] |
| **Build Tool** | [cite_start]Vite [cite: 14] | [cite_start]6 [cite: 14] |

---

## [cite_start]✨ Features [cite: 105]

### [cite_start]📝 Reactive Todo Management [cite: 106]
* [cite_start]**Scoped CRUD:** Tasks are strictly scoped to the authenticated user for security. [cite: 109, 113, 123]
* [cite_start]**Inline Editing:** Double-click a task title to enter edit mode instantly via Livewire and Alpine.js. [cite: 133, 134, 135]
* [cite_start]**Filtering:** Toggle between 'All', 'Active', and 'Completed' tasks using reactive properties. [cite: 125, 126, 128]
* [cite_start]**Due Dates:** Optional task deadlines with color-coded urgency indicators (Amber for today, Red for overdue). [cite: 140, 141, 142]

### [cite_start]🔐 Hand-Rolled Authentication [cite: 52]
* [cite_start]**Full Flow:** Includes Registration, Login (with 'Remember Me'), and secure Logout. [cite: 56, 63, 68]
* [cite_start]**Validation:** Real-time form validation using Laravel's engine inside Livewire components. [cite: 54, 58]
* [cite_start]**Security:** Manual session regeneration and CSRF protection management. [cite: 61, 71]

### [cite_start]🎨 Design & UI [cite: 151, 152]
* [cite_start]**Aesthetic:** "Luxury productivity" theme featuring Dark Navy and Cream palettes. [cite: 153, 158]
* [cite_start]**Typography:** Playfair Display for headers and DM Sans for body text. [cite: 156]
* [cite_start]**Feedback:** Dynamic toast notifications for every action, color-coded by type (Success, Warning, Error). [cite: 129, 131, 132]

---

## [cite_start]📂 Project Structure [cite: 15]

[cite_start]Tasko utilizes the Livewire 4 **Single File Component (SFC)** pattern, identified by the `⚡` emoji prefix. [cite: 16, 40]

```text
tasko/
├── app/
[cite_start]│   ├── Http/Controllers/Auth/ (Logout logic) [cite: 20]
[cite_start]│   └── Models/ (User & Todo relationships) [cite: 21, 22, 23]
├── resources/views/
[cite_start]│   ├── layouts/ (app & guest layouts) [cite: 29, 30, 31]
[cite_start]│   └── pages/ (Livewire 4 SFCs) [cite: 32]
[cite_start]│       ├── auth/ (⚡login, ⚡register) [cite: 33, 34, 35]
[cite_start]│       └── todos/ (⚡todo-manager) [cite: 36, 37]
[cite_start]└── routes/web.php (Route::livewire routing) [cite: 38, 39, 104]
