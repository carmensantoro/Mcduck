
<nav id="navbar" class="navbar navbar-expand-lg sticky-top navbar-light bg-white">
    <a class="navbar-brand ml-md-5" href="{{route('home')}}"><img src="/media/icon-coin.png" alt="" width="50" class="mr-1">McDuck 
        
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link mx-md-3" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('ads.index', ['category'=>'all'])}}">{{ __('ui.allAds') }}</a>
            </li>
            
            @auth
            
            @if(Auth::user()->is_revisor)
            <li class="nav-item">
                <a href="{{ route('revisor.index')}}" class="nav-link">
                    Da revisionare
                    <span class="badge badge-pill badge-warning">{{
                        \App\Models\Ad::ToBeRevisionedCount()
                    }}</span>
                </a>
            </li>
            @endif
            
            @endauth
            
        </ul>
        
        
        
        <ul class="navbar-nav">
            @guest
            @if (Route::has('login'))
            <li class="nav-item mx-md-3">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif
            
            @if (Route::has('register'))
            <li class="nav-item mx-md-3 my-2 my-lg-0">
                <a class="nav-link btn-custom rounded" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{route('favorites.index')}}">Preferiti</a>
                    <a class="dropdown-item" href="{{route('ads.personal')}}">Annunci personali</a>
                </div>
            </li>
            @endguest
            
            <li class="nav-item mr-md-3 my-2 my-lg-0">
                <a class="btn btn-newAd rounded" href="{{route('ads.create')}}">{{__('ui.CreateAd')}}</a>
            </li> 
            
            <li class="nav-item dropdown">
                <div class="nav-link dropdown-item dropdown-toggle" href="#" id="dropdownLocale" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('ui.lang') }}
                </div>
                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownLocale">
                    <form class="dropdown-item" action="{{route('locale', 'it')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn"><span class="flag-icon flag-icon-it"></span></button>
                    </form>
                    <form class="dropdown-item" action="{{route('locale', 'en')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn"><span class="flag-icon flag-icon-gb"></span></button>
                    </form>
                    <form class="dropdown-item" action="{{route('locale', 'es')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn"><span class="flag-icon flag-icon-es"></span></button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
