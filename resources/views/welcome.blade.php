<x-layout>
    
    <header>

        {{-- Errore di accesso revisore --}}
        @if (session('access.denied.revisor.only'))
            <div class="alert alert-danger">
                Accesso non consentito - solo revisori
            </div>
        @endif

        <div class="container-fluid h-100 bg-coin">
            <div class="row align-items-center text-center h-100 pt-n5 header-align">
                <div class="col-12 px-auto px-md-5">
                    {{-- Barra di ricerca --}}
                <form action="{{route('ads.search')}}" method="get">
                        <div class="row no-gutters mt-3 align-items-center justify-content-center">
                            <div class="col-12 col-sm-11 col-md-9 col-lg-5">
                                <input class="form-control form-control-lg form-searchBorder rounded-pill shadow pr-5" type="text" name="q" placeholder="Cerca ciò che desideri">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-searchColor border-0 rounded-pill ml-n5" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    
    <main>

        {{-- Categorie --}}
        <div class="container-home">
            <div class="row text-center">
                
                @foreach ($categories as $category)                
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="my-3 card-category">
                        <div class="card-body font-weight-bold"> 
                            <a href="{{route('ads.index', compact('category'))}}">{{$category->name}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
        
        {{-- Ultimi 5 annunci --}}
        <section class="bg-white pt-5">
            <div class="container">
                <div class="row">
                    @foreach ($ads as $ad)
                    <div class="col-12">
                        <a href="{{route('ads.show', compact('ad'))}}">
                            <div class="card mb-3 overflow-hidden">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="https://via.placeholder.com/300x150.png" class="card-img img-fluid" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$ad->title}}</h5>
                                            <p class="card-text"><small class="text-muted">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                                            <h3>{{$ad->price}} €</h3>
                                            <p class="card-text">{{$ad->body}}</p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
</x-layout>
