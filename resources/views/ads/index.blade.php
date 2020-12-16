<x-layout>
    <main>
    <div class="container-home rounded mt-5">
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
    
    <div class="container my-5">
        <div class="row border-bottom mb-3 pb-2 align-items-end">

            <div class="col-12 col-md-12 text-right">
                

                <form action="{{route('ads.index', $categoryid)}}" method="GET">  
                @csrf
                <input name="category" type="hidden" value="{{$category}}"> 
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
            <div class="col-12 col-md-6 position-relative">
                <div class="heart-ads"> 
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
                                <img src="{{$ad->images->first()->getUrl(400, 300)}}" class="card-img card-img-custom" alt="..."> 
                                @endif

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{$ad->title}}</h5>
                                    <p class="card-text"><small class="text-muted">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                                    <p class="card-text">
                                    <p class="card-text text-truncate">{{$ad->body}}</p>
                                    <h5 class="text-right">{{$ad->price}} €</h5>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach  
        </div>
        <div class="row">
        <div class="col-12 d-flex justify-content-end">{{$ads->links()}}</div>
        </div>
    </div>

</x-layout>