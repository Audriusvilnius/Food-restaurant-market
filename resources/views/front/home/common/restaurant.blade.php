@inject('restaurant', 'App\Services\RestaurantService')
<section class="container shadow_new ">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-7 g-3">
        @forelse($restaurant->getService() as $restaurant)
        <div class="col d-flex justify-content-md-between">
            <div class="card g-0 shadow bg-body-tertiary rounded">
                <div class="col-md-12 container_pic">
                    <a class="list-group-item list-group-item-action" href="{{route('list-restaurant',$restaurant)}}">
                        <img src="{{asset($restaurant->photo)}}" class="img-fluid rounded" alt="imageset">
                        <div class="centered shadow_new justify-content-center">
                            <h4 class="shadow_new"><b><i>{{$restaurant->title}}</i></b></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <h2 class="list-group-item">List empty</h2>
        @endforelse
    </div>
</section>


{{-- <div id="carouselExampleControls" class="carousel container shadow_new " data-bs-ride="carousel">
    <div class="carousel-inner">
        @forelse($restaurant->getService() as $key =>$restaurant)
        <div @if($key==0)class="carousel-item active" @else class="carousel-item" @endif>
            <div class="col d-flex justify-content-md-between">
                <div class="card g-0 shadow bg-body-tertiary rounded">
                    <div class="col-md-12 container_pic">
                        <a class="list-group-item list-group-item-action" href="{{route('list-restaurant',$restaurant)}}">
<img src="{{asset($restaurant->photo)}}" class="img-fluid rounded" alt="imageset">
<div class="centered shadow_new justify-content-center">
    <h3 class="shadow_new"><b><i>{{$restaurant->title}}</i></b></h3>
</div>
</a>
</div>
</div>
</div>
</div>
@empty
<h2 class="list-group-item">List empty</h2>
@endforelse
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>

</div> --}}
