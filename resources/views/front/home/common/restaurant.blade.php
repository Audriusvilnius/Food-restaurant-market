@inject('restaurant', 'App\Services\RestaurantService')

<ul class="navbar-nav  ">
    <div class="row ">
        <li class="nav-item">
            <a id="navbarDropdown" class="btn btn-secondary dropdown-toggle bg-dark text-white container-fluid " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="width: 100%; z-index: 1;">Restaurants</a>
            <div class="dropdown-menu dropdown-menu-end bg-dark text-white container-fluid " aria-labelledby="navbarDropdown">
                @forelse($restaurant->getService() as $restaurant)
                <div class=" card-body ">

                    <a class="list-group-item list-group-item-action " href="{{route('list-restaurant',$restaurant)}}">{{$restaurant->title}}</a>
                    {{-- {{$restaurant->food_Restaurant()->count()}} --}}

                </div>
                @empty
                <h3 class="list-group-item">List empty</h3>
                @endforelse
            </div>
        </li>
    </div>
</ul>
