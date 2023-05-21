@auth()
    @include('layouts.navbars.navs.auth',['pageTitle' => $pageTitle])
@endauth
    
@guest()
    @include('layouts.navbars.navs.guest',['pageTitle' => $pageTitle])
@endguest