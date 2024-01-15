<x-app-layout>
    <div class="lg:w-1/2 lg:mx-auto bg-white dark:bg-gray-800 md:py-12 md:px-16 rounded shadow">
        <h1 class="text-2xl">Let's start something new</h1>

        <form
            method="POST"
            action="/projects"
            class="container"
        >
            @include('projects.form', [
                'project' => new App\models\Project,
                'buttonText' => 'Create project',
            ])
        </form>
    </div>
</x-app-layout>
