<?php echo 'Test file override';
?>
<div class="order-tracking-container">
    <h2>Theo dõi đơn hàng của bạn</h2>
    <p>Nhập mã đơn hàng và email để kiểm tra trạng thái.</p>

    <form class="tracking-form" method="post">
        <div class="form-group">
            <label for="orderid">Mã đơn hàng</label>
            <input type="text" name="orderid" id="orderid" placeholder="Nhập mã đơn hàng" required>
        </div>
        <div class="form-group">
            <label for="order_email">Email</label>
            <input type="email" name="order_email" id="order_email" placeholder="Nhập email đặt hàng" required>
        </div>
        <button type="submit" class="btn-submit">Theo dõi</button>
    </form>

    <?php if ($order): ?>
        <div class="order-details">
            <h3>Chi tiết đơn hàng</h3>
            <ul>
                <li><strong>Trạng thái:</strong> <?php echo esc_html($order->get_status()); ?></li>
                <li><strong>Ngày đặt hàng:</strong> <?php echo esc_html($order->get_date_created()->date('d/m/Y')); ?></li>
                <li><strong>Sản phẩm:</strong></li>
                <li><strong>Trạng thái:</strong>
                    <i class="fa fa-leaf" style="color: green;"></i>
                    <?php echo esc_html($order->get_status()); ?>
                </li>

                <ul>
                    <?php foreach ($order->get_items() as $item): ?>
                        <li><?php echo esc_html($item->get_name()); ?> (x<?php echo esc_html($item->get_quantity()); ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </ul>
        </div>
    <?php endif; ?>
</div>
<style>
    .order-tracking-container {
        background-color: #f8f9f5;
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
    }

    .order-tracking-container h2 {
        color: #2d572c;
        text-align: center;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .order-tracking-container p {
        text-align: center;
        color: #555;
    }

    .tracking-form {
        margin-top: 15px;
    }

    .tracking-form .form-group {
        margin-bottom: 15px;
    }

    .tracking-form label {
        display: block;
        font-weight: bold;
        color: #2d572c;
        margin-bottom: 5px;
    }

    .tracking-form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .tracking-form .btn-submit {
        width: 100%;
        background-color: #2d572c;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .tracking-form .btn-submit:hover {
        background-color: #236022;
    }

    .order-details {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
    }

    .order-details h3 {
        color: #2d572c;
        margin-bottom: 10px;
    }

    .order-details ul {
        list-style: none;
        padding: 0;
    }

    .order-details li {
        margin-bottom: 5px;
    }
</style>