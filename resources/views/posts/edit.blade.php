@extends('layouts.app',['pageTitle' => 'Edit Post'])

@section('title','Edit Complaints | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row mx-0 justify-row-center">
            <div >
                <h2 class="display-4 postdetail-head-color">Update form</h2>  
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <div class="row mb-3 px-4 justify-row-center">
            <div class="card text-center shadow w-100">
            <form method="post" action="{{ route('post.update', $post->id) }}" autocomplete="off">
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
                            Basic Info
                    </div>
                    <div class="card-body">
                        <div class="row">                           
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="post-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title', $post->title) }}" required autofocus>

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
                                        <option value="" disabled {{ old('privacy', $post->privacy)== null ? 'selected': '' }}>Privacy</option>
                                        <option value="private" {{ old('privacy', $post->privacy)==='private' ? 'selected': '' }}>Private</option>
                                        <option value="local" {{ old('privacy', $post->privacy)==='local' ? 'selected': '' }}>Local</option>
                                        <option value="public" {{ old('privacy', $post->privacy)==='public' ? 'selected': '' }}>Public</option>
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
                                        <option value="" disabled {{ old('priority', $post->priority) == null ? 'selected': '' }}>Priority</option>
                                        <option value="simple" {{ old('priority', $post->priority)==='simple' ? 'selected': '' }}>Simple</option>
                                        <option value="moderate" {{ old('priority', $post->priority)==='moderate' ? 'selected': '' }}>Moderate</option>
                                        <option value="high" {{ old('priority', $post->priority)==='high' ? 'selected': '' }}>High</option>
                                        <option value="extreme" {{ old('priority', $post->priority)==='extreme' ? 'selected': '' }}>Extreme</option>
                                    </select>

                                    @if ($errors->has('priority'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post-status">{{ __('Status') }}</label>
                                    <select name="status" id="post-status" class="form-control form-control-alternative{{ $errors->has('priority') ? ' is-invalid' : '' }}" required>
                                        <option value="" disabled {{ old('status', $post->status) == null ? 'selected': '' }}>Status</option>
                                        <option value="pending" {{ old('status', $post->status)==='pending' ? 'selected': '' }}>Pending</option>
                                        <option value="validated" {{ old('status', $post->status)==='validated' ? 'selected': '' }}>Validated</option>
                                        <option value="pushed" {{ old('status', $post->status)==='pushed' ? 'selected': '' }}>Pushed</option>
                                        <option value="completed" {{ old('status', $post->status)==='completed' ? 'selected': '' }}>Completed</option>
                                        <option value="rejected" {{ old('status', $post->status)==='rejected' ? 'selected': '' }}>Rejected</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="px-lg-5 form-group{{ $errors->has('post_type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="post_type">{{ __('Post Type') }}</label>
                                    <input type="text" name="post_type" id="post_type" class="form-control form-control-alternative{{ $errors->has('post_type') ? ' is-invalid' : '' }}" placeholder="{{ __('Post Type') }}" value="{{ old('post_type', $post->post_type) }}" required>

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
                                    <input type="text" name="locality" id="locality" class="form-control form-control-alternative{{ $errors->has('locality') ? ' is-invalid' : '' }}" placeholder="{{ __('Locality') }}" value="{{ old('locality', $post->locality) }}" required>

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
                                <input type="text" name="accused" id="accused" class="form-control form-control-alternative{{ $errors->has('accused') ? ' is-invalid' : '' }}" placeholder="{{ __('Accused Name') }}" value="{{ old('accused', $post->accused) }}" required>

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
                                <input type="text" name="accused_details" id="accused_details" class="form-control form-control-alternative{{ $errors->has('accused_details') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ old('accused_details', $post->accused_details) }}" required>

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
                            <textarea name="body" id="body" rows='5' class="p-4 form-control form-control-alternative{{ $errors->has('body') ? ' is-invalid' : '' }}" placeholder="{{ __('Your detailed complaint report goes here...') }}" required>{{ old('body', $post->body) }}</textarea>

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
                    <div class="text-center mb-1">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
                <form id="del-form" action="{{ route('post.destroy', $post->id) }}" method="post">
                    <div class="card-body text-center mb-5">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="mac" id="del-mac" value="">
                        <button type="submit" id="del" onclick="event.preventDefault(); copyData();" class="btn btn-danger">{{ __('Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
       
        @include('layouts.footers.auth')
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        function copyData() {
            let mac = $('#post-mac').val();
            if (mac.length < 6)
            {
                $.alert({
                    icon: 'fa fa-warning',
                    title: 'Error!',
                    content: 'Please enter a valid Secret Key!',
                    type: 'red',
                    typeAnimated: true
                });
                return;
            }
            $('#del-mac').val(mac);
            $('#del-form').submit();
            
        };
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endpush