@inject('category', 'App\Services\CategoryService')
<section class="container shadow_new">
    <h3 class="mb-4 text-start"><i>Categories<i></h3>
    <hr class=" border border-second border-1 opacity-75">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-7 g-3">
        @forelse($category->getCategory() as $category)
        <div class="col d-flex justify-content-md-between">
            <div class="card g-0 shadow bg-body-tertiary rounded col d-flex justify-content-md-between">
                <div class="col-md-12 container_pic">
                    <a class="list-group-item list-group-item-action" href="{{route('list-category',$category->id)}}">
                        <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">

                        <div class="centered shadow_new justify-content-center">
                            <h1 class="shadow_new"><b><i>{{$category->title}}</i></b></h1>
                            <h4 class="shadow_new"><b><i>{{$category->food_Category()->count()}} dishes</i></b></h4>
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
{{-- <hr class=" border border-second border-1 opacity-75"> --}}
