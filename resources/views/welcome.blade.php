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
                    <div class="box-search-home">
                        <form action="{{route('ads.search')}}" method="get">
                            <div class="row no-gutters mt-3 align-items-center justify-content-center position-relative">
                                <div class="col-3 coin-search position-absolute">
                                    <img src="/media/icon-coin.png" alt="" class="img-fluid">
                                </div>
                                <div class="col-12 d-flex p-2 pl-md-5 input-search rounded shadow">
                                    <input class="form-control form-control-lg rounded pr-5" id="text-input" type="text" name="q" placeholder="{{__('ui.search')}}">
                                    
                                    
                                    <button class="btn btn-searchColor border-0 rounded ml-n5" type="submit">
                                        <i class="text-white fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <main>
        
        {{-- Categorie --}}
        <div class="container-home rounded">
            <div class="row text-center">
                
                @foreach ($categories as $category)                
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="my-3 card-category rounded">
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
                    <div class="col-12 position-relative">
                        <div class="heart"> 
                            <button class="btn" onclick="favor({{$ad->id}})">
                                
                                @if (($favorite->firstWhere('ad_id', "$ad->id")))
                                <i id="{{$ad->id}}" class="fas fa-heart text-first fa-2x"></i>
                                @else
                                <i id="{{$ad->id}}" class="far fa-heart text-first fa-2x"></i>
                                @endif
                                
                            </button>
                        </div>
                        <a href="{{route('ads.show', compact('ad'))}}">
                            <div class="card mb-3 overflow-hidden">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        @if(count($ad->images) > 0)
                                        <img src="{{$ad->images->first()->getUrl(400, 300)}}" class="card-img img-fluid" alt="..."> 
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <span class="small d-block text-right">{{__('ui.CreatedOn')}}{{$ad->created_at->format('d/m/Y')}}</span>
                                            <h5 class="card-title mb-0">{{$ad->title}}</h5>
                                            <p class="card-text"><small class="text-muted">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                                            <h3>{{$ad->price}} €</h3>
                                            <p class="card-text text-truncate">{{$ad->body}}</p>
                                            <p>{{__('ui.UploadBy')}}{{$ad->user()->get()->implode('name', '')}}</p>            
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
            
            
            {{-- Annuncio per diventare revisore --}}
            <div class="container-fluid bg-money my-5 p-5">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="font-weight-bold">Vuoi collaborare con noi e guadagnare soldi?</h2>
                        <h6 class="font-weight-bold">Diventa nostro revisore!</h6>
                        <a class="btn btn-custom rounded" href="{{ route('revisor.formRequest') }}">Clicca qui</a>
                    </div>
                </div>
            </div>
            
            
        </main>
        
    </x-layout>
    