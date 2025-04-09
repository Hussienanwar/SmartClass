<aside class="left-sidebar" data-sidebarbg="skin5">
    {{-- <center><h5>{{auth()->user()->name}}</a></h5></center> --}}
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                @if(isset($sidebarRooms) && $sidebarRooms->count())
                @foreach ($sidebarRooms as $room)
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('room.show',$room->id)}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">{{$room->name}}</span></a>
                </li>
                @endforeach
                @else
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('auth.google')}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Login</span></a>
                </li>
            @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
