
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-transparent">
    <a class="navbar-brand ml-5" href="{{route('home')}}">McDuck</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="position-relative d-none d-md-block w-50">
        <a class="position-absolute btn bg-danger" href="{{route('ads.create')}}">Crea il tuo annuncio</a>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="btn btn-newAd rounded-pill" href="{{route('ads.create')}}">Crea il tuo annuncio</a>
        </li>
    </ul>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link mx-md-3" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('ads.index', ['category'=>'all'])}}">Tutti gli annunci</a>
            </li>
            <li class="nav-item d-md-none">
                <a class="btn bg-danger" href="{{route('ads.create')}}">Crea il tuo annuncio</a>
            </li>


            @guest
            @if (Route::has('login'))
            <li class="nav-item mx-md-3">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif
            
            @if (Route::has('register'))
            <li class="nav-item ml-md-3 mr-md-3">
                <a class="nav-link btn-custom rounded-pill" href="{{ route('register') }}">{{ __('Register') }}</a>
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
                    {{ __('Logout') }}
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>
</nav>
