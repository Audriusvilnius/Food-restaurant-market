<section class="page conteiner-blue pb-3">
    <div class="container ">
        <div class="row d-flex justify-content-evenly">
            <div class="col-md-5">
                <form class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-10" role="search" action="{{url('/')}}" method="get">
                    <div class="card-body align-content-center gap-3 d-flex mb-2">
                        <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="{{__('Search...')  }}  " aria-label="Search" name="s" value="{{$s}}">
                        <button type="submit" class="btn btn-info"><i class="bi bi-search" style="font-size: 1rem"> </i></button>
                    </div>
                </form>
            </div>

            {{-- <div class="col-md-1 "> --}}
            {{-- <form action="{{url('/')}}" method="get">
            <select class="form-select form-select bg-dark text-white mb-2" name="restaurant_id">
                <option value="all">{{__('All Cities')  }}</option>
                @foreach($restaurants as $restaurant)
                <option value="{{$restaurant->id}}" @if($restaurant->id == $cityShow) selected @endif>{{$restaurant->city}}</option>
                @endforeach
            </select> --}}
            {{-- </div> --}}
            <div class="col-md-auto ">
                <form action="{{url('/')}}" method="get">
                    <select class="form-select form-select bg-dark text-white mb-2" name="restaurant_id">
                        <option value="all">{{__('All Restaurants')  }}</option>
                        @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}" @if($restaurant->id == $typeShow) selected @endif>{{$restaurant->title}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-md-auto btnsort">
                <div class="card-body align-content-center mb-2">
                    <select class="form-select bg-dark text-white " name="sort">
                        <option>{{__('Sort')  }}</option>
                        @if (app()->getLocale() == 'lt')
                            @foreach($sortSelect_lt as $value => $name)
                                <option value="{{$value}}" @if($sortShow_lt==$value) selected @endif>{{$name}}</option>
                            @endforeach
                        @else
                            @foreach($sortSelect as $value => $name)
                                <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-auto ">
                <div class="card-body align-content-center d-flex mb-2">
                    <select class="form-select bg-dark text-white d-flex" name="per_page">
                        @if (app()->getLocale() == 'lt')
                            @foreach($perPageSelect_lt as $value)
                                <option value="{{$value}}" @if($perPageShow_lt==$value) selected @endif>{{$value}}</option>
                            @endforeach
                        @else
                            @foreach($perPageSelect as $value)
                                <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                             @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-2">

                <div class="card-body align-content-end gap-1 d-flex justify-content-end">


                    <button type="submit" class="btn btn-secondary ">{{__('SHOW')  }}</button>

                    </form>
                    <a href=" {{url('/')}}" class="btn btn-danger " style="">{{__('RESET')  }}</a>
                </div>
            </div>
        </div>
    </div>
    <hr class="border border-second border-0 opacity-50">
</section>
