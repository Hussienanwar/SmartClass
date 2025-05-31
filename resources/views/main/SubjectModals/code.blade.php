<div class="modal fade" id="code" tabindex="-1" aria-labelledby="joinRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title d-flex align-items-center" id="joinRoomLabel">
                    <i class="fas fa-door-open me-2"></i> Room Code
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Room Code with Copy -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-key me-1 text-muted"></i> Room Code
                    </label>
                    <div class="input-group">
                        <span class="form-control bg-light" id="roomCodeDisplay">{{ $room->code }}</span>
                        <button type="button" class="btn btn-outline-success" id="copyBtn"
                            data-code="{{ $room->code }}" title="Copy">
                            <i class="fas fa-copy" id="copyIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- QR Code Display -->
                <div class="text-center my-3 qr-code-wrapper">
                    {!! $roomQrCode !!}
                </div>

                <!-- Download QR Button -->
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-outline-success" id="downloadBtn">
                        <i class="fas fa-download me-1"></i> Download QR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // === Copy Room Code ===
        const copyBtn = document.getElementById('copyBtn');
        const copyIcon = document.getElementById('copyIcon');

        if (copyBtn) {
            copyBtn.addEventListener('click', function () {
                const code = this.getAttribute('data-code');

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(code).then(showCopiedIcon).catch(fallbackCopy);
                } else {
                    fallbackCopy();
                }

                function fallbackCopy() {
                    const textarea = document.createElement('textarea');
                    textarea.value = code;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    showCopiedIcon();
                }

                function showCopiedIcon() {
                    copyIcon.classList.replace('fa-copy', 'fa-check');
                    setTimeout(() => {
                        copyIcon.classList.replace('fa-check', 'fa-copy');
                    }, 1500);
                }
            });
        }

        // === Download QR Code ===
        const downloadBtn = document.getElementById('downloadBtn');

        if (downloadBtn) {
            downloadBtn.addEventListener('click', function () {
                const svg = document.querySelector('.qr-code-wrapper svg');
                if (!svg) {
                    alert("QR code not found!");
                    return;
                }

                const serializer = new XMLSerializer();
                const svgData = serializer.serializeToString(svg);
                const blob = new Blob([svgData], { type: 'image/svg+xml' });
                const url = URL.createObjectURL(blob);

                const link = document.createElement('a');
                link.href = url;
                link.download = 'room-qr.svg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
            });
        }
    });
</script>
