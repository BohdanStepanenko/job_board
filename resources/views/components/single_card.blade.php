<div class="card text-center">
    <div class="card-header">
        {{ $vacancy->user->name }}
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $vacancy->title }}</h5>
        <p class="card-text">{{ $vacancy->description }}</p>
        <p class="card-text">Posted: {{ date_format($vacancy->created_at,"d-m-Y") }} by
            <a href="{{ route ('user', $vacancy->user_id) }}">
                <ins>{{ $vacancy->user->name }}</ins>
            </a>
        </p>
    </div>

    @auth
        <div class="card-footer text-muted">
            @if(Auth::user()->id == $vacancy->user_id)
                <a href="{{ route ('edit-vacancy', $vacancy->id) }}" class="btn btn-primary">Update</a>
                <a href="{{ route ('delete-vacancy', $vacancy->id) }}" class="btn btn-danger">Delete</a>
            @else
                {{-- TODO: Realize like checkbox --}}
                <a href="#" class="btn btn-danger">Like!</a>
                <a href="{{ route('send-response', $vacancy->id) }}" class="btn btn-success">Send response</a>
            @endif
        </div>
    @endauth
</div>
