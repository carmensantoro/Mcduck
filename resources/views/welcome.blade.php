<x-layout>
    
    <header>
        <div class="container h-100">
            <div class="row align-items-center text-center h-100 pt-n5 header-align">
                <div class="col-12 px-auto px-md-5">
                    {{-- Barra di ricerca --}}
                    <div class="row no-gutters mt-3 align-items-center justify-content-center">
                        <div class="col-10 col-sm-11 col-md-9 col-lg-5">
                            <input class="form-control form-control-lg form-searchBorder rounded-pill pr-5" type="search" placeholder="Cerca ciò che desideri">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-searchColor border-0 rounded-pill ml-n5" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <main>
        
        {{-- Categorie --}}
        <div class="container-home">
            <div class="row text-center">
                @foreach ($categories as $category)
                
                <div class="col-6 col-md-3">
                
                    <div class="card my-3">
                        <div class="card-body"> 
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
                            <div class="card mb-3">
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
