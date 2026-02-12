@auth
    <x-layouts::app title="Create Recipe">
        <livewire:recipes.create />
    </x-layouts::app>
@else
    @php
        redirect()->route('login');
    @endphp
@endauth
