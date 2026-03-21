# Tasko ✅

A minimal full-stack Todo application built with **Laravel 12** and **Livewire 4** — designed as a portfolio project to demonstrate modern Laravel development without relying on starter kits.

🌐 Live Demo: http://porto-dyce.site

---

## 🚀 Overview

Tasko is a multi-user todo management application where users can:

- Register & log in
- Create, update, and delete todos
- Toggle completion status
- Filter tasks (all / active / completed)
- Manage due dates with visual indicators

Built with a focus on **real-time interactivity** using Livewire — without writing custom JavaScript for core features.

---

## 🎯 Goals

- Learn Livewire 4 Single File Components (SFC)
- Build authentication without Breeze/Jetstream
- Implement real-time CRUD operations
- Create a clean UI using Tailwind CSS
- Deploy to shared hosting (Hostinger)

---

## 🧱 Tech Stack

| Layer        | Technology        |
|-------------|------------------|
| Backend     | Laravel 12       |
| Frontend    | Livewire 4       |
| Styling     | Tailwind CSS v4  |
| Database    | MySQL            |
| Build Tool  | Vite             |
| Hosting     | Hostinger        |

---

## 📂 Project Structure
tasko/
├── app/
│ ├── Http/Controllers/
│ └── Models/
├── database/migrations/
├── resources/views/
│ ├── layouts/
│ └── pages/
│ ├── auth/
│ └── todos/
└── routes/web.php


> ⚡ Livewire 4 uses Single File Components (SFC), combining PHP + Blade in one file.

---

## 🔐 Authentication

Custom-built authentication system (no starter kits):

- Register: validation + auto login
- Login: credential verification via `Auth::attempt()`
- Logout: session invalidation + CSRF protection

Route protection:
- `guest` → login & register pages
- `auth` → main todo app

---

## ✅ Features

### 📝 Todo Management
- Add new todos
- Edit inline (double-click)
- Delete with confirmation
- Toggle completion

### 🔍 Filters
- All
- Active
- Completed

### ⏰ Due Dates
- Optional deadline per task
- Visual indicators:
  - Future → Gray
  - Today → Amber
  - Overdue → Red

### 🔔 Toast Notifications
- Success / Warning / Error states
- Auto-dismiss after 3 seconds
- Powered by Alpine.js + Livewire events

---

## ⚡ Livewire 4 Highlights

- Single File Components (SFC)
- `#[Computed]` properties for optimized queries
- `wire:` directives for real-time interaction
- SPA-like navigation using `wire:navigate`
- Built-in Alpine.js integration

---

## 🎨 UI & Design

- Clean productivity-focused design
- Typography:
  - Playfair Display (headings)
  - DM Sans (body)
- Built entirely with **Tailwind CSS v4**
