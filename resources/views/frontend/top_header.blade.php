<div class="header-top-w3layouts">
    <div class="container">
        <div class="col-md-6 logo-w3">
            <a href="{{ url('/') }}"><img src="{{ asset('frontend/images/logo2.png') }}" alt=" ">
                <h1>Apurba Jewellers</h1>
            </a>
        </div>
        <div class="col-md-6 phone-w3l">
            <ul class="right-nav">
                <li>
                    <a class="btn btn-primary" href="{{ route('frontend.find_stores') }}">
                        Find Stores
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </button>
                    </form>

                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
