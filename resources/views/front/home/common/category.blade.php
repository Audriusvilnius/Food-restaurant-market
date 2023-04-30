@inject('category', 'App\Services\CategoryService')

<section class="container shadow_new">
    <h3 class="mb-4 text-start"><i>{{__('Categories')  }}<i></h3>
    <hr class=" border border-second border-1 opacity-75">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-7 g-3">
        @forelse($category->getCategory() as $category)
        <div class="col d-flex justify-content-md-between">
            <div class="card g-0 shadow bg-body-tertiary rounded col d-flex justify-content-md-between">
                <div class="col-md-12 container_pic">
                    <a class="list-group-item list-group-item-action" href="{{route('list-category',$category->id)}}">
                        <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">

                        <div class="centered shadow_new justify-content-center">
                            @if (app()->getLocale() == "lt") 
                                <h1 class="shadow_new"><b><i>{{$category->title_lt}}</i></b></h1>
                            @else
                            <h1 class="shadow_new"><b><i>{{$category->title}}</i></b></h1>
                            @endif
                            <h4 class="shadow_new"><b><i>{{$category->food_Category()->count()}} dishes</i></b></h4>

                        </div>
                    </div>
                    @empty
                    <h5>Oops! Something went wrong, missing category info</h5>
                    @endforelse
                </div>
            </div>
        </div>

        @empty
        <h2 class="list-group-item">{{__('List empty')  }}</h2>
        @endforelse

    </div>

    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true
            , nav: true
            , margin: 10
            , autoplay: true
            , autoplayTimeout: 5000
            , autoplayHoverPause: true
            , navText: [
                    `<div class="nav-btn prev-slide"><i class="bi bi-chevron-compact-left"></i></div>`
                    , `<div class="nav-btn next-slide"><i class="bi bi-chevron-compact-right"></i></div>`
                ]

            , responsive: {
                0: {
                    items: 3
                }
                , 576: {
                    items: 3
                }
                , 768: {
                    items: 5
                }
                , 992: {
                    items: 5
                }
                , 1200: {
                    items: 7
                }
            }
        });
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [1000])
        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })

    </script>
</section>
