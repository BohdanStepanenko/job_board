@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(!is_null($liked_users))
                    <div class="card">
                        <div class="card-header">{{ __('Liked users') }}</div>
                        <div class="card-body">
                            @foreach($liked_users as $user)
                                @include('components.liked_user')
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(!is_null($liked_vacancies))
                    <div class="card">
                        <div class="card-header">{{ __('Liked vacancies') }}</div>
                        <div class="card-body">
                            @foreach($liked_vacancies as $vacancy)
                                @include('components.liked_vacancy')
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
