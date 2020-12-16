<x-layout>
    <section class="bg-white pt-5">
        <div class="container">
            <div class="row">
                @foreach ($ads as $ad)
                <div class="col-12">
                    <a href="{{route('ads.show', compact('ad'))}}">
                        <div class="card mb-2 overflow-hidden">
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
                    <div class="row mb-5 justify-content-end">
                        <div class="col-6 col-md-2 text-right">
                            <a class="btn-custom rounded" href="{{route('ads.edit', compact('ad'))}}">Modifica</a>
                        </div>
                        <div class="col-6 col-md-2">
                            <form action="{{route('ads.delete', compact('ad'))}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn-danger rounded p-2">Elimina l'annuncio</button>
                            </form>
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
</x-layout>