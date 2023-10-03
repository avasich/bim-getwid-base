<?php

function get_image_url($innerHTML): ?string
{
    $dom = new DOMDocument();
    @$dom->loadHTML($innerHTML);

    return $dom
        ->getElementsByTagName("img")
        ->item(0)
        ?->attributes
        ?->getNamedItem("src")
        ?->nodeValue;
}


add_filter('render_block', 'wrap_in_lightbox', 10, 2);
function wrap_in_lightbox($block_content, $block)
{
    if ($block['blockName'] != 'core/image') {
        return $block_content;
    }

    $is_lightbox = isset($block['attrs']['className']) && str_contains($block['attrs']['className'], 'bim-lightbox');

    if (!$is_lightbox) {
        return $block_content;
    }

    $url = isset($block['attrs']['id'])
        ? wp_get_attachment_image_url($block['attrs']['id'], 'full')
        : get_image_url($block['innerHTML']);

    if (is_null($url) && $url !== false) {
        return $block_content;
    } else {
        return do_shortcode("[su_lightbox type='image' class='bim-lightbox-wrapper' src='$url'] $block_content [/su_lightbox]");
    }
}
