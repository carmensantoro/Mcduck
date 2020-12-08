<x-layout>

    <div class="container-home mt-5">
            
        <div class="row text-center">
            
            @foreach ($categories as $category)
            
            <div class="col-6 col-md-3">
            <a href="{{route('ads.index', compact('category'))}}">{{$category->name}}</a>
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
</x-layout>