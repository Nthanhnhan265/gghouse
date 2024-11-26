<?php get_header(); ?>
    <style>
        .contact-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-header h1 {
            color: #2e7d32;
            font-size: 36px;
            margin-bottom: 15px;
        }

        .contact-header p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contact-info {
            background-color: #f5f5f5;
            padding: 30px;
            border-radius: 8px;
        }

        .contact-info h3 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .info-item i {
            color: #2e7d32;
            margin-right: 15px;
            font-size: 20px;
        }

        .info-item div {
            color: #333;
            line-height: 1.6;
        }

        .contact-form {
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .contact-form h3 {
            color: #2e7d32;
            margin-bottom: 20px;
        }

        /* Tùy chỉnh style cho Contact Form 7 */
        .wpcf7-form label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .wpcf7-form input[type="text"],
        .wpcf7-form input[type="email"],
        .wpcf7-form input[type="tel"],
        .wpcf7-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .wpcf7-form textarea {
            height: 150px;
        }

        .wpcf7-submit {
            background-color: #2e7d32;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .wpcf7-submit:hover {
            background-color: #1b5e20;
        }

        /* Style cho bản đồ */
        .map-container {
            margin-top: 40px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="contact-page">
        <div class="contact-header">
            <h1>Liên Hệ Với Chúng Tôi</h1>
            <p>Hãy liên hệ với chúng tôi để được tư vấn về các loại cây cảnh và dịch vụ chăm sóc cây</p>
        </div>

        <div class="contact-container">
            <div class="contact-info">
                <h3>Thông Tin Liên Hệ</h3>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Địa chỉ:</strong><br>
                        123 Đường ABC, Quận XYZ<br>
                        Thành phố HCM, Việt Nam
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Điện thoại:</strong><br>
                        0123.456.789
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email:</strong><br>
                        info@webcaycanh.com
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Giờ làm việc:</strong><br>
                        Thứ 2 - Chủ nhật: 8:00 - 20:00
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Gửi Thông Tin</h3>
                <?php echo do_shortcode('[contact-form-7 id="19c0bb7" title="Contact form 1"]'); ?>
            </div>
        </div>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=YOUR_GOOGLE_MAPS_EMBED_URL" allowfullscreen></iframe>
        </div>
    </div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
