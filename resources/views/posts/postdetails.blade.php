@extends('layouts.app',['pageTitle' => 'Post Details'])

@section('title', 'Post: '.$post->title.' | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">{{ $post->id }} | {{ $post->title }}</h2>  
            </div>
        </div>
    </div>
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
                                <strong>Severity</strong> : 
                                <span class="text-<?php echo $priorityColor ?>">
                                    {{ $post->priority }}
                                </span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-capitalize">
                                <strong>Status</strong> : 
                                <span class="text-<?php echo $statusColor ?>">
                                    {{ $post->status }}
                                </span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Type</strong> : {{ $post->post_type }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Locality</strong> : {{ $post->locality }}</p>
                        </div>
                        
                    </div>
                    <!-- <h5 class="card-title">title</h5> -->
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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
                    <p>{{ $post->body }}</p>
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
                                <img src="{{ asset('data/posts') }}/{{ $post->id }}/{{ $image->data }}" width="250px" alt="image evidence"><br>
                                <a href="{{ route('evidence.edit', $image->id) }}" >{{ $image->id }}</a>
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
                                    <source src="{{ asset('data/posts') }}/{{ $post->id }}/{{ $audio->data }}" type="audio/mpeg" alt="audio evidence">
                                    Audio not supported. URL: {{ $audio->data }} 
                                </audio><br>
                                <a href="{{ route('evidence.edit', $audio->id) }}" >{{ $audio->id }}</a>
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
                                    <source src="{{ asset('data/posts') }}/{{ $post->id }}/{{ $video->data }}" type="video/mp4" alt="video evidence">
                                    Video not supported. URL: {{ $video->data }} 
                                </video><br>
                                <a href="{{ route('evidence.edit', $video->id) }}" >{{ $video->id }}</a>
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
                                <a href="{{ asset('data/posts') }}/{{ $post->id }}/{{ $text->data }}" target="_blank">
                                    <i class="fas fa-file"></i> <a href="{{ route('evidence.edit', $text->id) }}" >{{ $text->id }}</a>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
                    <a href="{{ route('evidence.create', $post->id) }}" class="btn btn-primary mt-4">Add Evidence</a>
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary mt-4">Edit Post</a>
                    <a href="{{ route('casefile.create', $post->id) }}" class="btn btn-primary mt-4">Verify</a>
                </div>

                <div class="card-footer text-muted">
                    <p style="font-size:15px">{{ date('d M Y h:i a', strtotime($post->created_at)) }}</p>
                </div>
            </div>
        </div>
       
        @include('layouts.footers.auth')
    </div>
@endsection