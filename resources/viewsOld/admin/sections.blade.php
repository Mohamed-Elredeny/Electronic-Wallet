 <div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Dashboard</li>

        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-users"></i>
                <span> {{__('admin/section.Vendors')}} </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('admin.vendor.index')}}">{{__('admin/section.viewAll')}}</a></li>
                <li><a href="{{route('admin.vendor.create')}}">{{__('admin/section.addNew')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-users"></i>
                <span> {{__('admin/section.Support')}} </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('admin.supporter.index')}}">{{__('admin/section.viewAll')}}</a></li>
                <li><a href="{{route('admin.supporter.create')}}">{{__('admin/section.addNew')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-users"></i>
                <span> {{__('admin/section.Categories')}} </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('admin.category.index')}}">{{__('admin/section.viewAll')}}</a></li>
                <li><a href="{{route('admin.category.create')}}">{{__('admin/section.addNew')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-school"></i>
                <span> {{__('admin/section.Products')}} </span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('admin.product.index')}}">{{__('admin/section.sold_products')}}</a></li>
                <li><a href="{{route('admin.product.available')}}">{{__('admin/section.available_products')}}</a></li>
                <li><a href="{{route('admin.product.create')}}">{{__('admin/section.addNew')}}</a></li>
            </ul>
        </li>

        <li>
            <a href="{{route('admin.transaction',['vendor_id'=>1,'admin'=>1])}}">
                <i class="fa fa-coins"></i>
                <span> {{__('admin/section.Transactions')}}</span>
            </a>
        </li>

        <li>
            <a href="{{route('view.notifications',['type'=>'vendor','id'=>1])}}">
                <i class="fa fa-coins"></i>
                <span> {{__('admin/section.Notifications')}}</span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.ticket.index')}}">
                <i class="mdi mdi-comment-question"></i>
                <span>{{__('admin/section.allTickets')}} </span>
            </a>
        </li>

        <li>
            <a href="{{route('admin.ticket.create')}}">
                <i class="mdi mdi-comment-question"></i>
                <span>{{__('admin/section.openTickets')}} </span>
            </a>
        </li>



        <li>
            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                <i class="fas fa-language"></i>
                <span> Arabic </span>
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
