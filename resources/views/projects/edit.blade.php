<x-app-layout>
    <div class="lg:w-1/2 lg:mx-auto bg-white dark:bg-gray-800 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl">Edit your project</h1>

        <form method="POST" action="{{ $project->path() }}" class="container">
            @method('PATCH')
            @include('projects.form', ['buttonText' => 'Create project'])
        </form>
    </div>
</x-app-layout>
