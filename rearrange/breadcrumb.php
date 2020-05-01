<?php

class BreadCrumb {

  public $category;
  public $lists;
  public $home;
  public $schema = null;

  function __construct() {
    global $rearrange, $post;

    $this->category = get_the_category();
    $this->home = '<li><a href="'.$rearrange['home_url'].'">ホーム</a></li>';

    if ( 1 === count( $this->category ) ) {
      $this->generate_a_category_list();
    } else {

      foreach( $this->category as $cat ) {
        if ( 0 === $cat->parent ) { continue; }

        $tmp = get_category_parents( $cat->term_id, true, ',' );
        if ( mb_strlen( $this->lists ) < mb_strlen( $tmp ) ) {
          $this->lists = $tmp;
        }
      }


            // 親カテゴリーを持たないカテゴリーを複数紐付けた場合、最初のカテゴリーを一つだけ表示させる
      if ( empty( $this->lists ) ) {
        $this->generate_a_category_list();
      } else {
        $lists_array = explode( ',', $this->lists );
        $rearrange['last_category'] = $lists_array[ count( $lists_array ) - 2 ];
        $this->lists = str_replace( ['<a', '/a>,'], ['<li><a', '/a></li>'], $this->lists );

        preg_match_all( '|<a href=\"(.*?)\".*?>(.*?)</a>|mis', $this->lists, $matches );
        foreach ( $matches[1] as $key => $url ) {
          $this->generate_breadcrumb_schema( $url, $matches[2][$key], $key + 2 );
        }
      }
    }

        // 記事タイトルを追加
    $this->lists .= '<li><span>'.$post->post_title.'</span></li>';

  }

  private function generate_a_category_list() {
    global $rearrange;
    $url = get_category_link( $this->category[0]->term_id );
    $link_title = $this->category[0]->name;
    $this->generate_breadcrumb_schema( $url, $link_title, 2 );
    $this->lists = '<a href="' . $url . '">' . $link_title . '</a>';
    $rearrange['last_category'] = $this->lists;
    $this->lists = '<li>'.$this->lists.'</li>';
  }

  private function generate_breadcrumb_schema( $url, $link_title, $position ) {
    $this->schema[] = [
      '@type'    => 'ListItem',
      'position' => $position,
      'item'     => [
        '@id'  => $url,
        'name' => $link_title
      ]
    ];
  }
}

global $rearrange, $post;

$rearrange['no-image-class'] = '';
if ( is_singular() ) {
  if ( ! isset( $rearrange['has_post_thumbnail'] ) ) {
    $rearrange['has_post_thumbnail'] = has_post_thumbnail();
  }

  if ( ! $rearrange['has_post_thumbnail'] ) {
    $rearrange['no-image-class'] = 'no-img';
  }
}

echo '<ol id="breadcrumb" class="'.$rearrange['no-image-class'].'">';
$home_list = '<li><a href="'.$rearrange['home_url'].'">ホーム</a></li>';
$cat_schema = null;
switch ( true ) {
	case is_page():
 echo '<li><a href="'.$rearrange['home_url'].'" class="'.$rearrange['no-image-class'].'">ホーム</a></li>';
 echo '<li><span class="'.$rearrange['no-image-class'].'">'.$post->post_title.'</span></li>';
 break;

 case is_single():
 $breadcrumb = new BreadCrumb();
 echo $breadcrumb->home.$breadcrumb->lists;
 $rearrange['post']['categories'] = $breadcrumb->category;
 $cat_schema = $breadcrumb->schema;
 break;

 case is_search():
 echo $home_list.'<li><span>「'.$rearrange['search_query'].'」の検索結果</span></li>';
 break;

 case is_category() || is_tag():
 $rearrange['archive_title'] = single_term_title( '', false );
 echo $home_list.'<li><span>'.$rearrange['archive_title'].'</span></li>';
 break;

 case is_date():
 switch ( true ) {
  case is_year():
  $rearrange['archive_title'] = get_the_date('Y年');
  break;

  case is_month():
  $rearrange['archive_title'] = get_the_date('Y年m月');
  break;

  case is_day():
  $rearrange['archive_title'] = get_the_date('Y年m月d日');
  break;

  default:
  break;
}
echo $home_list.'<li><span>'.$rearrange['archive_title'].'</span></li>';
break;

case is_author():
$rearrange['archive_title'] = get_the_author();
echo $home_list.'<li><span>'.$rearrange['archive_title'].'</span></li>';
break;

default:
break;
}

echo '</ol>';


$bc_schema = [
  '@context'        => 'http://schema.org',
  '@type'           => 'BreadcrumbList',
  'itemListElement' => [
    [
      '@type'    => 'ListItem',
      'position' => 1,
      'item'     => [
        '@id'  => $rearrange['home_url'],
        'name' => 'ホーム'
      ]
    ]
  ]
];

if ( null !== $cat_schema ) {
  foreach ( $cat_schema as $list_item ) {
    $bc_schema['itemListElement'][] = $list_item;
  }
}

$rearrange['schema_org'][] = $bc_schema;
