<script>
    function showDetail(title, content, timeCreate) {
        const detailDiv = document.getElementById('notification-detail');
        if (detailDiv) {
            detailDiv.innerHTML = `
            <div class="d-flex align-items-center fs-5 fw-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
                </svg>&nbsp; ${title}
            </div>
            <div class="d-flex align-items-center my-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                </svg>&nbsp; ${timeCreate}
            </div>
            <div class="d-flex align-items-center my-2">
                ${content}
            </div>
        `;
        } else {
            console.error("Không tìm thấy phần tử #notification-detail");
        }
    }

    function updateStatusNotification(status, notificationId) {
        // Lấy userId từ session PHP
        const userId = <?= json_encode($_SESSION['user_id']); ?>;

        // Gửi yêu cầu AJAX đến server
        fetch('controller/Notification/UpdateNotificationController.php', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    notification_id: notificationId,
                    status: status,
                    userId: userId
                }),
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json(); // Phản hồi từ server sẽ được xử lý ở đây
            })
            .then((data) => {
                if (data.success) {
                    // Nếu cập nhật thành công, thay đổi giao diện
                    document.querySelector(`#notification-${notificationId}`).classList.add('text-muted'); // Chuyển sang trạng thái đã đọc
                    console.log(data.message);
                } else {
                    console.error(data.message); // Nếu không thành công, in ra thông báo lỗi
                }
            })
            .catch((error) => {
                console.error("Error:", error); // In lỗi nếu có sự cố trong quá trình gửi request
            });
    }
</script>