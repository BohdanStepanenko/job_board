<div class="card">
    <div class="card-header">
        Vacancy posted by:
        <b>{{ $response->jobVacancy->user->name }}</b> {{ $response->jobVacancy->user->email }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $response->jobVacancy->title }}</h5>
        <p class="card-text">{{ $response->jobVacancy->description }}</p>
        <a href="{{ route('delete-response', $response->id) }}" class="btn btn-danger">Delete</a>
    </div>
    <div class="card-footer text-muted">
        Response sent: {{ date_format($response->created_at, 'd-m-Y') }}
    </div>
</div>
