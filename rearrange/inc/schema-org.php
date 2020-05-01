<?php

/*---------------------------------------------------------------------------
 * schema.org
 *---------------------------------------------------------------------------
global $rearrange, $post, $authordata;

$logo = '';
if ( has_site_icon() ) {
    $logo = get_site_icon_url();
} else {
    $logo = get_theme_file_uri( '/images/site-icon.png' );
}

$publisher = [
    '@context'    => 'http://schema.org',
    '@type'       => 'Organization',
    'name'        => $rearrange['site_name'],
    'description' => $rearrange['site_description'],
    'logo'        => [
        '@type'  => 'ImageObject',
        'url'    => $logo
    ]
];

$rearrange['schema_org'][] = [
    '@context'  => 'http://schema.org',
    '@type'     => 'WebSite',
    'name'      => $rearrange['site_name'],
    'url'       => $rearrange['home_url'],
    'publisher' => $publisher
];

if ( is_singular() ) {
    $url = '';
    if ( isset( $rearrange['page_url'] ) ) {
        $url = $rearrange['page_url'];
    } else {
        $url = get_permalink();
    }
    $author = get_userdata( $authordata->ID );

    if ( false !== strpos( $rearrange['thumbnail_url'], '/wp-content/uploads/' ) ) {
        $thumbsize = rearrange_getimagesize( $rearrange['thumbnail_url'] );
        // $thumbsize = getimagesize( $rearrange['thumbnail_url'] );
        $width = $thumbsize[0];
        $height = $thumbsize[1];
    } else {
        $width = 368;
        $height = 234;
    }

    $rearrange['schema_org'][] = [

        '@context'         => 'http://schema.org',
        '@type'            => 'Article',
        'mainEntityOfPage' => [
            '@type'  => 'WebPage',
            '@id'    => $url
        ],
        'headline'         => $post->post_title,
        'datePublished'    => $rearrange['datePublished'],
        'dateModified'     => $rearrange['dateModified'],
        'author'           => [
            '@type'  => 'Person',
            'name'   => $author->nickname
        ],
        'text'             => wp_strip_all_tags( $post->post_content ),
        'description'      => $post->post_excerpt,
        'image'            => [
            '@type'  => 'ImageObject',
            'url'    => $rearrange['thumbnail_url'],
            'width'  => $width,
            'height' => $height
        ],
        'publisher'        => $publisher
    ];
}
?>

<script type="application/ld+json">
    <?php echo json_encode( $rearrange['schema_org'] ); ?>
</script>
*/
