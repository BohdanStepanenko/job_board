<div class="card text-white bg-dark mb-3">
    <div class="card-header text-right">
        Posted: {{ date_format($vacancy->created_at,"d-m-Y") }} by
        <a href="{{ route ('user', $vacancy->user_id) }}"><ins>{{ $vacancy->user->name }}</ins></a>
    </div>

    <div class="card-body">
        <h5 class="card-title">{{ $vacancy->title }}</h5>
        <p class="card-text">{{ $vacancy->description }}</p>
        <p class="card-text text-bg-success">Responses: {{ $vacancy->responses->count() }}</p>
        <a href="{{ route ('vacancy', $vacancy->id) }}" class="btn btn-primary">Show vacancy</a>
    </div>
</div>
