@inject('category', 'App\Services\CategoryService')
<section class="container ">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme">
                    @forelse($category->getCategory() as $category)
                    <div class="item">
                        <div class="card ">
                            <a class="list-group-item list-group-item-action" href="{{route('list-category',$category->id)}}">
                                <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="{{$category->title}}">
                                <div class="card-body centered ">
                                    <h3 class="shadow_new text-body-secondary"><b><i>{{$category->title}}</i></b></h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                    <h5>Oops! Something went wrong, missing category info</h5>
                    @endforelse
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
            , autoplayTimeout: 5000
            , autoplayHoverPause: true
            , navText: [
                    `<div class="nav-btn prev-slide"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" /></svg></div>`
                    , `<div class="nav-btn next-slide"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16"><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                </svg></div>`
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
