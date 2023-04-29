@inject('category', 'App\Services\CategoryService')
<section class="container shadow_new ">
    <div class="container-fluid pt-4 pb-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel">
                    @foreach($category->getCategory() as $category)
                    <div class="item">
                        <div class="card ">
                            <a class="list-group-item list-group-item-action" href="{{route('list-category',$category->id)}}">
                                <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="{{$category->title}}">
                                <div class="card-body centered shadow_new">
                                    <h1 class="shadow_new"><b><i>{{$category->title}}</i></b></h1>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true
            , nav: true
            , margin: 10
            , responsive: {
                0: {
                    items: 2
                }
                , 576: {
                    items: 2
                }
                , 768: {
                    items: 3
                }
                , 992: {
                    items: 4
                }
                , 1200: {
                    items: 5
                }
            }
        });

    </script>
</section>




{{-- <section class="container shadow_new ">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-7 g-3">
        @forelse($category->getCategory() as $category)
        <div class="col d-flex justify-content-md-between">
            <div class="card g-0 shadow bg-body-tertiary rounded">
                <div class="col-md-12 container_pic">
                    <a class="list-group-item list-group-item-action" href="{{route('list-category',$category->id)}}">
<img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">
<div class="centered shadow_new justify-content-center">
    <h1 class="shadow_new"><b><i>{{$category->title}}</i></b></h1> --}}
    {{-- <h4 class="shadow_new"><b><i>{{$category->food_Category()->count()}} dishes</i></b></h4> --}}
    {{-- </div>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <h2 class="list-group-item">List empty</h2>
        @endforelse
    </div>
</section> --}}
    {{-- <hr class=" border border-second border-1 opacity-75"> --}}
