<x-app-layout>
    <header class="flex justify-between items-end mb-4 px-4">
        <h2 class="text-2xl text-grey font-normal">My projects</h2>
        <a href="/projects/create" class="button">New project</a>
    </header>

    <main class="flex gap-4 px-4 flex-col md:flex-row">
        @forelse ($projects as $project)
            <div class="bg-white dark:bg-gray-800 py-5 rounded shadow basis-full md:basis-1/2 lg:basis-1/3 h-52">
                <header class="px-5 border-l-4 border-cyan-400">
                    <h3 class="font-normal text-xl mb-6">
                        <a href="{{ $project->path() }}">{{ $project->title }}</a>
                    </h3>
                </header>
                <article class="px-5">
                    <p class="text-black/40 dark:text-gray-100">
                        {{ Illuminate\Support\Str::limit($project->description, 100) }}
                    </p>
                </article>
            </div>
        @empty
            <div>No projects yet</div>
        @endforelse
    </main>
</x-app-layout>
