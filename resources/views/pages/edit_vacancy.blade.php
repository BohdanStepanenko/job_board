@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Update vacancy') }}</div>

                    @include('components.errors')

                    <div class="card-body">
                        @include('components.edit_vacancy_form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
