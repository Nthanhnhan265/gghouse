    <?php
    // Footer Section Start
    ?>
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-widgets">
                <div class="footer-widget">
                    <!-- Widget 1: About Us or Information -->
                    <h3>About Us</h3>
                    <p>Chúng tôi cung cấp cây cảnh và chậu kiểng đẹp cho không gian sống của bạn.</p>
                </div>

                <div class="footer-widget">
                    <!-- Widget 2: Menu Links -->
                    <h3>Menu</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu', // Bạn cần đăng ký menu cho footer trong functions.php
                        'menu_class' => 'footer-menu',
                        'container' => false,
                    ));
                    ?>
                </div>

                <div class="footer-widget">
                    <!-- Widget 3: Contact Information -->
                    <h3>Contact Us</h3>
                    <p>Địa chỉ: 123 Đường XYZ, Thành phố ABC</p>
                    <p>Phone: (+84) 123 456 789</p>
                    <p>Email: contact@gghouse.com</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> GGHouse. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <?php
    ?>
    </footer>
    <?php wp_footer(); ?>
    </body>

    </html>