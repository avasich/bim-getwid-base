<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package getwid_base
 */

?>

</div><!-- #content -->

<?php
get_sidebar();
?>
<footer id="colophon" class="site-footer">
    <?php

    $show_site_info = (bool) get_theme_mod('getwid_base_show_footer_text', true);
    if ($show_site_info) :
    ?>
        <div class="site-info">
            <?php
            $dateObj           = new DateTime;
            $current_year      = $dateObj->format("Y");
            $site_info         = get_theme_mod('getwid_base_footer_text', false) ? get_theme_mod('getwid_base_footer_text') : "";

            echo wp_kses_post(
                sprintf(
                    $site_info,
                    $current_year,
                    get_bloginfo('name')
                )
            );
            ?>
        </div>
    <?php
    endif;
    ?>
</footer><!-- #colophon --></div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>