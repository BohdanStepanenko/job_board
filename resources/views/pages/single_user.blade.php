@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('User info') }}</div>

                    @include('components.errors')

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('components.user_info')
                    </div>
                </div>

                @if(!is_null($user->jobVacancies))
                <div class="card">
                    <div class="card-header">{{ __('User vacancies') }}</div>
                    <div class="card-body">
                        @foreach($user->jobVacancies as $vacancy)
                            @include('components.cards')
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!is_null($user->responses))
                <div class="card">
                    <div class="card-header">{{ __('User responses') }}</div>
                    <div class="card-body">
                        @foreach($user->responces as $response)
                            @include('components.response')
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
