<div class="card text-center">
    <div class="card-header">
        {{ $vacancy->liked->user->name }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $vacancy->liked->title }}</h5>
        <p class="card-text">{{ $vacancy->liked->description }}</p>
        <p class="card-text">Posted: {{ date_format($vacancy->liked->created_at,"d-m-Y") }} by
            <a href="{{ route ('user', $vacancy->liked->user_id) }}">
                <ins>{{ $vacancy->liked->user->name }}</ins>
            </a>
        </p>
    </div>
</div>
