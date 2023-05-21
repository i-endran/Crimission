@extends('layouts.app',['pageTitle' => 'Case Details'])

@section('title', 'Case: '.$casefile->title.' | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">{{ $casefile->id }} | {{ $casefile->title }}</h2>  
            </div>
        </div>
    </div>
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
    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
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
                    Detailed view
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="text-capitalize">
                                <strong>Status</strong> : 
                                <span class="text-<?php echo $statusColor ?>">
                                    {{ $casefile->status }}
                                </span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Post ID</strong> : <a href="{{ route('post.show', $casefile->post_id) }}">{{ $casefile->post_id }}</a></p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>User Name</strong> : {{ $casefile->user->name }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Case ID</strong> : {{ $casefile->case_id == null ? 'No entry': $casefile->case_id }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Court</strong> : {{ $casefile->court_name == null ? 'No entry': $casefile->court_name }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Official Document</strong> : <a href="{{ $casefile->file_url == null ? '#': $casefile->file_url }}">{{ $casefile->file_url == null ? 'No entry': $casefile->file_url }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="card-body card-top-line">
                    <p class="text-color-black font-weight-bold m-0">Accused Details</p>
                </div>
                <div class="card-body card-top-line">
                    <p class="mb-2"><strong>Name</strong></p>
                    <p>{{ $post->accused }}</p>
                    <p class="mb-2"><strong>Info</strong></p>
                    <p>{{ $post->accused_details }}</p>
                </div>
                
                <div class="card-body card-top-line">
                    <p class="text-color-black font-weight-bold m-0">Charge</p>
                </div>
                <div class="card-body card-top-line">
                    <p>{{ $casefile->body }}</p>
                </div>
                
                <div class="card-body card-top-line">
                    <p class="text-color-black font-weight-bold m-0">Evidences</p>
                </div>
                <div class="card-body card-top-line">
                @if($images->count() > 0)
                    <p class="card-title font-weight-bold font-15">Images</p>
                    <div class="row justify-row-center font-14">
                        @foreach($images as $image)
                            <div class="col-lg-4">
                                <img src="{{ asset('data/casefiles') }}/{{ $casefile->id }}/{{ $image->data }}" width="250px" alt="image evidence"><br>
                                <a href="{{ route('casefileevidence.edit', $image->id) }}" >{{ $image->id }}</a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                @if($audios->count() > 0)
                    <p class="card-title font-weight-bold font-15">Audios</p>
                    <div class="row justify-row-center font-14">
                        @foreach($audios as $audio)
                            <div class="col-lg-4">
                                <audio width="250px" controls> 
                                    <source src="{{ asset('data/casefiles') }}/{{ $casefile->id }}/{{ $audio->data }}" type="audio/mpeg" alt="audio evidence">
                                    Audio not supported. URL: {{ $audio->data }} 
                                </audio><br>
                                <a href="{{ route('casefileevidence.edit', $audio->id) }}" >{{ $audio->id }}</a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                @if($videos->count() > 0)
                    <p class="card-title font-weight-bold font-15">Videos</p>
                    <div class="row justify-row-center font-14">
                        @foreach($videos as $video)
                            <div class="col-lg-4">
                                <video width="250px" controls> 
                                    <source src="{{ asset('data/casefiles') }}/{{ $casefile->id }}/{{ $video->data }}" type="video/mp4" alt="video evidence">
                                    Video not supported. URL: {{ $video->data }} 
                                </video><br>
                                <a href="{{ route('casefileevidence.edit', $video->id) }}" >{{ $video->id }}</a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                @if($texts->count() > 0)
                    <p class="card-title font-weight-bold font-15">Text documents</p>
                    <div class="row justify-row-center font-14">
                        @foreach($texts as $text)
                            <div class="col-sm-3">
                                <a href="{{ asset('data/casefiles') }}/{{ $casefile->id }}/{{ $text->data }}" target="_blank">
                                    <i class="fas fa-file"></i> <a href="{{ route('casefileevidence.edit', $text->id) }}" >{{ $text->id }}</a>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                    @if(auth()->user()->id == $casefile->user->id)
                    <a href="{{ route('casefileevidence.create', $casefile->id) }}" class="btn btn-primary mt-4">Add Evidence</a>
                    <a href="{{ route('casefile.edit', $casefile->id) }}" class="btn btn-primary mt-4">Edit File</a>
                    @endif
                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary mt-4">View Post</a>
                </div>

                <div class="card-footer text-muted">
                    <p style="font-size:15px">{{ date('d M Y h:i a', strtotime($casefile->created_at)) }}</p>
                </div>
            </div>
        </div>
       
        @include('layouts.footers.auth')
    </div>
@endsection