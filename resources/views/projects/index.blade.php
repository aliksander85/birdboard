<x-app-layout>
    <div class="flex justify-between">
        <h1>Birdboard</h1>
        <a href="/projects/create">New project</a>
    </div>

    <ul>
        @forelse ($projects as $project)
            <li>
                <a href="{{ $project->path() }}">
                    {{ $project->title }}
                </a>
            </li>
        @empty
            <li>No projects yet</li>
        @endforelse
    </ul>
</x-app-layout>
