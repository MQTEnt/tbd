<?php
/*
@ Khai báo hằng giá trị
  @ THEME_URL = Lấy đường dẫn tới thư mục theme
  @ CORE = Lấy đường dẫn tới thư mục core
*/
define( 'THEME_URL', get_stylesheet_directory() );
define ( 'CORE', THEME_URL . "/core" );
/*
@ Nhúng file /core/init.php
*/
require_once( CORE . "/init.php" );

/*
@ Thiết lập chiều rộng nội dung
*/
if(!isset($content_width)){
  $content_width = 620;
}

/*
@ KHAI BÁO CHỨC NĂNG CỦA THEME
*/
if(!function_exists('tmq_theme_setup')){
  function tmq_theme_setup() {
    /*@ Thiết lập textdomain */
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain( 'tmq', $language_folder );

    /*@ Thêm chức năng format cho phần viết post */
    add_theme_support( 'post-formats',['image', 'link']);

    /*@ Thêm chức năng thumbnails cho phần viết post */
    add_theme_support( 'post-thumbnails' );

    /*@ Thêm custom background */
    $default_background = array(
      'default-color' => '#e8e8e8'
    );
    add_theme_support( 'custom-background', $default_background ); //Đăng kí Background (Phần Appearance/Background/Colors)

    /*@ Thêm lựa chọn menu (cho phần Theme locations) */
    register_nav_menu( 'navbar', __('Thiết bị điện: Navbar (Menu chính)', 'tmq') ); //Đăng kí Menus (Phần Appeareance/Menus có thể dùng được)

    /*@ Tạo sidebar */
    $left_sidebar = array(
      'name' => __('Thiết bị điện: Left Sidebar', 'tmq'),
      'id' => 'left-sidebar',
      'description' => __('Thiết bị điện: Left sidebar'),
      'class' => 'left-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>'
    );
    register_sidebar( $left_sidebar ); //Đăng kí left-sidebar cho Widget (Hiển thị phần Apprearance/Widgets)

    $right_sidebar = array(
      'name' => __('Thiết bị điện: Right Sidebar', 'tmq'),
      'id' => 'right-sidebar',
      'description' => __('Thiết bị điện: Right sidebar'),
      'class' => 'right-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>'
    );
    register_sidebar( $right_sidebar ); //Đăng kí right-sidebar cho Widget
  }
  add_action('init', 'tmq_theme_setup'); //Hook
}

/* TEMPLATE FUNCTIONS */

/*
@ Hiển thị header
*/
if (!function_exists('tmq_header')){
  function tmq_header(){
    global $tmq_options; //Biến để lấy giá trị trong theme option
    if( $tmq_options['logo-on'] == 0 ): //Nếu không cài đặt logo thì hiển thị chữ
     printf( '<p id="none-logo"><a href="%1$s" title="%2$s">%3$s</a></p>',
        get_bloginfo('url'),
        get_bloginfo('description'),
        get_bloginfo('sitename') );
    ?>
    <?php else: ?>
    <div id="logo">
      <img src="<?php echo $tmq_options['logo-image']['url']; ?>"/>
    </div> <!-- End #logo -->
    <?php endif; ?>
    <div id="site-title"><h2><?php bloginfo('title'); ?></h2></div>
    <div id="site-description"><p><?php bloginfo('description'); ?></p></div>
    <?php
  }
}

/*
@ Hàm hiển thị Thumbnail (Featured Image) -->
*/
if(!function_exists('tmq_thumbnail')){
  function tmq_thumbnail($size){
          //Chỉ hiển thị thumbnail cho những post đủ điều kiện sau:
          if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')): ?>
            <div class="product-thumbnail">
              <?php the_post_thumbnail($size); //Tham số dựa trên kích cỡ các thumnail tại Settings/Media?>
            </div>
          <?php endif; ?>
  <?php }
}

/*
@ Hàm hiển thị Sản phẩm theo Category (Trang chủ)
*/
if(!function_exists('tmq_home_content')){
  function tmq_home_content(){
    $cats = get_categories( array(
      //'parent'  => 0, //Thêm parent nếu chỉ muốn lấy category cha
      'taxonomy' => 'product_cat', //***
    ));
    //Loop categries
    foreach ($cats as $cat){
      echo "<div class='category'>";
      echo "<h2>".$cat->name." &raquo;&raquo;</h2>"; //Tạo tiêu đề
      echo "<div class='products'>";
      $the_query = new WP_Query( array( 'product_cat' => $cat->name, 'posts_per_page' => 3, 'order_by' => 'date', 'order' => 'DESC' ) ); //Tạo query (chỉ lấy 3 bài viết trên mỗi category)
      //Start loop
      if ($the_query->have_posts()): 
        while ($the_query->have_posts()): $the_query->the_post();
          echo "<div class='product'>";
          tmq_thumbnail('thumbnail'); //Hiển thị thumbnail cho mỗi sản phẩm
          echo '<p class="name-product">'.get_the_title().'</p>';
          echo '<p class="view-detail"><a href="'.get_permalink().'">Xem chi tiết</a></p>';
          echo '</div> <!-- End .product -->';
        endwhile;
      endif; 
      echo '</div> <!-- End .products -->';
      echo '</div> <!-- End .category -->';
    }
  }
}

/*
@ Hàm hiển thị Entry-Header (tiêu đề Page/Post)
*/
if(!function_exists('tmq_entry_header')){
  function tmq_entry_header(){ ?>
    <h2 class=""><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  <?php }
}

/*
@ Hàm hiển thị Entry-content (Nội dung Single hoặc Page (Cart, Check out, My account))
*/
if(!function_exists('tmq_entry_content')){
  function tmq_entry_content(){
    if(!is_single() && !is_page()){
      //Hiển thị phần rút ngọn nội dung nếu không phải là trang đơn (Single) và Page
      the_excerpt();
    }
    else{
      //Hiển thị toàn bộ nội dung nếu là trang đơn (single.php) và Page (page.php)
      the_content();
    }
  }
}

/*
@ Thiết hiển thị giao diện Menu (Navbar)
*/
if(!function_exists('tmq_menu')){
  function tmq_menu($slug) {
    $menu = array(
      'theme_location' => $slug,
      'container' => 'nav',
      'container_class' => $slug,
    );
    wp_nav_menu($menu); //Hiển thị menu (navbar)
  }
}

/*
@ Hiển thị banner
*/
if(!function_exists('tmq_banner')){
  function tmq_banner(){
    global $tmq_options;
    if( $tmq_options['banner-on'] == 1 ):
      echo '<img src="'.$tmq_options['banner-image']['url'].'" alt="">';
    endif;
  }
}

/*
@ Custom lại trang Shop/Cart...
*/
function tmq_custom_shop_page(){
  //Xóa sidebar ở cuối trang Shop (archive-product.php)
  remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar');
  //Xóa danh sách sản phẩm liên quan ở trang Cart (cart.php)
  remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
}
add_action( 'after_setup_theme', 'tmq_custom_shop_page'); //ACTION HOOK

/*
@ Thẻ bao phần nội dung trang shop
*/
if(!function_exists('tmq_open_shop_container')){
  function tmq_open_shop_container(){
    echo "<div id='shop-container'>";
  }
}
if(!function_exists('tmq_close_shop_container')){
  function tmq_close_shop_container(){
    echo "</div> <!--End #container (shop) -->";
  }
}
add_action( 'woocommerce_before_main_content', 'tmq_open_shop_container'); //ACTION HOOK
add_action( 'woocommerce_after_main_content', 'tmq_close_shop_container'); //ACTION HOOK

/*
@ Hiển thị giỏ hàng
*/
add_filter('wp_nav_menu_items','add_cart_in_menu', 10, 2); //FILTER HOOK
function add_cart_in_menu( $menu, $args ){
  if(is_cart()) //Nếu là trang Cart rồi thì không cần hiển thị giỏ hàng
    return $menu;
  global $woocommerce;
  // get cart quantity
  $qty = $woocommerce->cart->get_cart_contents_count();
  // get currency symbol
  $currency_symbol = get_woocommerce_currency_symbol();
  // get cart total
  $total = $woocommerce->cart->cart_contents_total;
  // get cart url
  $cart_url = $woocommerce->cart->get_cart_url();
  echo '<div id="cart">';
  printf('<img src="%1$s">', get_stylesheet_directory_uri()."//img/cart_icon.png");
  printf('<a class="total_cart" href="%1$s"> <span class="current-quantity">%2$s</span> product(s) | %3$s <span class="total-price">%4$s</span></a>', $cart_url, $qty, $currency_symbol, $total);
  echo '</div> <!-- End #cart -->';
  //Don't need to asign $menu, it depends on display
  return $menu;
}








/*** Nhúng file style.css ***/
function tmq_style(){
  //style.css
  wp_register_style('main-style', get_template_directory_uri().'/style.css', 'all'); //Đăng kí file css
  wp_enqueue_style('main-style'); //Đưa vào danh sách những file css

  //reset.css
  wp_register_style('reset-style', get_template_directory_uri().'/reset.css', 'all');
  wp_enqueue_style('reset-style');

  //js/app.css
  wp_register_script('app-script', get_template_directory_uri().'/js/app.js', ['jquery']); //Thư viện SupperFish phụ thuộc vào jQuery nên cần đăng kí jQuery chạy trước
  wp_enqueue_script('app-script');
}
add_action('wp_enqueue_scripts', 'tmq_style'); //Hook gọi hàm nhúng file css ở trên
