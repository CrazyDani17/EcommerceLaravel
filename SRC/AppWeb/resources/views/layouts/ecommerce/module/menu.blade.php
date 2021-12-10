<ul class="nav navbar-nav center_nav pull-right">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('front.index') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.product') }}">Products</a>
    </li>
    <li class="nav-item">
        <form style="margin-top: 1.5em;" action="{{route('front.search_with_button')}}" method="POST">
        @csrf
            <div class="input-group">
                <input name="item" type="text" size="50" class="form-control" id="search" placeholder="What would  you like to buy?">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </li>
</ul>