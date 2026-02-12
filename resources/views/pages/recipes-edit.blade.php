@auth
    <x-layouts::app title="Edit Recipe">
        <livewire:recipes.edit :recipe="$recipe" />
    </x-layouts::app>
@else
    @php
        redirect()->route('login');
    @endphp
@endauth
