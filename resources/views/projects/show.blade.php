<x-app-layout>
    <h1 class="text-2xl">Project {{ $project->title }}</h1>

    <div>{{ $project->description }}</div>

    <a href="/projects" class="text-cyan-400">Go back</a>
</x-app-layout>
