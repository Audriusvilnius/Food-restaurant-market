<section id="alert" class="text-center fixed-top m-2 conteiner">
    <div class="col-lg-12 mx-auto d-flex justify-content-center align-content-center">
        @if(Session::has('ok'))
        <h6 class="alert alert-success alert-dismissible fade show border border-dark border-2 position-fixed message" role="alert">{{Session::get('ok')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
        @endif
        @if(Session::has('not'))
        <h6 class="alert alert-danger alert-dismissible text-dark fade show border border-dark border-2 position-fixed message" role="alert">{{Session::get('not')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
        @endif
    </div>
</section>
