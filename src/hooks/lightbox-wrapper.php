<?php

add_filter('render_block', 'wrap_in_lightbox', 10, 2);
function wrap_in_lightbox($block_content, $block)
{
    if ($block['blockName'] == 'core/image' && str_contains($block['attrs']['className'], 'bim-lightbox')) {
        $get_image_url = function ($id, $innerHTML) {
            if (!is_null($id)) {
                return wp_get_attachment_image_url($id, 'full');
            } else {
                $dom = new DOMDocument();
                $dom->loadHTML($innerHTML);

                $image = $dom->getElementsByTagName("img")->item(0);
                if (!is_null($image)) {
                    return $image->attributes->getNamedItem('src')->nodeValue;
                } else {
                    return null;
                }

            }
        };

        $url = $get_image_url($block['attrs']['id'], $block['innerHTML']);

        if (is_null($url)) {
            return $block_content;
        } else {
            return do_shortcode("[su_lightbox type='image' class='bim-lightbox-wrapper' src='$url']$block_content [/su_lightbox]");
        }
    } else {
        return $block_content;
    }
}
