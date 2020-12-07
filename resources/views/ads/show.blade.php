<x-layout>
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <img src="https://via.placeholder.com/300x150.png" class="card-img img-fluid" alt="...">
            </div>
            <div class="col-12 col-md-6">
                <span> Annuncio creato il: {{$ad->created_at->format('d/m/Y')}}</span>
                <h5 class="card-title">{{$ad->title}}</h5>
                <p class="card-text"><small class="text-muted">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                <h3>{{$ad->price}}</h3>
                <p class="card-text">{{$ad->body}}</p>
            </div>

        </div>
    </x-layout>