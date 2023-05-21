@extends('layouts.app',['pageTitle' => 'Add Evidence'])

@section('title', 'Post: '.$post->title.' | Crimission')

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
                    <hr class="py-0 mt-0 mb-3 ">
                    <h5 class="card-title text-uppercase text-muted mb-1 ml-4 font-16">Evidences</h5>
                    <div class="card-body row mb-3">
                        @foreach($evidence_titles as $evidence_title)
                        <div class="col-sm-2">
                            <span class="text-capitalize font-14">{{ $evidence_title->title }}</span>
                        </div>    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <form method="post" action="{{ route('evidence.store') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
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
                            Evidence Info
                    </div>
                    <div class="card-body">
                        <div class="row">                           
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="evidence-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="evidence-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('mac') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="evidence-mac">{{ __('Secret Key') }}</label>
                                    <input type="password" name="mac" id="evidence-mac" class="form-control form-control-alternative{{ $errors->has('mac') ? ' is-invalid' : '' }}" placeholder="{{ __('Secret Key') }}" value="{{ old('mac') }}" required>

                                    @if ($errors->has('mac'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mac') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="evidence-file">{{ __('Evidence') }}</label>
                                    <input type="file" accept=".jpg,.jpeg,.png,.m4a,.mpeg,.mp3,.mp4,.txt,.xls,.xlsx,.doc,.docx" name="file" id="evidence-file" class="form-control form-control-alternative{{ $errors->has('file') ? ' is-invalid' : '' }}" required>

                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
       
        @include('layouts.footers.auth')
    </div>

@endsection