<x-app-layout>
    <header class="flex justify-between items-end mb-4 px-4">
        <p class="text-2xl text-grey font-normal">
            <a href="/projects">My projects</a> / {{ $project->title }}
        </p>
        <a href="/projects/create" class="button">New project</a>
    </header>

    <main class="flex -mx-3 px-4 md:flex-row flex-col-reverse">
        <div class="md:w-1/2 lg:w-2/3 xl:w-3/4 px-3">
            <section class="mb-6">
                <h2 class="text-large text-grey font-normal mb-3">Tasks</h2>
                <div class="flex flex-col gap-2">
                    @forelse ($project->tasks as $task)
                        <div class="card">{{ $task->body }}</div>
                    @empty
                        There is no tasks yet.
                    @endforelse

                </div>
            </section>

            <section>
                <h2 class="text-large text-grey font-normal mb-3">General Notes</h2>
                <textarea class="card w-full">Lorem ipsum.</textarea>
            </section>
        </div>

        <div class="md:w-1/2 lg:w-1/3 xl:w-1/4 px-3 mb-6">
            @include('projects.card')
        </div>
    </main>


</x-app-layout>
