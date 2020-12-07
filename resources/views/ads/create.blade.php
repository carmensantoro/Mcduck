<x-layout>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <form class="col-12" action="{{route('ads.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title_ad">Titolo</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title_ad" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="description_ad">Descrizione</label>
                    <textarea name="body" id="description_ad" class="form-control" rows="10">{{old('body')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">seleziona una categoria</label>
                    <select class="form-control" name="category" id="category" valu>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="number" name="price" step='.01' value="{{old('price') ?? 0.00}}" class="form-control" id="price">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
</x-layout>