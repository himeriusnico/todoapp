<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts::app')] class extends Component {
    public string $title = '';
    public string $filter = 'all';
    public ?int $editingId = null;
    public string $editingTitle = '';
    public string $editingDueDate = '';
    public string $dueDate = '';

    public function addTodo(): void
    {
        $this->validate([
            'title' => 'required|min:2|max:255',
            'dueDate' => 'nullable|date|after_or_equal:today',
        ]);

        Auth::user()->todos()->create([
            'title' => trim($this->title),
            'is_completed' => false,
            'due_date' => $this->dueDate ?: null,
        ]);

        $this->title = '';
        $this->dueDate = '';
        $this->dispatch('toast', message: 'Task added!', type: 'success');
    }

    public function toggleTodo(int $id): void
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->update(['is_completed' => !$todo->is_completed]);

        $this->dispatch(
            'toast',
            message: $todo->is_completed ? 'Task completed! 🎉' : 'Task reopened.',
            type: $todo->is_completed ? 'success' : 'warning'
        );
    }

    public function deleteTodo(int $id): void
    {
        Auth::user()->todos()->findOrFail($id)->delete();
        $this->dispatch('toast', message: 'Task deleted.', type: 'error');
    }

    public function clearCompleted(): void
    {
        Auth::user()->todos()->where('is_completed', true)->delete();
        $this->dispatch('toast', message: 'Cleared all completed tasks.', type: 'warning');
    }
    #[Computed]
    public function todos()
    {
        return Auth::user()->todos()
            ->when($this->filter === 'active', fn($q) => $q->where('is_completed', false))
            ->when($this->filter === 'completed', fn($q) => $q->where('is_completed', true))
            ->latest()
            ->get();
    }

    #[Computed]
    public function totalCount(): int
    {
        return Auth::user()->todos()->count();
    }

    #[Computed]
    public function activeCount(): int
    {
        return Auth::user()->todos()->where('is_completed', false)->count();
    }

    #[Computed]
    public function completedCount(): int
    {
        return Auth::user()->todos()->where('is_completed', true)->count();
    }

    public function startEditing(int $id): void
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $this->editingId = $id;
        $this->editingTitle = $todo->title;
        $this->editingDueDate = $todo->due_date?->format('Y-m-d') ?? '';
    }

    public function saveEdit(): void
    {
        $this->validate([
            'editingTitle' => 'required|min:2|max:255',
            'editingDueDate' => 'nullable|date',
        ]);

        Auth::user()->todos()->findOrFail($this->editingId)->update([
            'title' => trim($this->editingTitle),
            'due_date' => $this->editingDueDate ?: null,
        ]);

        $this->editingId = null;
        $this->editingTitle = '';
        $this->editingDueDate = '';
        $this->dispatch('toast', message: 'Task updated!', type: 'success');
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->editingTitle = '';
    }
};
?>

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end gap-3 sm:gap-0 justify-between">
        <div>
            <h1 class="brand text-3xl text-[#0f0f14]">My Tasks</h1>
            <p class="text-gray-400 text-sm mt-1">
                <span class="text-indigo-500 font-semibold">{{ $this->activeCount }}</span> remaining ·
                {{ $this->totalCount }} total
            </p>
        </div>
        @if($this->completedCount > 0)
            <button wire:click="clearCompleted" wire:confirm="Clear all completed tasks?"
                class="flex items-center gap-1.5 text-xs font-medium text-red-400 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1.5 rounded-lg transition-all duration-200 mb-1">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Clear completed ({{ $this->completedCount }})
            </button>
        @endif
    </div>

    {{-- Add Todo Form --}}
    <form wire:submit="addTodo" class="space-y-2">
        <div class="flex flex-col sm:flex-row gap-2">
            <input wire:model="title" type="text" placeholder="What needs to be done?"
                class="flex-1 px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-400 text-sm transition-all duration-200 shadow-sm" />
            <div class="flex gap-2">
                <input wire:model="dueDate" type="date"
                    class="flex-1 sm:flex-none px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-400 text-sm transition-all duration-200 shadow-sm text-gray-500" />
                <button type="submit"
                    class="bg-[#0f0f14] hover:bg-indigo-600 text-white px-5 py-3 rounded-xl text-sm font-medium transition-all duration-200 shadow-sm whitespace-nowrap data-loading:opacity-60">
                    <span wire:loading.remove wire:target="addTodo">+ Add</span>
                    <span wire:loading wire:target="addTodo">...</span>
                </button>
            </div>
        </div>
        @error('dueDate')
            <p class="text-red-400 text-xs px-1">{{ $message }}</p>
        @enderror
    </form>

    {{-- Filter Tabs --}}
    <div class="flex gap-1.5 bg-white rounded-xl p-1 shadow-sm border border-gray-100 w-fit">
        @foreach(['all' => 'All', 'active' => 'Active', 'completed' => 'Done'] as $value => $label)
            <button wire:click="$set('filter', '{{ $value }}')" class="px-4 py-1.5 rounded-lg text-sm font-medium transition-all duration-200
                                                                                                                            {{ $filter === $value
            ? 'bg-[#0f0f14] text-white shadow-sm'
            : 'text-gray-400 hover:text-gray-600' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Todo List --}}
    <div class="space-y-2">

        @if($this->todos->isEmpty())
            <div class="text-center py-16">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    @if($filter === 'completed')
                        <span class="text-2xl">💪</span>
                    @elseif($filter === 'active')
                        <span class="text-2xl">🎉</span>
                    @else
                        <span class="text-2xl">✨</span>
                    @endif
                </div>
                <p class="text-gray-400 text-sm font-medium">
                    @if($filter === 'completed') No completed tasks yet
                    @elseif($filter === 'active') You're all caught up!
                    @else Add your first task above
                    @endif
                </p>
            </div>

        @else
            @foreach($this->todos as $todo)
                <div wire:key="{{ $todo->id }}" class="flex items-center gap-3 bg-white border rounded-xl px-4 py-3.5 group shadow-sm hover:shadow-md transition-all duration-200
                                                                                                {{ $todo->due_date && !$todo->is_completed && $todo->due_date->isPast()
                    ? 'border-red-200 hover:border-red-300'
                    : 'border-gray-100 hover:border-gray-200' }}">
                    {{-- Toggle button --}}
                    <button wire:click="toggleTodo({{ $todo->id }})" class="w-5 h-5 rounded-full border-2 flex-shrink-0 flex items-center justify-center transition-all duration-200
                                                                                                    {{ $todo->is_completed
                    ? 'bg-indigo-500 border-indigo-500'
                    : 'border-gray-300 hover:border-indigo-400' }}">
                        @if($todo->is_completed)
                            <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        @endif
                    </button>

                    {{-- Title + Due date --}}
                    <div class="flex-1 min-w-0">
                        @if($editingId === $todo->id)
                            {{-- <input wire:model="editingTitle" wire:keydown.enter="saveEdit" wire:keydown.escape="cancelEdit"
                                wire:blur="saveEdit" type="text"
                                class="w-full text-sm px-2 py-1 rounded-lg border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/30 text-gray-700 transition-all duration-200"
                                x-init="$el.focus(); $el.select()" />
                            <input wire:model="editingDueDate" type="date"
                                class="mt-1 text-xs px-2 py-1 rounded-lg border border-indigo-200 focus:outline-none focus:ring-1 focus:ring-indigo-300 text-gray-500 transition-all duration-200" />
                            --}}
                            <div x-data="{ focused: false }" @focusin="focused = true"
                                @focusout="focused = false; setTimeout(() => { if (!focused) $wire.saveEdit() }, 150)">
                                <input wire:model="editingTitle" wire:keydown.enter="saveEdit" wire:keydown.escape="cancelEdit"
                                    type="text"
                                    class="w-full text-sm px-2 py-1 rounded-lg border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400/30 text-gray-700 transition-all duration-200"
                                    x-init="$el.focus(); $el.select()" />
                                <input wire:model="editingDueDate" type="date"
                                    class="mt-1 text-xs px-2 py-1 rounded-lg border border-indigo-200 focus:outline-none focus:ring-1 focus:ring-indigo-300 text-gray-500 transition-all duration-200" />
                            </div>
                        @else
                            <span wire:dblclick="startEditing({{ $todo->id }})"
                                class="block text-sm transition-all duration-200 cursor-pointer select-none truncate
                                                                                                                                                        {{ $todo->is_completed ? 'line-through text-gray-300' : 'text-gray-700' }}"
                                title="Double click to edit">
                                {{ $todo->title }}
                            </span>
                            @if($todo->due_date)
                                <span class="text-xs mt-0.5 flex items-center gap-1
                                                                                                                                                                                                    {{ $todo->is_completed ? 'text-gray-300' :
                                    ($todo->due_date->isPast() ? 'text-red-400' :
                                        ($todo->due_date->isToday() ? 'text-amber-400' : 'text-gray-400')) }}">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $todo->due_date->isToday() ? 'Due today' :
                                    ($todo->due_date->isPast() ? 'Overdue · ' . $todo->due_date->format('M j') :
                                        'Due ' . $todo->due_date->format('M j')) }}
                                </span>
                            @endif
                        @endif
                    </div>

                    {{-- Date added (on hover) --}}
                    {{-- Date added --}}
                    <span
                        class="text-xs text-gray-300 hidden sm:block sm:opacity-0 sm:group-hover:opacity-100 transition-opacity flex-shrink-0">
                        {{ $todo->created_at->diffForHumans() }}
                    </span>

                    {{-- Delete --}}
                    <button wire:click="deleteTodo({{ $todo->id }})" wire:confirm="Delete this task?"
                        class="opacity-100 sm:opacity-0 sm:group-hover:opacity-100 text-gray-200 hover:text-red-400 active:text-red-400 transition-all duration-200 ml-1 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach
        @endif

    </div>

</div>