@extends('layouts.app',['pageTitle' => 'Create New Post'])

@section('title','Post Complaints | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">Post Form</h2>  
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <form method="post" action="{{ route('post.store') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="status" value="{{ __('pending') }}">
                <div class="card text-center shadow w-100">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-header text-color-black font-weight-bold">
                            Basic Info
                    </div>
                    <div class="card-body">
                        <div class="row">                           
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="post-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('mac') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-mac">{{ __('Secret Key') }}</label>
                                    <input type="password" name="mac" id="post-mac" class="form-control form-control-alternative{{ $errors->has('mac') ? ' is-invalid' : '' }}" placeholder="{{ __('Secret Key') }}" value="{{ old('mac') }}" required>

                                    @if ($errors->has('mac'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mac') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('privacy') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-privacy">{{ __('Privacy') }}</label>
                                    <select name="privacy" id="post-privacy" class="form-control form-control-alternative{{ $errors->has('privacy') ? ' is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('privacy')== null ? 'selected': '' }}>Privacy</option>
                                        <option value="private" {{ old('privacy')==='private' ? 'selected': '' }}>Private</option>
                                        <option value="local" {{ old('privacy')==='local' ? 'selected': '' }}>Local</option>
                                        <option value="public" {{ old('privacy')==='public' ? 'selected': '' }}>Public</option>
                                    </select>

                                    @if ($errors->has('privacy'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('privacy') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-priority">{{ __('Priority') }}</label>
                                    <select name="priority" id="post-priority" class="form-control form-control-alternative{{ $errors->has('priority') ? ' is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('priority') == null ? 'selected': '' }}>Priority</option>
                                        <option value="simple" {{ old('priority')==='simple' ? 'selected': '' }}>Simple</option>
                                        <option value="moderate" {{ old('priority')==='moderate' ? 'selected': '' }}>Moderate</option>
                                        <option value="high" {{ old('priority')==='high' ? 'selected': '' }}>High</option>
                                        <option value="extreme" {{ old('priority')==='extreme' ? 'selected': '' }}>Extreme</option>
                                    </select>

                                    @if ($errors->has('priority'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('post_type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post_type">{{ __('Post Type') }}</label>
                                    <input type="text" name="post_type" id="post_type" class="form-control form-control-alternative{{ $errors->has('post_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Post Type') }}" value="{{ old('post_type') }}" required>

                                    @if ($errors->has('post_type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('post_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('locality') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="locality">{{ __('Locality') }}</label>
                                    <input type="text" name="locality" id="locality" class="form-control form-control-alternative{{ $errors->has('locality') ? ' is-invalid' : '' }}" placeholder="{{ __('Locality') }}" value="{{ old('locality') }}" required>

                                    @if ($errors->has('locality'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('locality') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        <!-- <h5 class="card-title">title</h5> -->
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                    <div class="card-body card-top-line">
                        <p class="text-color-black font-weight-bold m-0">Accused Details</p>
                    </div>
                    
                    <div class="card-body card-top-line row">
                        <div class="col-sm-6">
                            <div class="px-lg-5 form-group{{ $errors->has('accused') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="accused">{{ __('Accused Name') }}</label>
                                <input type="text" name="accused" id="accused" class="form-control form-control-alternative{{ $errors->has('accused') ? ' is-invalid' : '' }}" placeholder="{{ __('Accused Name') }}" value="{{ old('accused') }}" required>

                                @if ($errors->has('accused'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('accused') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="px-lg-5 form-group{{ $errors->has('accused_details') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="accused_details">{{ __('Description') }}</label>
                                <input type="text" name="accused_details" id="accused_details" class="form-control form-control-alternative{{ $errors->has('accused_details') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('accused_details') }}" required>

                                @if ($errors->has('accused_details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('accused_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-body card-top-line">
                        <p class="text-color-black font-weight-bold m-0">Charge</p>
                    </div>
                    <div class="card-body card-top-line">
                        <div class="px-lg-5 form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="body">{{ __('Report') }}</label>
                            <textarea name="body" id="body" rows='5' class="p-4 form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Your detailed complaint report goes here...') }}" required>{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- <div class="card-body card-top-line">
                        <p class="text-color-black font-weight-bold m-0">Evidences</p>
                    </div>
                    <div class="card-body card-top-line">
                    </div> -->
                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
       
        @include('layouts.footers.auth')
    </div>

@endsection
