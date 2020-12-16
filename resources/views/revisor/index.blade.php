<x-layout>
    @if ($ad)
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <div class="card border-0 shadow">
                    <div class="card-header text-center">
                        Annuncio # {{$ad->id}}
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center">{{$ad->title}}</h3>
                        <div class="row my-5">
                            <div class="col-12 col-md-6"><h5 class="font-weight-bold">Utente</h5><p class="card-text h4">{{$ad->user->name}}</p></div>
                            <div class="col-12 col-md-6"><h5 class="font-weight-bold">Email di contatto</h5><p class="card-text h4">{{$ad->user->email}}</p></div>
                        </div>
                        <div class="row my-5">
                            <div class="col-12 text-center">
                                <h4 class="font-weight-bold">Descrizione</h4>
                                <p class="card-text h4"> {{$ad->body}}</p>
                            </div>
                            
                        </div>
                        <div class="row mb-5">
                            @foreach ($ad->images as $image)
                            <div class="col-12 col-md-4 mt-5">
                                <img class="d-block img-fluid mx-2" src="{{$image->getUrl(400, 300)}}" alt="">
                                <ul class="my-4 list-unstyled">
                                    <h5 class="border-bottom mb-2 pb-2">Controllo contenuti</h5>
                                    <li>Adulti: {{$image->adult}}
                                        <div class="progress">
                                            <div class="progress-bar progress-{{$image->adult}}" role="progressbar" aria-valuenow="{{$image->adult}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li>Satira: {{$image->spoof}}
                                        <div class="progress">
                                            <div class="progress-bar progress-{{$image->spoof}}" role="progressbar" aria-valuenow="{{$image->spoof}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li>Medicina: {{$image->medical}}
                                        <div class="progress">
                                            <div class="progress-bar progress-{{$image->medical}}" role="progressbar" aria-valuenow="{{$image->medical}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li>Violenza: {{$image->violence}}
                                        <div class="progress">
                                            <div class="progress-bar progress-{{$image->violence}}" role="progressbar" aria-valuenow="{{$image->violence}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                    <li>Razzismo: {{$image->racy}}
                                        <div class="progress">
                                            <div class="progress-bar progress-{{$image->racy}}" role="progressbar" aria-valuenow="{{$image->racy}}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </li>
                                </ul>
                                <h6 class="border-bottom mb-2 pb-2">Keywords</h6>
                                <div class="d-flex flex-wrap">
                                    @if ($image->labels)
                                    @foreach ($image->labels as $label)
                                    <span class="d-flex bg-second shadow rounded card-text w-fit m-1 text-center">
                                        <small class="d-flex text-white px-2">{{$label}}</small>
                                    </span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <h5 class="font-weight-bold">Prezzo</h5>
                                <p class="card-text h4"> {{$ad->price}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button class="btn btn-success" data-toggle="modal" data-target="#Accept">Accetta</button>
                        
                        
                        <button class="btn btn-danger" data-toggle="modal" data-target="#Reject">Rifiuta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    {{-- Modale accetta --}}
    
    <div class="modal fade" id="Accept" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="AcceptLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AcceptLabel">Accetta annuncio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Sei sicuro di voler accettare?</h2>
                    <div class="row mt-3 mb-2">
                        <div class="col-6">
                            <form action="{{route('revisor.accept', $ad->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-success">Accetta</button>
                            </form>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non accettare</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    {{-- Modale Rifiuta --}}
    
    <div class="modal fade" id="Reject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="RejectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RejectLabel">Rifiuta annuncio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>Sei sicuro di voler rifiutare?</h2>
                    <div class="row mt-3 mb-2">
                        <div class="col-6">
                            <form action="{{route('revisor.reject', $ad->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-danger">Rifiuta</button>
                            </form>    
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non rifiutare</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @else
    <div class="container min-vh-100">
        <div class="row my-5">
            <div class="col-12"><h2 class="text-center"> Complimenti hai revisionato tutti gli annunci</h2></div>
        </div>
    </div>
    @endif
</x-layout>