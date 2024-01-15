@csrf

<div class="field">
    <label class="label" for="">Title</label>

    <div class="control">
        <input
            type="text"
            class="input"
            name="title"
            placeholder="Title"
            value="{{ $project->title }}"
            required
        />
    </div>
</div>

<div class="field">
    <label class="label" for="">Description</label>

    <div class="control">
        <textarea
            class="textarea"
            name="description"
            placeholder="Description"
            required
        >{{ $project->description }}</textarea>
    </div>
</div>

<div class="field">
    <div class="control">
        <button type="submit" class="button is-link bg-cyan-400">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}" class="text-cyan-400">Cancel</a>
    </div>
</div>

@if ($errors->any())
    <div class="field mt-6">
        @foreach ($errors->all() as $error)
            <li class="text-sm text-red-50">{{ $error }}</li>
        @endforeach
    </div>
@endif
