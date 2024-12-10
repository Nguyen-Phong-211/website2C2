<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hủy đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('https://th.bing.com/th?id=OIP.cO9Kjmz3ZH1ZXq2OuPXcdQHaEK&w=333&h=187&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2') no-repeat center center / cover; 
            /* Thay ảnh chổ url này nha fen*/
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff; 
        }
        .container {
            background: rgba(0, 0, 0, 0.5);
            padding: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            transition: background-color 0.3s;
        }
        h1 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 24px;
        }
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 18px;
            margin-bottom: 8px;
        }
        input {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #218838;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
        }
        button {
            background-color: #218838;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #1e7e34; 
        }
        .image-container img {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
        }
        .divider {
            width: 100%;
            height: 1px;
            background-color: #28a745; 
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <div class="image-container">
            <img src="https://th.bing.com/th?id=OIP.YdIeiZ23qPtA8cOH3LlP4AHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Hủy đơn hàng">
        </div> -->
        <h1>Hủy Đơn Hàng</h1>
        <div class="divider"></div>
        <form action="cancel_order.php" method="POST">
            <label for="order_number">Mã đơn hàng:</label>
            <input type="text" id="order_number" name="order_number" placeholder="Nhập mã đơn hàng" required>
            <button type="submit">Hủy Đơn</button>
        </form>
    </div>
</body>
</html>
