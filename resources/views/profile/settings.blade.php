@extends('layouts.app',['pageTitle' => 'Delete Account'])

@section('title', 'Settings | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">{{ __('Delete your account') }}</h2>  
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <div class="card text-center shadow w-100">
                <div class="card-header text-danger font-weight-bold">
                    Are you sure, you want to delete your account?
                </div>
                <div class="card-body">
                    <div class="row justify-row-center">
                        <div class="col-sm-6">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('profile.delete') }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection