<div class="card mb-3" style="max-width: 540px;">
    <div class="row">
        <div class="col-md-4">
            <img src="https://www.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png" class="img-fluid rounded-start" alt="avatar">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <a href="{{ route ('user', $user->id) }}">
                    <h5 class="card-title"><ins>{{ $user->name }}</ins></h5>
                </a>
                <p class="card-text">{{ $user->email }}</p>

                @auth
                {{-- TODO: Realize like checkbox --}}
                <a href="#" class="btn btn-danger">Like!</a>
                @endauth
            </div>
        </div>
    </div>
</div>
