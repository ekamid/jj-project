    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100%">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Profile
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Orders
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark">
                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    Request
                </a>
            </li>
        </ul>
        <hr>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger w-100" type="submit">
                Sign Out
            </button>
        </form>
    </div>
