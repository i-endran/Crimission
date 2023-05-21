@extends('layouts.app',['pageTitle' => 'Edit Case'])

@section('title','Edit Files | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div>
                <h2 class="display-4 postdetail-head-color">Case update form</h2>  
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <div class="card text-center shadow w-100">
                <form method="post" action="{{ route('casefile.update', $casefile->id) }}" autocomplete="off">
                    @method('PUT')
                    @csrf
                    @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card-header text-color-black font-weight-bold">
                            Case Info
                    </div>
                    <div class="card-body">
                        <div class="row">                           
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="casefile-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="casefile-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $casefile->title) }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('file_url') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="casefile-url">{{ __('Official Document URL') }}</label>
                                    <input type="text" name="file_url" id="casefile-url" class="form-control form-control-alternative{{ $errors->has('file_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Document URL') }}" value="{{ old('file_url', $casefile->file_url) }}">

                                    @if ($errors->has('file_url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="casefile-status">{{ __('Status') }}</label>
                                    <select name="status" id="casefile-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('status', $casefile->status) == null ? 'selected': '' }}>Status</option>
                                        <option value="initiating" {{ old('status', $casefile->status)==='initiating' ? 'selected': '' }}>Initiating</option>
                                        <option value="filed" {{ old('status', $casefile->status)==='filed' ? 'selected': '' }}>Filed</option>
                                        <option value="hearings" {{ old('status', $casefile->status)==='hearings' ? 'selected': '' }}>Hearings</option>
                                        <option value="justified" {{ old('status', $casefile->status)==='justified' ? 'selected': '' }}>Justified</option>
                                        <option value="rejected" {{ old('status', $casefile->status)==='rejected' ? 'selected': '' }}>Rejected</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('case_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="casefile-caseid">{{ __('Case ID') }}</label>
                                    <input type="text" name="case_id" id="casefile-caseid" class="form-control form-control-alternative{{ $errors->has('case_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Case ID') }}" value="{{ old('case_id', $casefile->case_id) }}">

                                    @if ($errors->has('case_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('case_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('court_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="casefile-court-name">{{ __('Court Name') }}</label>
                                    <input type="text" name="court_name" id="casefile-court-name" class="form-control form-control-alternative{{ $errors->has('court_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Court Name') }}" value="{{ old('court_name', $casefile->court_name) }}">

                                    @if ($errors->has('court_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('court_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-top-line">
                        <div class="px-lg-5 form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="body">{{ __('Report') }}</label>
                            <textarea name="body" id="body" rows='5' class="p-4 form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Your detailed complaint report goes here...') }}" required>{{ old('body', $casefile->body) }}</textarea>

                            @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="text-center mb-1">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
                <form action="{{ route('casefile.destroy', $casefile->id) }}" method="post">
                    <div class="card-body text-center mb-5">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

@endsection
