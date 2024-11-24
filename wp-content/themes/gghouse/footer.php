<?php
// Footer Section Start
?>

<footer class="site-footer">
    <div class="footer-pattern">
        <div class="pattern-overlay"></div>
    </div>

    <div class="footer-container reveal-footer">
        <div class="footer-main">
            <div class="footer-brand fade-in">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h2 class="glow-text">' . get_bloginfo('name') . '</h2>';
                }
                ?>
                <p class="brand-description slide-up">
                    Không đơn thuần là cửa hàng cây xanh, ra đời với mong muốn là điểm nối của mỗi người với thiên nhiên
                    bằng những sản phẩm chất lượng, sáng tạo, thuần Việt.
                </p>
                <div class="social-links">
                    <a href="#" class="hover-float" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span class="social-hover"></span>
                    </a>
                    <a href="#" class="hover-float" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                        <span class="social-hover"></span>
                    </a>
                    <a href="#" class="hover-float" aria-label="Youtube">
                        <i class="fab fa-youtube"></i>
                        <span class="social-hover"></span>
                    </a>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-nav fade-in">
                    <h3 class="glow-text">Điều Hướng</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'menu_class' => 'footer-menu',
                        'container' => false,
                    ));
                    ?>
                </div>

                <div class="footer-contact fade-in">
                    <h3 class="glow-text">Liên Hệ</h3>
                    <ul class="contact-list">
                        <li class="slide-right">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Đường XYZ, Thành phố ABC</span>
                        </li>
                        <li class="slide-right">
                            <i class="fas fa-phone"></i>
                            <span>(+84) 123 456 789</span>
                        </li>
                        <li class="slide-right">
                            <i class="fas fa-envelope"></i>
                            <span>contact@gghouse.com</span>
                        </li>
                        <li class="slide-right">
                            <i class="fas fa-clock"></i>
                            <span>8:00 - 22:00 (Thứ 2 - Chủ nhật)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom fade-in">
            <p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideRight {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes glowPulse {
        0% {
            text-shadow: 0 0 5px rgba(44, 62, 80, 0.1);
        }

        50% {
            text-shadow: 0 0 20px rgba(44, 62, 80, 0.3);
        }

        100% {
            text-shadow: 0 0 5px rgba(44, 62, 80, 0.1);
        }
    }


    .site-footer {
        margin-top: -2px;
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 60px 0 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;
        color: #333;
        overflow: hidden;
        z-index: 4;
    }

    .footer-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.5;
        background:
            linear-gradient(45deg, transparent 49%, rgba(44, 62, 80, 0.05) 50%, transparent 51%),
            linear-gradient(-45deg, transparent 49%, rgba(44, 62, 80, 0.05) 50%, transparent 51%);
        background-size: 20px 20px;
    }

    .pattern-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(248, 249, 250, 0.9) 100%);
    }

    .footer-container {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .reveal-footer {
        opacity: 0;
        animation: fadeIn 1s ease forwards;
    }

    .fade-in {
        opacity: 0;
        animation: fadeIn 1s ease forwards 0.3s;
    }

    .slide-up {
        opacity: 0;
        animation: slideUp 1s ease forwards 0.5s;
    }

    .slide-right {
        opacity: 0;
        animation: slideRight 0.8s ease forwards;
    }

    .footer-main {
        display: flex;
        gap: 60px;
        margin-bottom: 40px;
    }

    /* Brand Section */
    .footer-brand {
        flex: 0 0 35%;
    }

    .glow-text {
        margin: 0 0 20px;
        font-size: 24px;
        color: #2c3e50;
        animation: glowPulse 3s infinite;
    }

    .brand-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .social-links {
        display: flex;
        gap: 15px;
    }

    .social-links a {
        position: relative;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        color: #2c3e50;
        text-decoration: none;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .hover-float {
        transition: transform 0.3s ease;
    }

    .hover-float:hover {
        transform: translateY(-5px);
    }

    .social-hover {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(44, 62, 80, 0.1);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.5s ease;
    }

    .social-links a:hover .social-hover {
        width: 150%;
        height: 150%;
    }

    /* Links Section */
    .footer-links {
        flex: 1;
        display: flex;
        gap: 60px;
    }

    .footer-nav,
    .footer-contact {
        flex: 1;
    }

    /* Navigation Menu */
    .footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-menu li {
        margin-bottom: 12px;
        transition: transform 0.3s ease;
    }

    .footer-menu a {
        color: #666;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .footer-menu a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #2c3e50;
        transition: width 0.3s ease;
    }

    .footer-menu a:hover::after {
        width: 100%;
    }

    /* Contact List */
    .contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        color: #666;
        transition: transform 0.3s ease;
    }

    .contact-list li:hover {
        transform: translateX(5px);
    }

    .contact-list i {
        margin-right: 12px;
        color: #2c3e50;
        font-size: 16px;
        margin-top: 4px;
        transition: transform 0.3s ease;
    }

    .contact-list li:hover i {
        transform: scale(1.2);
    }

    /* Footer Bottom */
    .footer-bottom {
        text-align: center;
        padding: 20px 0;
        border-top: 1px solid rgba(44, 62, 80, 0.1);
        color: #666;
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(5px);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .footer-main {
            flex-direction: column;
            gap: 40px;
        }

        .footer-brand {
            flex: 0 0 100%;
        }

        .footer-links {
            flex-direction: column;
            gap: 30px;
        }
    }

    @media (max-width: 768px) {
        .site-footer {
            padding: 40px 0 0;
        }

        .contact-list li:nth-child(1) {
            animation-delay: 0.2s;
        }

        .contact-list li:nth-child(2) {
            animation-delay: 0.4s;
        }

        .contact-list li:nth-child(3) {
            animation-delay: 0.6s;
        }

        .contact-list li:nth-child(4) {
            animation-delay: 0.8s;
        }
    }

    /* Custom Logo */
    .custom-logo {
        max-height: 60px;
        width: auto;
        margin-bottom: 20px;
        transition: filter 0.3s ease;
    }

    .custom-logo:hover {
        filter: brightness(1.1);
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });

        document.querySelectorAll('.slide-right').forEach(element => {
            observer.observe(element);
            element.style.animationPlayState = 'paused';
        });
    });
</script>
</body>

</html>