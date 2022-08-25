<form method="post" action="{{ route('update-vacancy') }}">
    @method('put')
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Vacancy title" value="{{ $vacancy->title }}">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ $vacancy->description }}</textarea>
    </div>
    <input type="hidden" name="vacancy_id" value="{{ $vacancy->id }}">
    <input class="btn btn-primary" type="submit" value="Update">
</form>
