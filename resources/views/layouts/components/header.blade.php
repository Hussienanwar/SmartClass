<header>
    <div class="logo">
        <a href="#">
            <!-- <img src="./assets/image/logo/logo6.png" alt="" /> -->
        </a>
    </div>
    <nav>
        <ul>
            <li>
                <a href="#">
                    <i class="fa-regular fa-screen-users" title="Group"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-comment-lines" title="Chat"></i>
                </a>
            </li>
        </ul>
    </nav>
    <div class="login">
        <div class="in-image">
            @auth
            <img src="{{ Auth::user()->path }}" alt="" srcset="" />
            @endauth
        </div>
        <!-- <h3>BM7Shadow</h3> -->
    </div>
</header>
