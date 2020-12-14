<x-layout>
    
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
            <form id="formOPD" action="{{route('revisor.request')}}" method="POST" class="card p-5 border-0 shadow">
                    @csrf

                    <h2>Richiesta per Revisore</h2>

                    <div class="row my-5">
                        <div class="col-12 col-md-6"><h5 class="font-weight-bold">Utente</h5><p class="mb-0 text-secondary h4">{{$user->name}}</p></div>
                        <div class="col-12 col-md-6"><h5 class="font-weight-bold">Email di contatto</h5><p class="mb-0 text-secondary h4">{{$user->email}}</p></div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="motivation_revisor" class="mb-0 text-secondary font-weight-bold">Perchè vuoi unirti a noi?</label>
                        <textarea name="motivation_revisor" id="motivation_revisor" class="form-control rounded font-weight-bold" rows="10"></textarea>
                    </div>
                    <div class="custom-control custom-radio custom-checkbox mb-4">
                        <input required type="checkbox" class="custom-control-input" id="privacy">
                        <label class="custom-control-label text-secondary font-italic" for="privacy">Accetto termini e condizioni</label>
                    </div>
                    
                    <div class="row justify-content-end">
                        <div class="col-3">
                    
                    <button type="submit" class="btn btn-newAd text-center rounded w-100"><i class="fas fa-chevron-right"></i>  Invia</button>
                    </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</x-layout>