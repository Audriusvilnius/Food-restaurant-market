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
                                <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="{{$category->title_en}}">
                                <div class="card-body centered ">

                                    @if (app()->getLocale()=="lt")
                                    <h3 class="shadow_new"><b><i>{{$category->title_lt}}</i></b></h3>
                                    @else
                                    <h3 class="shadow_new"><b><i>{{$category->title_en}}</i></b></h3>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                    @empty
                    <h5>Oops! Something went wrong, missing category info</h5>
                    <h2 class="list-group-item">{{__('List empty')  }}</h2>
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
            , autoplayTimeout: 10000
            , autoplayHoverPause: true
            , smartSpeed: 6000
            , navText: [
                `<div class="nav-btn prev-slide"><i class="bi bi-chevron-compact-left"></i></div>`
                , `<div class="nav-btn next-slide"><i class="bi bi-chevron-compact-right"></i></div>`
            ]
            , responsive: {
                0: {
                    items: 3
                }
                , 540: {
                    items: 3
                }
                , 720: {
                    items: 5
                }
                , 960: {
                    items: 5
                }
                , 1440: {
                    items: 7
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
