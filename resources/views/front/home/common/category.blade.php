@inject('category', 'App\Services\CategoryService')
<section class="container shadow_new">
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 row-cols-xxl-7 g-3">
        @forelse($categories as $category)
        <div id="{{ $category['id'] }}" class="col d-flex justify-content-md-between">
            <div class="card g-0 shadow bg-body-tertiary rounded col d-flex justify-content-md-between">
                <div class="col-md-12 container_pic">
                    <img src="{{asset($category->photo)}}" class="img-fluid rounded" alt="imageset">
                    <div class="centered shadow_new justify-content-center">
                        <h1><b><i>{{$category->title}}</i></b></h1>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <h2 class="list-group-item">List empty</h2>
        @endforelse
    </div>
    <hr class=" border border-second border-1 opacity-75">
</section>
