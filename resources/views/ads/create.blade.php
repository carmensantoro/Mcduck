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
            <form class="col-12" action="{{route('ads.store')}}" method="POST">
                @csrf
                <input type="hidden" name="uniqueSecret" value="{{ $uniqueSecret }}">
                
                <div class="form-group">
                    <label class="font-weight-bold" for="title_ad">Titolo</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control rounded" id="title_ad" aria-describedby="emailHelp">
                </div>
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold" for="description_ad">Descrizione</label>
                    <textarea name="body" id="description_ad" class="form-control rounded" rows="10">{{old('body')}}</textarea>
                </div>
                
                @error('body')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <label class="font-weight-bold" for="category_id">Categoria</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option selected value="">Seleziona una categoria</option>
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
                        <input type="number" name="price" step='.01' value="{{old('price') ?? 0.00}}" class="form-control rounded" id="price">
                        @error('price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="images" class="col-12 col-form-label font-weight-bold mt-3">Immagini</label>
                    <div class="col-12">
                        <div class="dropzone" id="drophere"></div>
                        @error('images')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-custom rounded ml-auto">Inserisci</button>
            </form>
        </div>
    </div>
    
</x-layout>