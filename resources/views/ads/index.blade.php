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
        <div class="row">
            
            @foreach ($ads as $ad)
            <div class="col-12 col-md-6">
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