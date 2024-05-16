@extends(layout('dashboard').'default-without-nav')

@section('title') @lang('admin.auth.login.title') | {{ config('app.name', 'Laravel') }} @endsection

@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">

                        <div class="card-body">

                            <div class="text-center p-3">

                                <div class="img">
                                    <img src="/images/error-img.png" class="img-fluid" alt="">
                                </div>

                                <h1 class="error-page mt-5"><span>404!</span></h1>
                                <h4 class="mb-4 mt-5">Sorry, page not found</h4>
                                <a class="btn btn-primary mb-4 "
                                   href="{{ route('home') }}"><i
                                        class="mdi mdi-home"></i> Back to Home</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
