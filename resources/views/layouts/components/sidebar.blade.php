<div class="content-groups">
    <ul class="Groups-card">
        @auth
            @foreach (Auth::user()->rooms as $room)
                    <li class="cd-group">
                        <div class="image">
                            <img src="{{asset('storage/'.$room->path)}}" alt="" class="photo" />
                        </div>
                        <div class="text">
                            <a href="{{route('room.index',['id'=>$room->id])}}">
                                <h3>{{$room->name}}</h3>
                            </a>
                        </div>
                        <div class="date">
                            <p>{{$room->code}}</p>
                        </div>
                    </li>
            @endforeach
        @endauth
        @guest
            <a href="{{ route('auth.google') }}">google</a>
        @endguest
    </ul>
</div>
