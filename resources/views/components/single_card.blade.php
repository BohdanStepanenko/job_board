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
                <form method="POST" action="{{ route('set-like') }}">
                    @csrf
                    <input type="hidden" name="liked_type" value="{{ get_class($vacancy) }}"/>
                    <input type="hidden" name="liked_id" value="{{ $vacancy->id }}"/>
                    <input type="submit" class="btn btn-danger" value="Like!">
                </form>

                <a href="{{ route('delete-like', ['liked_type' => get_class($vacancy), 'liked_id' => $vacancy->id]) }}" class="btn btn-warning">Unlike</a>
            @endif
        </div>
    @endauth
</div>
