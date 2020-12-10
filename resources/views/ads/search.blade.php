<x-layout>
   
    
    <main>
        <div class="container mt-5">
            <div class="row align-items-center">    
                <div class="col-12 col-md-8 col-lg-8">
                    <form action="{{route('ads.search')}}" method="get" class="d-flex w-auto mr-5 pr-5">
                        
                        <input class="form-control form-control-lg form-searchBorder rounded-pill shadow pr-5" type="text" name="q" placeholder="Risultati per ricerca: {{$q}}">
                        <button class="btn btn-searchColor border-0 rounded-pill ml-n5" type="submit">
                            <i class="fa fa-search text-white"></i>
                        </button>
                        
                    </form>
                </div>
                
                <div class="col-12 col-md-4 col-lg-4">
                    <label for="sortby">Ordina per:</label>
                    <select name="sortby" id="sortby">
                        <option value="last">Ultimi annunci</option>
                        <option value="old">Annunci più vecchi</option>
                        <option value="expensive">Prezzo più alto</option>
                        <option value="chep">Prezzo più basso</option>
                    </select>
                </div>
                
            </div>
        </div>
        <div class="bg-light mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 border-bottom mb-3">
                    <h5>Risultati di ricerca: <span class="result-count small text-first">({{$ads->count()}})</span> </h5>
                
                </div>
                
                @foreach ($ads as $ad)
                <div class="col-12 col-md-6">
                    <a href="{{route('ads.show', compact('ad'))}}">
                        <div class="card mb-3 overflow-hidden">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="https://via.placeholder.com/300x300.png" class="card-img img-fluid" alt="...">
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