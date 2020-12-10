<x-layout>
    <x-header
    title='{{$ad->title}}'
    />
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-12 col-md-6 position-relative">
                <div class="product-img-detail w-100">
                    <img src="/media/car1.jpeg" class="img-fluid" alt="">
                    <img src="/media/car2.jpeg" class="img-fluid" alt="">
                    <img src="/media/car3.jpeg" class="img-fluid" alt="">
                    <img src="/media/car4.jpeg" class="img-fluid" alt="">
                </div>
                
                <div class="product-img-nav pt-2">
                    <img src="/media/car1.jpeg" class="img-fluid mx-2" alt="">
                    <img src="/media/car2.jpeg" class="img-fluid mx-2" alt="">
                    <img src="/media/car3.jpeg" class="img-fluid mx-2" alt="">
                    <img src="/media/car4.jpeg" class="img-fluid mx-2" alt="">
                    
                </div>
                
            </div>
            
            
            
            <div class="col-12 col-md-6">
                <span class="small"> Annuncio creato il: {{$ad->created_at->format('d/m/Y')}}</span>
                <h1 class="card-title">{{$ad->title}}</h1>
                <p class="bg-second shadow rounded card-text w-fit px-2 "><small class="text-white">{{$ad->category()->get()->implode('name', ' ')}}</small></p>
                <h3>{{$ad->price}} €</h3>
                <p class="card-text">{{$ad->body}}</p>
                <p>Caricato da: {{$ad->user()->get()->implode('name', '')}}</p>
            </div>
            
        </div>
    </div>
</x-layout>