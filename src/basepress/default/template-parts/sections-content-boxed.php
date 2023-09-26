<?php
/*
 *	This template lists all top sections with a boxed style
 *
 */

//Get the sections object
$bpkb_sections = basepress_sections();

?>
<div class="bim-grid bim-grid-<?php basepress_section_cols(); ?>">

    <?php
    //We can iterate through the sections
    foreach ($bpkb_sections as $bpkb_section) :
    ?>

        <div class="bim-grid-col bim-grid-col-<?php basepress_section_cols(); ?>">
            <a class="bim-card" href="<?php echo esc_url($bpkb_section->permalink); ?>">
                <!-- Section Title -->
                <h3 class="bim-card-title"><?php echo esc_html($bpkb_section->name); ?></h3>

                <!-- Section Description -->
                <?php if ($bpkb_section->description) { ?>
                    <p class="bim-card-description"><?php echo wp_kses_post($bpkb_section->description); ?></p>
                <?php } else { ?>
                    <p class="bim-card-description"></p>
                <?php } ?>
                <!-- Section View All -->
                <span class="bim-card-viewall">
                    <?php basepress_section_view_all($bpkb_section->posts_count); ?>
                </span>
            </a><!-- End Section -->
        </div><!-- End col -->

    <?php endforeach; ?>

</div><!-- End grid -->