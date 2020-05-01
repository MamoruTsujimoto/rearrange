<?php
/*---------------------------------------------------------------------------
 * クイックタグ
 *---------------------------------------------------------------------------*/
add_action( 'admin_print_footer_scripts', function() {
    if ( wp_script_is('quicktags') ) {

        ?>
        <script>
        QTags.addButton( 'rearrange-blockquote', 'Rearrange blockquote', '<blockquote cite="https:// ...">\n  <p>引用文 ...</p>\n  <p class="cite-link">\n    <cite>\n      <a href="https:// ...">引用元リンク</a>\n    </cite>\n  </p>\n</blockquote>' );
        QTags.addButton( 'rearrange-contents', 'Rearrange 目次', '<div id="contents">\n  <span class="contents-title">目次</span>\n  <ol>\n    <li>\n      <a href="#">見出し1</a>\n      <ul>\n        <li><a href="#">小見出し1</a></li>\n        <li><a href="#">小見出し2</a></li>\n        <li><a href="#">小見出し3</a></li>\n      </ul>\n    </li>\n    <li>\n      <a href="#">見出し2</a>\n    </li>\n    <li>\n      <a href="#">見出し3</a>\n    </li>\n    <li>\n      <a href="#">見出し4</a>\n    </li>\n  </ol>\n</div>' );
        QTags.addButton( 'rearrange-table1', 'Rearrange table1', '<table>\n  <thead>\n    <tr>\n      <th>ヘッダー 1</th>\n      <th>ヘッダー 2</th>\n      <th>ヘッダー 3</th>\n    </tr>\n  </thead>\n  <tbody>\n    <tr>\n      <td>内容 1</td>\n      <td>内容 2</td>\n      <td>内容 3</td>\n    </tr>\n    <tr>\n      <td>内容 1</td>\n      <td>内容 2</td>\n      <td>内容 3</td>\n    </tr>\n    <tr>\n      <td>内容 1</td>\n      <td>内容 2</td>\n      <td>内容 3</td>\n    </tr>\n  </tbody>\n  <tfoot>\n    <tr>\n      <td>フッター 1</td>\n      <td>フッター 2</td>\n      <td>フッター 3</td>\n    </tr>\n  </tfoot>\n</table>' );
        QTags.addButton( 'rearrange-table2', 'Rearrange table2', '<table>\n  <thead>\n    <tr>\n      <th></th>\n      <th>ヘッダー 1</th>\n      <th>ヘッダー 2</th>\n      <th>ヘッダー 3</th>\n    </tr>\n    </thead>\n  <tbody>\n    <tr>\n      <th>ヘッダー 1</th>\n      <td>内容1</td>\n      <td>内容2</td>\n      <td>内容3</td>\n    </tr>\n    <tr>\n      <th>ヘッダー 2</th>\n      <td>内容1</td>\n      <td>内容2</td>\n      <td>内容3</td>\n    </tr>\n    <tr>\n      <th>ヘッダー 3</th>\n      <td>内容1</td>\n      <td>内容2</td>\n      <td>内容3</td>\n    </tr>\n  </tbody>\n</table>' );
        QTags.addButton( 'rearrange-dl', 'Rearrange dl', '<dl>\n  <dt>用語</dt>\n  <dd>\n    説明\n  </dd>\n</dl>' );

        QTags.addButton( 'rearrange-lazy-img', 'Rearrange lazy-img', '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="ここに画像URLを入力してください。" class="lazyload" title="" alt="" />' );
        QTags.addButton( 'rearrange-lazy-iframe', 'Rearrange lazy-iframe', '<div class="iframe-wrap">\n  <iframe class="lazyload" data-src="ここに埋め込み用の動画URLを入力してください。" title="" allow="autoplay; encrypted-media" allowfullscreen></iframe>\n  <div class="loading-indicator"></div>\n</div>' );

        QTags.addButton( 'rearrange-ad', 'Rearrange ad', '[ad]ここに広告タグ（html/script）を入力してください。[/ad]' );
        QTags.addButton( 'rearrange-adiframe', 'Rearrange ad-iframe', '[adiframe]ここに広告タグ（html/script）を入力してください。iframeで読み込みます。[/adiframe]' );
        </script>
<?php
    }
} );