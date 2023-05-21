@extends('layouts.app',['pageTitle' => 'Edit Evidence'])

@section('title', 'Case: '.$casefile->title.' | Crimission')

@section('content')
    <?php
        $statusColor = 'muted';

        if ($casefile->status === 'initiating')
            $statusColor = 'warning';
        else if ($casefile->status === 'filed')
                $statusColor = 'success';
        else if ($casefile->status === 'hearings')
            $statusColor = 'warning';
        else if ($casefile->status === 'justified')
            $statusColor = 'success';
        else if ($casefile->status === 'rejected')
            $statusColor = 'danger';
    ?>

    <div class="header bg-gradient-primary pb-8 pt-5 px-5 pt-md-8">
        <div class="row mx-0 justify-row-center"> 
            <div class="row mb-md-4 w-100" {{ __('onclick=location.href=\'')}}{{ route('casefile.show', $casefile->id) }}'>
                <div class="card card-stats mb-4 shadow mb-xl-0 w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-3 font-16">
                                    {{ $casefile->id }} | {{ $casefile->title }}
                                    <span class="h2 font-weight-bold text-capitalize float-right text-<?php echo $statusColor ?> font-15">
                                        {{ $casefile->status }}
                                    </span>
                                </h5>
                                <span class="row">
                                    <span class="text-capitalize col-sm-3 font-16"><strong>Post ID:</strong> {{ $casefile->post_id }}</span>
                                    <span class="text-capitalize col-sm-3 font-16"><strong>User Name:</strong> {{ $casefile->user->name }}</span>
                                </span>
                                <div class="rounded border border-light  mt-3 p-2 w-100">
                                    <span class="font-16"><strong>Description:</strong></span>
                                    <span class="font-15">{{ $casefile->body }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="mr-2">Evidence count : <span class="text-danger"></i>{{ $casefile->evidences->count() }}</span></span>
                            <span class="text-nowrap">{{ date('d M Y h:i a', strtotime($casefile->created_at)) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <div class="card text-center shadow w-100">
                <div class="card text-center shadow w-100">
                    <form method="post" action="{{ route('casefileevidence.update', $evidence) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="casefile_id" value="{{ $casefile->id }}">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header text-color-black font-weight-bold">
                            Update Evidence
                        </div>
                        <div class="card-body">
                            <div class="row">                           
                                <div class="col-sm-6">
                                    <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="evidence-title">{{ __('Title') }}</label>
                                        <input type="text" name="title" id="evidence-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $evidence->title) }}" required autofocus>

                                        @if ($errors->has('title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="px-lg-5 form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="evidence-url">{{ __('Evidence') }}</label>
                                        <input type="file" accept=".jpg,.jpeg,.png,.gif,.mp3,.mp4,.txt,.doc,.docx" name="file" id="evidence-url" class="form-control form-control-alternative{{ $errors->has('file') ? ' is-invalid' : '' }}">

                                        @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-1">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                    <form action="{{ route('casefileevidence.destroy', $evidence) }}" method="post">
                        <div class="card-body text-center mb-5">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
        @include('layouts.footers.auth')
    </div>

@endsection