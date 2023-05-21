@extends('layouts.app', ['pageTitle' => 'Home'])

@section('title','Home | Crimission')

@section('content')
    @include('layouts.headers.cards', [
        'postCount' => $postCount,
        'postRatio' => $postRatio,
        'verificationCount' => $verificationCount,
        'verificationRatio' => $verificationRatio,
        'verdictCount' => $verdictCount,
        'verdictRatio' => $verdictRatio,
        'communityCount' => $communityCount,
        'communityRatio' => $communityRatio
    ])
    
    <div class="container-fluid mt--7">
        <div class="row mb-3 justify-row-center px-3">
            <h3 class="display-4 dashboard-post-head">POSTS</h3>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @foreach($posts as $post)
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
            <div class="row px-3 mb-md-4" {{ __('onclick=location.href=\'')}}{{ route('post.show', ['post' => $post->id]) }}'>
                <div class="card card-stats mb-4 shadow mb-xl-0 w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-3 font-16">
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
                            <!-- <div class="col-auto">
                                <span class="h2 font-weight-bold text-capitalize mb-0 text-success" style="fontsize: 15px">{{ $post->priority }}</span>
                            </div> -->
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="mr-2">Evidence count : <span class="text-danger"></i>{{ $post->evidences->count() }}</span></span>
                            <span class="text-nowrap">{{ date('d M Y h:i a', strtotime($post->created_at)) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
        @include('layouts.footers.auth')
    </div>
@endsection