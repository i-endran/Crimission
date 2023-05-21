@extends('layouts.app', ['pageTitle' => 'Case files'])

@section('title','Cases | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">{{ __('List of Verified posts') }}</h2>  
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        @foreach($casefiles as $casefile)
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
            <div class="row px-3 mb-md-4" {{ __('onclick=location.href=\'')}}{{ route('casefile.show', $casefile->id) }}'>
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
                                <div class="rounded border border-light  mt-3 p-2">
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
        @endforeach
        @include('layouts.footers.auth')
    </div>
@endsection