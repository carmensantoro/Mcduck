<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                @if ($favorites->count() > 0)
                
                @foreach ($favorites as $favorite)
                <a href="{{route('ads.show', ['ad' => $favorite])}}">
                    <div class="card mb-3 overflow-hidden">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if(count($favorite->images) > 0)
                                <img src="{{$favorite->images->first()->getUrl(400, 300)}}" class="card-img img-fluid" alt="..."> 
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <span class="small d-block text-right">{{__('ui.CreatedOn')}}{{$favorite->created_at->format('d/m/Y')}}</span>
                                    <h5 class="card-title mb-0">{{$favorite->title}}</h5>
                                    <p class="card-text"><small class="text-muted">{{$favorite->category()->get()->implode('name', ' ')}}</small></p>
                                    <h3>{{$favorite->price}} €</h3>
                                    <p class="card-text text-truncate">{{$favorite->body}}</p>
                                    <p>{{__('ui.UploadBy')}}{{$favorite->user()->get()->implode('name', '')}}</p>            
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                
                @else

                <h2 class="text-center"> Non hai Preferiti </h2>
                
                @endif
            </div>
        </div>
    </div>
</x-layout>