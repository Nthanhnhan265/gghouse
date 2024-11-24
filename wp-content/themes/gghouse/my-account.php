<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Plant Shop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .account-wrapper {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 300px;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
        }

        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .user-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .user-email {
            color: #666;
            margin-bottom: 20px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #f5f5f5;
        }

        .menu-item.active {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
        }

        .logout-btn {
            color: #d32f2f;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tabs {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 0;
            cursor: pointer;
            position: relative;
        }

        .tab.active {
            color: #2e7d32;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #2e7d32;
        }

        /* Profile Tab Content */
        .profile-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .update-btn {
            grid-column: span 2;
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
        }

        /* Orders Tab Content */
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-id {
            font-weight: bold;
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .order-status {
            color: #2e7d32;
        }

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .order-total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Wishlist Tab Content */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .wishlist-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .wishlist-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .wishlist-info {
            padding: 15px;
        }

        .wishlist-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .wishlist-price {
            color: #2e7d32;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .wishlist-actions {
            display: flex;
            gap: 10px;
        }

        .add-to-cart-btn {
            flex: 1;
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-wishlist-btn {
            width: 36px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .account-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .profile-form {
                grid-template-columns: 1fr;
            }

            .update-btn {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>
    <div class="container plant-account-page">
        <div class="account-wrapper">
            <!-- Sidebar -->
            <div class="sidebar plant-sidebar">
                <div class="user-info plant-user-info">
                    <div class="avatar-container">
                        <img src="https://via.placeholder.com/150" alt="Avatar" class="avatar">
                        <div class="avatar-upload">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <h2 class="user-name">Nguyễn Văn A</h2>
                    <p class="user-email">nguyenvana@email.com</p>
                </div>
                <div class="sidebar-menu">
                    <div class="menu-item active" data-tab="profile">
                        <i class="fas fa-user"></i>
                        Thông tin cá nhân
                    </div>
                    <div class="menu-item" data-tab="orders">
                        <i class="fas fa-box"></i>
                        Đơn hàng
                    </div>
                    <div class="menu-item" data-tab="wishlist">
                        <i class="fas fa-heart"></i>
                        Sản phẩm yêu thích
                    </div>
                    <div class="menu-item" data-tab="address">
                        <i class="fas fa-map-marker-alt"></i>
                        Địa chỉ
                    </div>
                    <div class="menu-item logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Đăng xuất
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content plant-main-content">
                <!-- Profile Tab -->
                <div class="tab-content active" id="profile">
                    <h2 class="tab-header">Thông tin cá nhân</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" name="full_name" value="<?php echo esc_attr($user_info->first_name); ?>" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="user_email" value="<?php echo esc_attr($user_info->user_email); ?>" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="tel" name="phone" value="<?php echo esc_attr(get_user_meta($user_info->ID, 'phone', true)); ?>" class="input-field">
                        </div>
                        <button type="submit" class="update-btn plant-btn">Cập nhật thông tin</button>
                        <?php wp_nonce_field('update_user_info', 'user_info_nonce'); ?>
                    </form>
                    <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                        <div class="updated-message">Thông tin của bạn đã được cập nhật thành công!</div>
                    <?php endif; ?>

                    <!-- Change Password Section -->
                    <h3 class="tab-subheader">Thay đổi mật khẩu</h3>
                    <form class="password-form plant-form">
                        <div class="form-group">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" placeholder="Nhập mật khẩu hiện tại" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" placeholder="Nhập mật khẩu mới" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Xác nhận mật khẩu mới</label>
                            <input type="password" placeholder="Nhập lại mật khẩu mới" class="input-field">
                        </div>
                        <button type="submit" class="update-btn plant-btn">Đổi mật khẩu</button>
                    </form>
                    <?php if (isset($_GET['password_updated']) && $_GET['password_updated'] == 'true') : ?>
                        <div class="success-message">Mật khẩu của bạn đã được thay đổi thành công!</div>
                    <?php endif; ?>
                </div>

                <!-- Orders Tab -->
                <div class="tab-content" id="orders" style="display: none;">
                    <h2 class="tab-header">Đơn hàng của tôi</h2>
                    <div class="order-card plant-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">#ORD001</div>
                                <div class="order-date">10/11/2024</div>
                            </div>
                            <div class="order-status">Đã giao hàng</div>
                        </div>
                        <div class="order-items">
                            <div class="order-item">
                                <span>Cây Trầu Bà x1</span>
                                <span>450,000đ</span>
                            </div>
                            <div class="order-item">
                                <span>Cây Kim Ngân x1</span>
                                <span>440,000đ</span>
                            </div>
                        </div>
                        <div class="order-total">
                            Tổng cộng: 890,000đ
                        </div>
                    </div>
                </div>

                <!-- Wishlist Tab -->
                <div class="tab-content" id="wishlist" style="display: none;">
                    <h2 class="tab-header">Sản phẩm yêu thích</h2>
                    <div class="wishlist-grid">
                        <div class="wishlist-item plant-wishlist-item">
                            <img src="https://via.placeholder.com/200" alt="Cây Trúc Nhật" class="wishlist-img">
                            <div class="wishlist-info">
                                <h3 class="wishlist-name">Cây Trúc Nhật</h3>
                                <div class="wishlist-price">380,000đ</div>
                                <div class="wishlist-actions">
                                    <button class="add-to-cart-btn plant-btn">Thêm vào giỏ</button>
                                    <button class="remove-wishlist-btn plant-btn secondary">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Tab -->
                <div class="tab-content" id="address" style="display: none;">
                    <h2 class="tab-header">Địa chỉ của tôi</h2>
                    <form class="address-form plant-form">
                        <div class="form-group">
                            <label>Địa chỉ 1</label>
                            <input type="text" placeholder="Nhập địa chỉ 1" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ 2</label>
                            <input type="text" placeholder="Nhập địa chỉ 2" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Thành phố</label>
                            <input type="text" placeholder="Nhập thành phố" class="input-field">
                        </div>
                        <div class="form-group">
                            <label>Mã bưu điện</label>
                            <input type="text" placeholder="Nhập mã bưu điện" class="input-field">
                        </div>
                        <button type="submit" class="update-btn plant-btn">Cập nhật địa chỉ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Tab switching functionality
        const menuItems = document.querySelectorAll('.menu-item');
        const tabContents = document.querySelectorAll('.tab-content');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                const tabName = item.getAttribute('data-tab');
                if (!tabName) return;

                // Update menu items
                menuItems.forEach(menuItem => {
                    menuItem.classList.remove('active');
                });
                item.classList.add('active');

                // Update tab contents
                tabContents.forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(tabName).style.display = 'block';
            });
        });

        // Profile form submission
        const profileForm = document.querySelector('.profile-form');
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Thông tin đã được cập nhật!');
        });

        // Avatar upload
        const avatarUpload = document.querySelector('.avatar-upload');
        avatarUpload.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        document.querySelector('.avatar').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            };
            input.click();
        });

        // Logout functionality
        const logoutBtn = document.querySelector('.logout-btn');
        logoutBtn.addEventListener('click', () => {
            if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
                // Add logout logic here
                alert('Đã đăng xuất!');
            }
        });
    </script>
</body>

</html>