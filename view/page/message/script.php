<script>
    $(document).ready(function() {
            displayCurrentTime(); // Hiển thị thời gian ngay khi bắt đầu cuộc trò chuyện

            // Xử lý gửi tin nhắn
            $('#messageForm').submit(function(e) {
                e.preventDefault();
                sendMessage(); // Gọi hàm sendMessage() khi gửi
            });

            function displayCurrentTime() {
                // Lấy thời gian hiện tại
                var currentDateTime = new Date();
                var options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                };
                var formattedDateTime = currentDateTime.toLocaleString('vi-VN', options); // Định dạng theo kiểu Việt Nam

                // Hiển thị thời gian ở giữa khung chat
                $('#chatTime').text(formattedDateTime).show(); // Hiện thời gian
            }

            function sendMessage() {
                var message = $('#messageInput').val();

                // Nếu không có tin nhắn
                if (!message) {
                    alert('Vui lòng nhập tin nhắn để gửi.');
                    return;
                }

                // Thêm tin nhắn vào khung chat
                $('#chatBox').append(
                    '<div class="chat-message sender">' +
                    '<div class="message-content">' + message + '</div>' +
                    '<img src="https://via.placeholder.com/40" class="avatar" alt="Avatar của người gửi">' +
                    '</div>'
                );

                // Xóa nội dung input
                $('#messageInput').val(''); // Xóa nội dung ô nhập
            }

        });
</script>