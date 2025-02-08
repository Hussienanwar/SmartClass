<div class="head-mai">
    <div class="nam-adt">
        <h2>Group</h2>
        <ul>
            <li class="ad-et"><i class="fa-solid fa-hexagon-plus"></i></li>
            <li class="ad-et">
                <i class="fa-sharp fa-regular fa-pen-to-square newChat"></i>
            </li>
            <div class="chat-box">
                <h1>New Chat</h1>
                <div class="chat-content">
                    <form action="{{route('room.store')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="path" class="form-control" id="exampleFormControlInput1" placeholder="Name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                    <form action="{{route('room.join')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="code" class="form-control" id="exampleFormControlInput1" placeholder="Name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </ul>
    </div>
    <div class="search">
        <input type="text" placeholder="Search" />
        <i class="fa-sharp fa-solid fa-magnifying-glass fa-rotate-90"></i>
    </div>
</div>
