@extends('layouts.app',['pageTitle' => 'Feedback'])

@section('title', 'Support | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-4 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">Feed Back & Support</h2>  
            </div>
        </div>
    </div>

    <div class="container-fluid pt-3">
        <div class="mb-3 px-4 text-center">
            <form action="{{ route('feedback.store') }}" method="post">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="feedback-title">{{ __('Title') }}</label>
                    <input type="text" name="title" id="feedback-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="px-lg-5 form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                    <label class="form-control-label" for="feedback-body">{{ __('Report') }}</label>
                    <textarea name="body" id="feedback-body" rows='5' class="p-4 form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Tell us what do you feel...') }}" required>{{ old('body') }}</textarea>

                    @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="text-center mb-5">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection