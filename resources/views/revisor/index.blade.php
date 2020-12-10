<x-layout>
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        Annuncio # {{$ad->id}}
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">{{$ad->title}}</h3>
                        <div class="row my-5">
                            <div class="col-12 col-md-6"><h5 class="font-weight-bold">Utente</h5><p class="card-text h4">{{$ad->user->name}}</p></div>
                            <div class="col-12 col-md-6"><h5 class="font-weight-bold">Email di contatto</h5><p class="card-text h4">{{$ad->user->email}}</p></div>
                        </div>
                        <div class="row text-center my-5">
                            <div class="col-12">
                                <h4 class="font-weight-bold">Descrizione</h4>
                                <p class="card-text h4"> {{$ad->body}}</p>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-12 col-md-4">
                                <img class="d-block mx-auto" src="https://via.placeholder.com/300x150.png" alt="">
                            </div>
                            <div class="col-12 col-md-4">
                                <img class="d-block mx-auto" src="https://via.placeholder.com/300x150.png" alt="">
                            </div>
                            <div class="col-12 col-md-4">
                                <img class="d-block mx-auto" src="https://via.placeholder.com/300x150.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <form action="{{route('revisor.accept', $ad->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-success">Accetta</button>
                        </form>
                        <form action="{{route('revisor.reject', $ad->id)}}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Rifiuta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>