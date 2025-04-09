<div class="modal fade" id="joinroom" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Join Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{route('room.join')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- Code Field -->
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 text-end control-label col-form-label">Room Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="Name" placeholder="Name Here" name="code" />
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="border-top">
                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
