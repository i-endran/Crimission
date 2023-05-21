@extends('layouts.app', ['class' => 'bg-default', 'pageTitle' => 'Welcome to Crimission'])

@section('title','Welcome | Crimission')

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <i class="fa fa-balance-scale mt-5 text-white display-1" aria-hidden="true"></i>
                        <h1 class="text-white display-1">{{ __('Crimission!') }}</h1>
                        <p class="text-lead text-light">
                            {{ __('A community driven justice platform.') }}
                        </p>
                        @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    
    <div class="container mt--10 pb-3"></div>
@endsection
