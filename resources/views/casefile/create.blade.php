@extends('layouts.app',['pageTitle' => 'Create Case document'])

@section('title', 'Verify issue | Crimission')

@section('content')
    <?php
        $priorityColor = 'muted';
        $statusColor = 'muted';

        if ($post->priority === 'simple')
            $priorityColor = 'success';
        else if ($post->priority === 'moderate')
            $priorityColor = 'warning';
        else if ($post->priority === 'high')
            $priorityColor = 'danger';
        else if ($post->priority === 'extreme')
            $priorityColor = 'danger';

        if ($post->status === 'completed')
            $statusColor = 'success';
        else if ($post->status === 'validated')
                $statusColor = 'success';
        else if ($post->status === 'pushed')
            $statusColor = 'warning';
        else if ($post->status === 'pending')
            $statusColor = 'warning';
        else if ($post->status === 'rejected')
            $statusColor = 'danger';
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 px-5 pt-md-8">
        <div class="row mx-0 justify-row-center"> 
            <div class="row mb-md-4 w-100">
                <div class="card card-stats mb-4 shadow mb-xl-0 w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-3 font-16"  {{ __('onclick=location.href=\'')}}{{ route('post.show', ['post' => $post->id]) }}'>
                                    {{ $post->id }} | {{ $post->title }}
                                    <span class="h2 font-weight-bold text-capitalize float-right text-<?php echo $priorityColor ?> font-15">
                                        {{ $post->priority }}
                                    </span>
                                </h5>
                                <span class="row">
                                    <span class="text-capitalize col-sm-3 font-16"><strong>Status:</strong> <span class="text-<?php echo $statusColor ?>">{{ $post->status }}</span></span>
                                    <span class="text-capitalize col-sm-3 font-16"><strong>Locality:</strong> {{ $post->locality }}</span>
                                    <span class="text-capitalize col-sm-3 font-16"><strong>Accused:</strong> {{ $post->accused }}</span><br>
                                </span>
                                <div class="rounded border border-light  mt-3 p-2">
                                    <span class="font-16"><strong>Description:</strong></span>
                                    <span class="font-15">{{ $post->body }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-nowrap">{{ date('d M Y h:i a', strtotime($post->created_at)) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <form method="post" action="{{ route('casefile.store') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="card text-center shadow w-100">
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
                                    <input type="text" name="title" id="casefile-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $post->title) }}" required autofocus>

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
                                    <input type="text" name="file_url" id="casefile-url" class="form-control form-control-alternative{{ $errors->has('file_url') ? ' is-invalid' : '' }}" placeholder="{{ __('Document URL') }}" value="{{ old('file_url') }}">

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
                                        <option value="" disabled {{ old('status') == null ? 'selected': '' }}>Status</option>
                                        <option value="initiating" {{ old('status')==='initiating' ? 'selected': '' }}>Initiating</option>
                                        <option value="filed" {{ old('status')==='filed' ? 'selected': '' }}>Filed</option>
                                        <option value="hearings" {{ old('status')==='hearings' ? 'selected': '' }}>Hearings</option>
                                        <option value="justified" {{ old('status')==='justified' ? 'selected': '' }}>Justified</option>
                                        <option value="rejected" {{ old('status')==='rejected' ? 'selected': '' }}>Rejected</option>
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
                                    <input type="text" name="case_id" id="casefile-caseid" class="form-control form-control-alternative{{ $errors->has('case_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Case ID') }}" value="{{ old('case_id') }}">

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
                                    <input type="text" name="court_name" id="casefile-court-name" class="form-control form-control-alternative{{ $errors->has('court_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Court Name') }}" value="{{ old('court_name') }}">

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
                            <textarea name="body" id="body" rows='5' class="p-4 form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Your detailed complaint report goes here...') }}" required>{{ old('body', $post->body) }}</textarea>

                            @if ($errors->has('body'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body card-top-line">
                        <p class="text-color-black font-weight-bold m-0">Evidence</p>
                    </div>
                    <div class="card-body card-top-line row">
                        <div class="col-sm-6">
                            <div class="px-lg-5 form-group{{ $errors->has('evidence_title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="evidence_title">{{ __('Evidence Name') }}</label>
                                <input type="text" name="evidence_title" id="evidence_title" class="form-control form-control-alternative{{ $errors->has('evidence_title') ? ' is-invalid' : '' }}" placeholder="{{ __('Evidence Name') }}" value="{{ old('evidence_title') }}" required>

                                @if ($errors->has('evidence_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('evidence_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="px-lg-5 form-group{{ $errors->has('evidence_data') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="evidence_data">{{ __('File') }}</label>
                                <input type="file" accept=".jpg,.jpeg,.png,.m4a,.mpeg,.mp3,.mp4,.txt,.xls,.xlsx,.doc,.docx" name="evidence_data" id="evidence_data" class="form-control form-control-alternative{{ $errors->has('evidence_data') ? ' is-invalid' : '' }}" required>

                                @if ($errors->has('evidence_data'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('evidence_data') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary">{{ __('Generate') }}</button>
                    </div>
                </div>
            </form>
        </div>
       
        @include('layouts.footers.auth')
    </div>

@endsection