<?php
/*
 *	This is the archive page for the top sections with a boxed style.
 */


//Get the Knowledge Base object
$bpkb_knowledge_base = basepress_kb();
$bpkb_sidebar_position = basepress_sidebar_position(true);
$bpkb_show_sidebar = is_active_sidebar('basepress-sidebar') && $bpkb_sidebar_position != 'none';
$bpkb_content_classes = $bpkb_show_sidebar ? ' show-sidebar' : '';

$intro_page = do_shortcode(do_blocks(get_page_by_path('bim')->post_content));
$page_separator = "<div hidden>!break-page-here!</div>";
$page_parts = explode($page_separator, $intro_page);

//Get active theme header
basepress_get_header('basepress');
?>

<!-- Main BasePress wrap -->
<div class="bpress-wrap">
    <div class="bpress-content-area bpress-float-<?php echo esc_attr($bpkb_sidebar_position) . esc_attr($bpkb_content_classes); ?>">

        <!-- Add main content -->
        <main class="bpress-main" role="main">
            <div class="bim-front-page-content-wrapper">
                <?php
                if (count($page_parts) > 0) {
                    echo $page_parts[0];
                }
                ?>
            </div>

            <div class="bim-front-page-content-wrapper">
                <?php basepress_get_template_part('sections-content-boxed'); ?>
            </div>
            <div class="bim-front-page-content-wrapper">
                <?php
                if (count($page_parts) > 1) {
                    echo $page_parts[1];
                }
                ?>
            </div>
        </main>
        <?php
        if (count($page_parts) > 2) {
            echo $page_parts[2];
        }
        ?>
    </div><!-- content area -->

    <!-- Sidebar -->
    <?php if ($bpkb_show_sidebar) : ?>
        <aside class="bpress-sidebar bpress-float-<?php echo esc_attr($bpkb_sidebar_position); ?>" role="complementary">
            <div class="hide-scrollbars">
                <?php dynamic_sidebar('basepress-sidebar'); ?>
            </div>
        </aside>
    <?php endif; ?>

</div><!-- wrap -->
<?php basepress_get_footer('basepress'); ?>