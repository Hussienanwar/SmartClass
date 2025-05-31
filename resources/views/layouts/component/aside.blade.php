
<aside class="left-sidebar" data-sidebarbg="skin5">
    {{-- <center><h5>{{auth()->user()->name}}</a></h5></center> --}}
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                @if(isset($sidebarRooms) && $sidebarRooms->count())
                @foreach ($sidebarRooms as $room)
                @include('main.SubjectModals.add')
                {{-- href="{{route('room.show',$room->id)}} --}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">{{$room->name}}
                        </span>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#addsubject-{{$room->id}}">
                            <i class="fas fa-add"></i>
                        </button>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @foreach ($room->subjects as $subject)
                        <li class="sidebar-item">
                            <a href="" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span
                            class="hide-menu"> {{$subject->name}} </span></a>
                        </li>
                        @endforeach
                    </ul>
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
