<?php

/**
 * tp_white（背景なし ホワイト）
 * round（カラーラウンド背景）
 */
 
global $rearrange;

if ( false === $rearrange['social_share']['show_bottom'] ) {
    return;
}


$transparent = '';
$svg_class = '';
$color = '';
$icon_round = '';

switch ( $rearrange['social_share']['color'] ) {
    case 'tp_white':
        $transparent = 'transparent';
        $color = 'white';
        break;
    case 'round':
        $icon_round = 'icon-round';
        $color = 'color';
        $svg_class = 'social-icon-white';
        break;
    default:
        $transparent = 'transparent';
        $color = 'white';
        break;
}
$title = urlencode( get_the_title() );
$url = urlencode( get_permalink() );
?>

<div class="social-share-wrap bottom">
    <ul class="social-share">
        <?php if ( isset( $rearrange['social_share']['show_buttons']['facebook'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> facebook">
                <a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$url; ?>" target="_blank" rel="noopener noreferrer" class="facebook-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="facebook-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="facebook-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id=facebook-share-icon-bottom>Facebook icon</title><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['twitter'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> twitter">
                <a href="<?php echo 'https://twitter.com/intent/tweet?text='.$title.'&url='.$url; ?>" target="_blank" rel="noopener noreferrer" class="twitter-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="twitter-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="twitter-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="twitter-share-icon-bottom">Twitter icon</title><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['hatena'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> hatena">
                <a href="<?php echo 'https://b.hatena.ne.jp/add?mode=confirm&url='.$url; ?>" target="_blank" rel="noopener noreferrer" class="hatena-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="hatena-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="hatena-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="hatena-share-icon-bottom">Hatena Bookmark icon</title><path d="M20.47 0C22.42 0 24 1.58 24 3.53v16.94c0 1.95-1.58 3.53-3.53 3.53H3.53C1.58 24 0 22.42 0 20.47V3.53C0 1.58 1.58 0 3.53 0h16.94zm-3.705 14.47c-.78 0-1.41.63-1.41 1.41s.63 1.414 1.41 1.414 1.41-.645 1.41-1.425-.63-1.41-1.41-1.41zM8.61 17.247c1.2 0 2.056-.042 2.58-.12.526-.084.976-.222 1.32-.412.45-.232.78-.564 1.02-.99s.36-.915.36-1.48c0-.78-.21-1.403-.63-1.87-.42-.48-.99-.734-1.74-.794.66-.18 1.156-.45 1.456-.81.315-.344.465-.824.465-1.424 0-.48-.103-.885-.3-1.26-.21-.36-.493-.645-.883-.87-.345-.195-.735-.315-1.215-.405-.464-.074-1.29-.12-2.474-.12H5.654v10.486H8.61zm.736-4.185c.705 0 1.185.088 1.44.262.27.18.39.495.39.93 0 .405-.135.69-.42.855-.27.18-.765.254-1.44.254H8.31v-2.297h1.05zm8.656.706v-7.06h-2.46v7.06H18zM8.925 9.08c.71 0 1.185.08 1.432.24.245.16.367.435.367.83 0 .38-.13.646-.39.804-.265.154-.747.232-1.452.232h-.57V9.08h.615z"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['googleplus'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> googleplus">
                <a href="<?php echo 'https://plus.google.com/share?url='.$url; ?>" target="_blank" rel="noopener noreferrer" class="googleplus-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="googleplus-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="googleplus-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="googleplus-share-icon-bottom">Google+ icon</title><path d="M7.635 10.909v2.619h4.335c-.173 1.125-1.31 3.295-4.331 3.295-2.604 0-4.731-2.16-4.731-4.823 0-2.662 2.122-4.822 4.728-4.822 1.485 0 2.479.633 3.045 1.178l2.073-1.994c-1.33-1.245-3.056-1.995-5.115-1.995C3.412 4.365 0 7.785 0 12s3.414 7.635 7.635 7.635c4.41 0 7.332-3.098 7.332-7.461 0-.501-.054-.885-.12-1.265H7.635zm16.365 0h-2.183V8.726h-2.183v2.183h-2.182v2.181h2.184v2.184h2.189V13.09H24"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['pocket'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> pocket">
                <a href="<?php echo 'https://getpocket.com/edit?url='.$url; ?>" target="_blank" rel="noopener noreferrer" class="pocket-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="pocket-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="pocket-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="pocket-share-icon-bottom">Pocket icon</title><path d="M18.813 10.259l-5.646 5.419c-.32.305-.73.458-1.141.458-.41 0-.821-.153-1.141-.458l-5.646-5.419c-.657-.628-.677-1.671-.049-2.326.63-.657 1.671-.679 2.325-.05l4.511 4.322 4.517-4.322c.66-.631 1.697-.607 2.326.049.631.645.615 1.695-.045 2.326l-.011.001zm5.083-7.546c-.299-.858-1.125-1.436-2.041-1.436H2.179c-.9 0-1.717.564-2.037 1.405-.094.25-.142.511-.142.774v7.245l.084 1.441c.348 3.277 2.047 6.142 4.682 8.139.045.036.094.07.143.105l.03.023c1.411 1.03 2.989 1.728 4.694 2.072.786.158 1.591.24 2.389.24.739 0 1.481-.067 2.209-.204.088-.029.176-.045.264-.06.023 0 .049-.015.074-.029 1.633-.36 3.148-1.036 4.508-2.025l.029-.031.135-.105c2.627-1.995 4.324-4.862 4.686-8.148L24 10.678V3.445c0-.251-.031-.5-.121-.742l.017.01z"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['feedly'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> feedly">
                <?php $rss_url = urlencode( get_bloginfo('rss2_url') ); ?>
                <a href="<?php echo 'https://feedly.com/i/subscription/feed/'.$rss_url.'/feed/'; ?>" target="_blank" rel="noopener noreferrer" class="feedly-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="feedly-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="feedly-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="feedly-share-icon-bottom">Feedly icon</title><path d="M7.396 21.932L.62 15.108c-.825-.824-.825-2.609 0-3.39l9.709-9.752c.781-.78 2.521-.78 3.297 0l9.756 9.753c.826.825.826 2.611 0 3.391l-6.779 6.824c-.411.41-1.053.686-1.695.686H9c-.596-.001-1.19-.276-1.604-.688zm6.184-2.656c.137-.138.137-.413 0-.55l-1.328-1.328c-.138-.15-.412-.15-.549 0l-1.329 1.319c-.138.134-.138.405 0 .54l1.054 1.005h1.099l1.065-1.02-.012.034zm0-5.633c.092-.09.092-.32 0-.412l-1.42-1.409c-.09-.091-.32-.091-.412 0l-4.121 4.124c-.139.15-.139.465 0 .601l.959.96h1.102l3.893-3.855v-.009zm0-5.587c.092-.091.137-.366 0-.458l-1.375-1.374c-.09-.104-.365-.104-.502 0l-6.914 6.915c-.094.09-.14.359-.049.449l1.1 1.05h1.053l6.687-6.582z"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['linkedin'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> linkedin">
                <a href="<?php echo 'https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$title; ?>" target="_blank" rel="noopener noreferrer" class="linkedin-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="linkedin-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="linkedin-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="linkedin-share-icon-bottom">LinkedIn icon</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </li>
        <?php endif; ?>
        
        <?php if ( isset( $rearrange['social_share']['show_buttons']['line'] ) ) : ?>
            <li class="<?php echo $transparent.' '.$icon_round; ?> line">
                <a href="<?php echo 'https://timeline.line.me/social-plugin/share?url='.$url; ?>" target="_blank" rel="noopener noreferrer" class="line-icon-link <?php echo $color; ?>">
                    <?php if ( isset( $rearrange['social_share']['show_counts'] ) ) : ?>
                        <span class="line-count count">0</span>
                    <?php endif; ?>
                    <svg class="<?php echo $svg_class; ?>" aria-labelledby="line-share-icon-bottom" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title id="line-share-icon-bottom">Line icon</title><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>