<x-app-layout>
    <x-slot name="header">
        <h2>All Classes</h2>
    </x-slot>

    <a href="{{ route('classes.create') }}" class="btn btn-success mb-3">Add Class</a>

    <table class="table">
        @foreach($classes as $c)
            <tr>
                <td>{{ $c->name }}</td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
