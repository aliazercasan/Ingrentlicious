@auth
    <livewire:recipes.create />
@else
    @php
        redirect()->route('login');
    @endphp
@endauth
