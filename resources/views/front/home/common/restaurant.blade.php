@inject('restaurant', 'App\Services\RestaurantService')
<section class="container  ">
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme">
                    @foreach($restaurant->getService() as $restaurant)
                    <div class="item">
                        <div class="card">
                            <a class="list-group-item list-group-item-action" href="{{route('list-restaurant',$restaurant)}}">
                                <img src="{{asset($restaurant->photo)}}" class="img-fluid rounded-top" alt="{{$restaurant->title}}">
                                <p class="fw-lighter text-start text-body-secondary m-1 ms-3"><i><b>{{$restaurant->title}}</b></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @empty
                <h3 class="list-group-item">{{__('List empty')  }}</h3>
                @endforelse

            </div>
        </div>
    </div>
    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true
            , nav: true
            , margin: 20
            , autoplay: true
            , autoplayTimeout: 3000
            , autoplayHoverPause: true
            , navText: [
                    `<div class="nav-btn prev-slide mt-3"><i class="bi bi-chevron-compact-left"></i></div>`
                    , `<div class="nav-btn next-slide mt-3"><i class="bi bi-chevron-compact-right"></i></div>`
                ]

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
                    items: 5
                }
                , 1200: {
                    items: 5
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
