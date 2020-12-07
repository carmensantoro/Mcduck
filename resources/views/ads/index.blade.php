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
            <div class="card mb-3 overflow-hidden" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="https://via.placeholder.com/300x150.png" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$ad->title}}</h5>
                            <p class="card-text">{{$ad->body}}</p>
                            <p class="card-text"><small class="text-muted">Creato il: {{$ad->created_at->format('d/m/Y')}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endforeach  
        </div>
    </div>
</x-layout>