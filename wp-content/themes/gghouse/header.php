<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />
    <title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <nav class="nav-container">
            <div class="logo-container">
                <a href="<?php echo home_url(); ?>" class="logo">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<span class="logo-text">Logo</span>';
                    }
                    ?>
                </a>
            </div>

            <div class="hamburger" aria-label="Menu">
                <div class="hamburger__lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
            </div>

            <div class="nav-links">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'nav-menu',
                    'items_wrap' => '<ul class="nav-menu">%3$s</ul>'
                ));
                ?>
            </div>
        </nav>

        <!-- Progress bar for scroll -->
        <div class="scroll-progress"></div>
    </header>

    <style>
        /* Header Styling */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        /* Navigation Container */
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            /* Align logo to the left and menu to the right */
            align-items: center;
            /* Center items vertically */
        }

        /* Logo Styling */
        .logo-container {
            flex: 1;
            /* Allows the logo container to take available space on the left */
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .logo:hover {
            color: #4CAF50;
        }

        .logo-text {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Navigation Menu */
        .nav__link {
            display: flex;
            gap: 1.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav__link ul {
            display: flex;
            flex-direction: row;
        }

        .nav__link a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease, background-color 0.3s ease;
            border-radius: 5px;
        }

        .nav__link a:hover {
            color: #4CAF50;
            background-color: rgba(76, 175, 80, 0.1);
        }

        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(to right, #4CAF50, #7bc97f);
            width: 0%;
            z-index: 1000;
            transition: width 0.2s ease;
        }

        /* Hamburger Menu */
        .hamburger {
            display: none;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 100;
        }

        .hamburger__lines {
            width: 28px;
            height: 20px;
            position: relative;
        }

        .line {
            position: absolute;
            height: 2px;
            width: 100%;
            background: #333;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .line1 {
            top: 0;
        }

        .line2 {
            top: 50%;
            transform: translateY(-50%);
        }

        .line3 {
            bottom: 0;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 100%;
                height: 100vh;
                background: rgba(255, 255, 255, 0.98);
                display: flex;
                justify-content: center;
                align-items: center;
                transition: right 0.3s ease;
            }

            .nav-menu {
                flex-direction: column;
                gap: 1.5rem;
            }

            .nav-links.active {
                right: 0;
            }

            .hamburger.active .line1 {
                transform: rotate(45deg) translate(4px, 4px);
            }

            .hamburger.active .line2 {
                opacity: 0;
            }

            .hamburger.active .line3 {
                transform: rotate(-45deg) translate(6px, -6px);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');
            const progress = document.querySelector('.scroll-progress');

            // Toggle mobile menu
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navLinks.classList.toggle('active');
                document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
            });

            // Scroll progress bar update
            window.addEventListener('scroll', () => {
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (window.scrollY / height) * 100;
                progress.style.width = scrolled + "%";
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>

</html>