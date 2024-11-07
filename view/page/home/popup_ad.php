
    <!-- Modal -->
    <div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h3 class="modal-title fs-3" id="newsletterModalLabel">Đăng ký thành viên để nhận thêm nhiều ưu đãi!</h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Đăng ký để nhận cập nhật về các sản phẩm mới và nhận 25% giảm giá.</p>
                    <div class="mb-3">
                    <label for="emailInput" class="form-label">Email của bạn</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="Nhập email của bạn">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary active">Đăng Ký</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        session_start();

        if (isset($_SESSION['success_message'])) {
            echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var myModal = new bootstrap.Modal(document.getElementById('newsletterModal'));
                    myModal.show();
                }, 2000);
            });
        </script>
        ";
            unset($_SESSION['success_message']); 
        }
    ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newsletterModal">
    Launch demo modal
    </button>