<section class="section breadcrumb-section header-bredcrumb bg-first">
    <div class="container d-flex flex-wrap">
      <h2 class="breadcrumb-section-title w-100 text-left">{{$title}}</h2>
      <!-- Breadcrumb-->
      <div class="breadcrumb">
        <div class="breadcrumb-inner">
          <div class="breadcrumb-item"><a class="breadcrumb-link" href="{{route('home')}}">Home</a></div>
          {{-- <div class="breadcrumb-item"><a class="breadcrumb-link" href="{{route($routesection)}}">{{$section}}</a></div> --}}
          {{-- @if (isset($title)) --}}
          {{-- <div class="breadcrumb-item"><span class="breadcrumb-text breadcrumb-active">{{$title}}</span></div> --}}
          {{-- @endif --}}
        </div>
      </div>
    </div>
</section>