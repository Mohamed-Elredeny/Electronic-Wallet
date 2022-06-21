<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li>
            <a href="{{route('supporter.dashboard')}}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span> {{__('section.profile')}} </span>
            </a>
        </li>
       
        <li>
            <a href="{{route('supporter.ticket.index')}}">
                <i class="mdi mdi-comment-question"></i>
                <span>{{__('section.allTickets')}}</span>
            </a>
        </li>

        <li>
            <a href="{{route('supporter.ticket.create')}}">
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
