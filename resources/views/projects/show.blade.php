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
                    @foreach ($project->tasks as $task)
                        <div class="card px-4">
                            <form
                                action="{{ $task->path() }}"
                                method="POST"
                            >
                                @method('PATCH')
                                @csrf

                                <div class="flex items-center gap-3">
                                    <input
                                        name="body"
                                        value="{{ $task->body }}"
                                        class="w-full bg-white dark:bg-gray-800 border-white dark:border-gray-800 {{ $task->completed ? 'text-gray-300' : '' }}"
                                    />
                                    <input
                                        name="completed"
                                        type="checkbox"
                                        class="bg-white dark:bg-gray-800"
                                        onChange="this.form.submit()"
                                        {{ $task->completed ? 'checked' : '' }}
                                    />
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card px-4">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input
                                name="body"
                                placeholder="Add a new tasks..."
                                class="w-full bg-white dark:bg-gray-800 border-white dark:border-gray-800"
                            />
                        </form>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-large text-grey font-normal mb-3">General Notes</h2>
                <form action="{{ $project->path() }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <textarea
                        name="notes"
                        class="card w-full mb-4"
                        placeholder="Anything special that you want to make a note of?"
                    >{{ $project->notes }}</textarea>

                    <button type="submit" class="button">Save</button>
                </form>
            </section>
        </div>

        <div class="md:w-1/2 lg:w-1/3 xl:w-1/4 px-3 mb-6">
            @include('projects.card')
        </div>
    </main>


</x-app-layout>
