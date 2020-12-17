<x-layout>
   
    
    <main>
        <div class="container mt-5 pb-5">
            <div class="row align-items-center">    
                <div class="col-12 col-md-8 col-lg-8">
                    <form action="{{route('ads.search')}}" method="get" class="d-flex w-auto mr-5 pr-5">
                        
                        <input class="form-control form-control-lg form-searchBorder rounded-pill shadow pr-5" type="text" name="q" placeholder="Nuova ricerca">
                        <button class="btn btn-searchColor border-0 rounded-pill ml-n5" type="submit">
                            <i class="fa fa-search text-white"></i>
                        </button>
                        
                    </form>
                </div>
                
                
                
            </div>
        </div>
        <div class="bg-light">
        <div class="container py-5">
            <div class="row border-bottom mb-3 pb-2 align-items-end">
                <div class="col-12 col-md-6">
                <h5 class="mb-0">Risultati di ricerca per <span>"{{$q}}"  </span>  </h5>
                    <div class="d-block text-">
                        <span class="result-count text-first">{{$ads->count()}} </span>
                        <span> risultati trovati </span>
                    </div>
                    
                </div>
                <div class="col-12 col-md-6 text-right">
                <form action="{{route('ads.search')}}" method="GET">
                    @csrf
                    <input name="q" type="hidden" value="{{$q}}"> 
                    <label for="sortby" class="mr-2">Ordina per:</label>
                    <select class="px-3 py-2 border bg-light" name="sortby" id="sortby" onchange="this.form.submit()">
                        <option value="1" {{$sortby==1 ? "selected" : ""}}>Ultimi annunci</option>
                        <option value="2" {{$sortby==2 ? "selected" : ""}}>Annunci più vecchi</option>
                        <option value="3" {{$sortby==3 ? "selected" : ""}}>Prezzo più alto</option>
                        <option value="4" {{$sortby==4 ? "selected" : ""}}>Prezzo più basso</option>
                    </select>
                </form>
                </div>
            </div>
            <div class="row">
    


                @foreach ($ads as $ad)
                <div class="col-12 col-md-6">
                    <a href="{{route('ads.show', compact('ad'))}}">
                        <div class="card mb-3 overflow-hidden">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$ad->images->first()->getUrl(400, 300)}}" class="card-img card-img-custom" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$ad->title}}</h5>
                                        <p class="card-text"><small class="text-muted">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                                        <p class="card-text">{{$ad->body}}</p>
                                        <h5 class="text-right">{{$ad->price}} €</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach  
            </div>
        </div>
    </div>
    </x-layout>