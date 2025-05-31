<div class="modal fade" id="doctor-{{ $room->id }}" tabindex="-1" aria-labelledby="joinRoomLabel-{{ $room->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title d-flex align-items-center" id="joinRoomLabel-{{ $room->id }}">
                    <i class="fas fa-door-open me-2"></i> Doctor 
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="border-0 shadow-sm rounded-4 p-4 mb-3">
                    <h4 class="text-center text-warning fw-bold mb-4">🔍 Enter Doctor Email</h4>
                    <form action="{{ route('subjects.doctor', ['room'=>$room->id,'subject'=>$subject->id]) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="input-group has-validation">
                            <input type="text" name="email"
                                class="form-control rounded-start"
                                placeholder="Enter doctor email"
                                required>
                            <button type="submit" class="btn btn-success rounded-end px-4">
                                <i class="fas fa-sign-in-alt me-1"></i> save
                            </button>
                        </div>
                        <div class="invalid-feedback mt-2">
                            Please enter your attendance email.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
