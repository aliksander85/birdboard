<x-app-layout>
    <form method="POST" action="/projects" class="container" style="padding-top: 40px">
        @csrf

        <h1 class="text-2xl">Create a project</h1>

        <div class="field">
            <label class="label" for="">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" />
            </div>
        </div>

        <div class="field">
            <label class="label" for="">Description</label>

            <div class="control">
                <textarea class="textarea" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link bg-cyan-400">Create Project</button>
                <a href="/projects" class="text-cyan-400">Cancel</a>
            </div>
        </div>
    </form>
</x-app-layout>
