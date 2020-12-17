<x-layout>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
            </div>
        </div>   
        <div class="row">
            <form class="col-12" action="{{route('ads.update', compact('ad'))}}" method="POST" id="EditForm">
                @method('PUT')
                @csrf
                <input type="hidden" name="uniqueSecret" value="{{ $uniqueSecret }}">
                
                <div class="form-group">
                    <label class="font-weight-bold" for="title_ad">Titolo</label>
                    <input type="text" name="title" value="{{$ad->title}}" class="form-control rounded" id="title_ad" aria-describedby="emailHelp">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold" for="description_ad">Descrizione</label>
                    <textarea name="body" id="description_ad" class="form-control rounded" rows="10">{{$ad->body}}</textarea>
                </div>
                
                @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <label class="font-weight-bold" for="category_id">Categoria</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option selected value="{{$ad->category->id}}">{{$ad->category->name}}</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="font-weight-bold" for="price">Prezzo</label>
                        <input type="number" name="price" step='.01' value="{{$ad->price}}" class="form-control rounded" id="price">
                        @error('price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="images" class="col-12 col-form-label font-weight-bold mt-3">Immagini</label>
                    <div class="col-12 mt-4">
                        <div class="dropzone" id="drophere"></div>
                        @error('images')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
            <div class="form-group row w-100">
                @foreach ($ad->images as $image)
                <div class="col-12 col-md-4" id="id{{$image->id}}">
                    <img class="d-block img-fluid my-2 mx-auto" src="{{$image->getUrl(300, 150)}}" alt="">
                    
                    
                    
                    {{-- <form action="{{route('image.delete', compact('image'))}}" method="POST" id="img{{$image->id}}">
                        @method('DELETE')
                        @csrf
                        <button form="img{{$image->id}}" class="btn">Elimina</button>
                    </form> --}}
                    
                    <button onclick="deleteImg({{$image->id}})">Elimina</button>
                </div>
                @endforeach
            </div>
            <div class="row w-100">
                <div class="col-12 text-right">
                    
                    <button type="submit" form="EditForm" class="btn btn-custom rounded ml-auto">Modifica</button>   
                </div></div>
            </div>
        </div>
        {{-- <script>
            function deleteImg($image){
                axios.delete(`/image/delete/${$image}`)
                .then(function (response) {
                    document.getElementById(`id${$image}`).classList.add('d-none');
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            } 
        </script> --}}
    </x-layout>