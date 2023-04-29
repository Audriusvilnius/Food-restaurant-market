@inject('restaurant', 'App\Services\RestaurantService')
<section class="container  ">
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme">
                    @foreach($restaurant->getService() as $restaurant)
                    <div class="item">
                        <div class="card ">
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
            , margin: 10
            , autoplay: true
            , autoplayTimeout: 3000
            , autoplayHoverPause: true
            , navText: [
                    `<div class="nav-btn prev-slide"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" /></svg></div>`
                    , `<div class="nav-btn next-slide"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                </svg></div>`
                ]

            , responsive: {
                0: {
                    items: 1
                }
                , 576: {
                    items: 1
                }
                , 768: {
                    items: 2
                }
                , 992: {
                    items: 3
                }
                , 1200: {
                    items: 4
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
