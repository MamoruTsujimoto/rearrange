<?php

/*---------------------------------------------------------------------------
 * 秘伝のvar_dump関数
 * https://qiita.com/ymm1x/items/8fb2c412b161f485b61b
 *---------------------------------------------------------------------------*/
if ( ! function_exists( 'd' ) ) :
  function d() {
        // var_dump() の出力内容を変数に取り出し
    ob_start();
    foreach ( func_get_args() as $arg ) {
      var_dump($arg);
    }
    $dump = ob_get_contents();
    ob_end_clean();

        // 可読性のためインデント幅を2倍に (2 -> 4)
    $dump = preg_replace_callback(
      '/^\s++/m',
      function( $m ) {
        return str_repeat( " ", strlen( $m[0] ) * 2 );
      },
      $dump
    );

        // この関数の呼び出し元を取得 （ファイル名・行番号）
    $caller = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 1 )[0];

    $header = "";
    $header .= "<pre style='margin:2px; padding:10px; text-align:left; background:#f7f7f7; color:#000; font-family:inherit; font-size:14px;'>";
    $header .= "<span style='font-weight: bold;'>{$caller['file']}:{$caller['line']}</span>\n";

    $footer = "</pre>\n";

        // ダンプ内容を出力 (CLI で実行された場合は HTML タグを取り除く)
    $isCli = ( php_sapi_name() === 'cli' );
    echo $isCli ? strip_tags( $header ) : $header;
    echo $dump;
    echo $isCli ? strip_tags( $footer ) : $footer;
  }
endif;

if ( ! function_exists( 'r' ) ) :
  function r( $var ) {
    echo '<pre>'; print_r( $var ); echo '</pre>';
  }
endif;