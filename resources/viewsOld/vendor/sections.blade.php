<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li>
            <a href="{{route('vendor.dashboard')}}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> {{__('section.dashboard')}} </span>
            </a>
        </li>
        <li>
            <a href="{{route('vendor.products')}}">
                <i class=" fab fa-product-hunt"></i>
                <span> {{__('section.products')}} </span>
            </a>
        </li>

        <li>
            <a href="{{route('vendor.myOrders')}}" >
                <i class="mdi mdi-cart-outline"></i>
                <span> {{__('section.my_orders')}} </span>
            </a>
        </li>

        <li>
            <div class="cart-nav">
                <div class="icon">
                  {{-- <i class="fas fa-shopping-cart"></i> --}}
                  {{-- <span>Cart</span> --}}
                </div>
                {{-- <div class="item-count1">0</div> --}}
              </div>
            <a href="{{route('vendor.myWishlist')}}" class="cart-nav1">
                <span class="badge badge-pill badge-primary float-right item-count">0</span>
                <i class="mdi mdi-heart"></i>
                <span> {{__('section.my_Wishlist')}} </span>
            </a>
        </li>

        <li>
            <a href="{{route('vendor.transaction',['vendor_id'=>Auth::guard('vendor')->user()->id,'admin'=>0])}}">
                <i class="fa fa-coins"></i>
                <span> {{__('section.transactions')}}</span>
            </a>
        </li>

        <li>
            <a href="{{route('vendor.ticket.index')}}">
                <i class="mdi mdi-comment-question"></i>
                <span>{{__('section.allTickets')}}</span>
            </a>
        </li>

        <li>
            <a href="{{route('vendor.ticket.create')}}">
                <i class="mdi mdi-comment-question"></i>
                <span>{{__('section.openTickets')}} </span>
            </a>
        </li>

        <li>
            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                <i class="fas fa-language"></i>
                <span> العربية </span>
            </a>

        </li>
        <li>
            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                <i class="fas fa-language"></i>
                <span> English </span>
            </a>

        </li>
    </ul>
</div>
