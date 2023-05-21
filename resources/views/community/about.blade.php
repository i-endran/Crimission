@extends('layouts.app',['pageTitle' => 'About'])

@section('title', 'About | Crimission')

@section('content')
    <div class="header bg-gradient-primary pb-4 pt-6 pt-md-7">
        <div class="row mx-0 justify-row-center">
            <div class="text-center" >
                <i class="fa fa-balance-scale text-white display-1" aria-hidden="true"></i>
                <h2 class="display-3 postdetail-head-color">
                    Project Crimission
                </h2>  
                <p class="postdetail-head-color">A community driven platform to ensure justice to everyone.</p>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 pb-4 backdrop">
        <div class="mb-3 px-4 justify-row-center text-center overlay">
            <div class="mt-2">
                <strong class="font-20">Why are we here?</strong>
                <p class="mt-2">To provide a way to bring out the injust in all forms such as corruption, crime etc. to light in the safest way.</p>
                <p>Even though the case may fail at the court, they cannot escape from the society.</p>
                <p>Whoever the accused can be, <i>Project Crimission</i> will bring them out to eye of the people.</p>
            </div>
            <div class="mt-5">
                <strong class="font-20">What have we done?</strong>
                <ul class="no-bullet-ul mt-2">
                    <li>Open source project that comes under MIT Licsence</li>
                    <li>Anonymity of user who report a complaint.</li>
                    <li>Lists all the complaints even not filed to court.</li>
                    <li>Completly driven by community.</li>
                    <li>Not owned by any single person.</li>
                </ul>
            </div>
            <div class="mt-5">
                <strong class="font-20">What shall we be doing?</strong>
                <ul class="no-bullet-ul mt-2">
                    <li>Ability to connect with users among the community.</li>
                    <li>Direct messaging compactibilities.</li>
                    <li>Polling the trust of an issue.</li>
                    <li>Commenting and sharing a post.</li>
                    <li>Pusing the casefiles directly to courst via online. (Available in countries with online courts)</li>
                </ul> 
            </div>
            <div class="mt-5">
                <strong class="font-20">What can you do?</strong>
                <p>Project Crimission is at it's development phase. You can contribute us in <a href="https://github.com/crimission/crimission">GitHub</a> or by joining the community.</p>
            </div>
        </div>
    </div>
@endsection

@push('css')
<style>
@media (min-width: 300px){
    .backdrop {
        background-image: url('{{ URL::asset('images/about_body_2.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 90vw 162vw;
        postion: relative;
    }
}
@media (min-width: 600px){
    .backdrop {
        background-image: url('{{ URL::asset('images/about_body.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 70vw 70vw;
        postion: relative;
    }
}
@media (min-width: 720px){
    .backdrop {
        background-image: url('{{ URL::asset('images/about_body.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 60vw 60vw;
        postion: relative;
    }
}
@media (min-width: 1300px){
    .backdrop {
        background-image: url('{{ URL::asset('images/about_body.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 50vw 50vw;
        postion: relative;
    }
}
.overlay {
    background-color: rgba(255,255,255,0.75);
    width: 100%;
    height: 100%;
    position: relative;
    z-index: 1;
}
</style>
@endpush