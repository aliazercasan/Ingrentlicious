@auth
    <livewire:recipes.edit :recipe="$recipe" />
@else
    @php
        redirect()->route('login');
    @endphp
@endauth
