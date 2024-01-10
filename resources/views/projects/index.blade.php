<x-app-layout>
    <header class="flex justify-between items-end mb-4 px-4">
        <h2 class="text-2xl text-grey font-normal">My projects</h2>
        <a href="/projects/create" class="button">New project</a>
    </header>

    <main class="flex gap-4 px-4 flex-col md:flex-row">
        @forelse ($projects as $project)
            @include('projects.card')
        @empty
            <div>No projects yet</div>
        @endforelse
    </main>
</x-app-layout>
