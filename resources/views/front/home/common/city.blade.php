@inject('city', 'App\Services\CityService')

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


        @endforeach
    </select>
    <div class="card-body d-flex">
        <div class="list-table__buttons ms-3">
            <button type="submit" class="btn btn-info">OK</button>
        </div>

        @empty
        <h2 class="list-group-item">{{__('List empty')  }}</h2>
        @endforelse

    </div>
    @csrf
    @method('post')
</form>
