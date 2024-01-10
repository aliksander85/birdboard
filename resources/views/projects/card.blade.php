<div class="card h-52">
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
