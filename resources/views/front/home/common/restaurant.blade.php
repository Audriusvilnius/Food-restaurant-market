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
            , autoplayTimeout: 15000
            , smartSpeed: 6000
            , autoplayHoverPause: true
            , navText: [
                `<div class="nav-btn prev-slide mt-3"><i class="bi bi-chevron-compact-left"></i></div>`
                , `<div class="nav-btn next-slide mt-3"><i class="bi bi-chevron-compact-right"></i></div>`
            ]
            , responsive: {
                0: {
                    items: 2
                }
                , 540: {
                    items: 2
                }
                , 720: {
                    items: 3
                }
                , 960: {
                    items: 5
                }
                , 1440: {
                    items: 5
                }
            }
        });
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [15000])

        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })

    </script>
</section>
