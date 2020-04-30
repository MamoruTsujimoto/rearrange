<?php if ( comments_open() ) : ?>
    <?php if ( have_comments() ) : ?>
        <div id="comments">
            <div class="comments-head">
                <h2>コメント</h2>
            </div>
            
            <ol class="comment-list">
                <?php wp_list_comments(); ?>
            </ol>
            
            <div class="pagination">
                <?php
                    if ( 1 < get_comment_pages_count() ) {
                        // $prev_svg = '<svg id="prev-chevron-left" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 24 24"><path d="M14 20c0.128 0 0.256-0.049 0.354-0.146 0.195-0.195 0.195-0.512 0-0.707l-8.646-8.646 8.646-8.646c0.195-0.195 0.195-0.512 0-0.707s-0.512-0.195-0.707 0l-9 9c-0.195 0.195-0.195 0.512 0 0.707l9 9c0.098 0.098 0.226 0.146 0.354 0.146z" fill="#333"></path>                </svg>';
                        // $next_svg = '<svg id="next-chevron-right" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 19 22"><path d="M5 20c-0.128 0-0.256-0.049-0.354-0.146-0.195-0.195-0.195-0.512 0-0.707l8.646-8.646-8.646-8.646c-0.195-0.195-0.195-0.512 0-0.707s0.512-0.195 0.707 0l9 9c0.195 0.195 0.195 0.512 0 0.707l-9 9c-0.098 0.098-0.226 0.146-0.354 0.146z" fill="#333"></path>';
                        $args = [
                            // 'prev_text' => $prev_svg,
                            // 'next_text' => $next_svg,
                            'prev_next' => false,
                            'end_size'  => 0,
                            'mid_size'  => 1,
                            'type'      => 'list'
                        ];
                        paginate_comments_links( $args );
                    }
                ?>
            </div>
        </div>
    <?php endif; ?>
    <?php comment_form(); ?>
<?php endif; ?>



