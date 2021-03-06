<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage ESHOPPER
 * @since ESHOPPER 1.0
 */
get_header();

global $wpdb;
$upload_dir = wp_upload_dir();
$upload_url_alt = $upload_dir['baseurl'];

$home_banner = $wpdb->get_results("SELECT * from nis_homecontent where id=1", ARRAY_A);

?>
<!-- banner Section -->
<div class="banner_wrapper">
    <div class="container">
        <img src="<?php echo $upload_url_alt . '/' . $home_banner[0]['banner_image']; ?>" alt="banner" class="img-responsive">
    </div>
</div>
<?php 
$home_after_banner1 = $wpdb->get_results("SELECT * from nis_homecontent where id=1", ARRAY_A);
$home_after_banner2 = $wpdb->get_results("SELECT * from nis_homecontent where id=2", ARRAY_A);
$home_after_banner3 = $wpdb->get_results("SELECT * from nis_homecontent where id=3", ARRAY_A);
$home_after_banner4 = $wpdb->get_results("SELECT * from nis_homecontent where id=4", ARRAY_A);
?>
<!-- about us Section -->
<div class="aboutus_wrapper">
    <div class="container">
        <div class="aboutus_wrap">
            <div class="col-lg-3 col-sm-6 col-xs-12 about_border">
                <div class="about_img">
                    <img src="<?php echo $upload_url_alt . '/' . $home_after_banner1[0]['facility_icon1']; ?>" alt="aboutus" class="img-responsive">
                </div>
                <div class="about_text">
                    <h3><?php echo $home_after_banner1[0]['facility_heading1']; ?></h3>
                    <p><?php echo $home_after_banner1[0]['facility_text1']; ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12 about_border">
                <div class="about_img">
                    <img src="<?php echo $upload_url_alt . '/' . $home_after_banner2[0]['facility_icon2']; ?>" alt="aboutus" class="img-responsive">
                </div>
                <div class="about_text">
                    <h3><?php echo $home_after_banner2[0]['facility_heading2']; ?></h3>
                    <p><?php echo $home_after_banner2[0]['facility_text2']; ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12 about_border">
                <div class="about_img">
                    <img src="<?php echo $upload_url_alt . '/' . $home_after_banner3[0]['facility_icon3']; ?>" alt="aboutus" class="img-responsive">
                </div>
                <div class="about_text">
                    <h3><?php echo $home_after_banner3[0]['facility_heading3']; ?></h3>
                    <p><?php echo $home_after_banner3[0]['facility_text3']; ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-3 col-sm-6 col-xs-12 about_border">
                <div class="about_img">
                    <img src="<?php echo $upload_url_alt . '/' . $home_after_banner4[0]['facility_icon4']; ?>" alt="aboutus" class="img-responsive">
                </div>
                <div class="about_text">
                    <h3><?php echo $home_after_banner4[0]['facility_heading4']; ?></h3>
                    <p><?php echo $home_after_banner4[0]['facility_text4']; ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>        
    </div>
</div>

<!--bestseller section-->
<div class="bestseller_wrapper">
    <div class="container">
        <div class="col-lg-9 col-sm-9 col-xs-12 less_pad">
            <div class="col-lg-12 col-xs-12 less_pad">
                <div class="seller_header">
                    <h3>BEST SELLER</h3>
                    <div class="clearfix"></div>
                </div> 
            </div>
            <div class="col-lg-12 col-xs-12 less_pad">
                <ul id="flexiselDemo3">
                    <?php
                    $args = array('post_type' => 'product', 'posts_per_page' => 4, 'orderby' => 'meta_value_num', 'meta_key' => 'total_sales');
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        ?>
                        <li>
                            <a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                <div class="bestseller_wrap">
                                    <div class="bestseller_box">
                                        <?php if ($product->is_on_sale()) { ?>
                                            <div class="bestseller_box_text">
                                                <p>SALE</p>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="bestseller_box_text">
                                                <p style="background: white"></p>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } ?>
                                        <div class="bestseller_box_text">                                            
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_img">
                                            <?php
                                            if (has_post_thumbnail($loop->post->ID))
                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                            else
                                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
                                            ?>
                                        </div>
                                        <div class="bestseller_box_content">
                                            <h3><?php the_title(); ?></h3>
                                            <?php 
                                            global $product;

                                            if (get_option('woocommerce_enable_review_rating') === 'no')
                                            return;
                                            ?>

                                            <?php if ($rating_html = $product->get_rating_html()) {
                                                ?>
                                                 <ul class="sell_star">
                                                    <?php while ($rating_html < 6) { ?>
                                                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/star_<?php echo $rating_html; ?>.png" alt="star" class="img-responsive"></li> 
                                                        <?php
                                                        $rating_html++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } else { ?>

                                                 <ul class="sell_star">
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                </ul>
                                            <?php } ?>  
                                            <p><?php echo $product->get_price_html(); ?></p>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_icons">
                                            <div class="cart" style="text-align: center">
                                                <h4>Product Details>></h4>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> 
                                </div> 
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </ul>    

                <div class="clearout"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-12 less_pad">
            <div class="col-lg-12 col-xs-12 less_pad">
                <div class="seller_header2">
                    <h3>SALE OFF</h3>
                    <div class="clearfix"></div>
                </div> 
            </div>
            <div class="col-lg-12 col-xs-12 less_pad">
                <ul id="flexiselDemo5">
                    <?php
                    $args = array('post_type' => 'product', 'posts_per_page' => 8, 'meta_query' => array('relation' => 'OR',
                            array(// Simple products type
                                'key' => '_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'numeric'
                            ),
                            array(// Variable products type
                                'key' => '_min_variation_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'numeric'
                            )
                        )
                    );
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        if ($product->is_on_sale()) {
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                                    <div class="bestseller_wrap">
                                        <div class="bestseller_box">
                                            <div class="bestseller_box_text">
                                                <p>SALE</p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="bestseller_box_img">
                                                <?php
                                                if (has_post_thumbnail($loop->post->ID))
                                                    echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                                else
                                                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
                                                ?>                                </div>
                                            <div class="bestseller_box_content">
                                                <h3><?php the_title(); ?></h3> 
                                                 <?php 
                                            global $product;

                                            if (get_option('woocommerce_enable_review_rating') === 'no')
                                            return;
                                            ?>

                                            <?php if ($rating_html = $product->get_rating_html()) {
                                                ?>
                                                 <ul class="sell_star">
                                                    <?php while ($rating_html < 6) { ?>
                                                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/star_<?php echo $rating_html; ?>.png" alt="star" class="img-responsive"></li> 
                                                        <?php
                                                        $rating_html++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } else { ?>

                                                 <ul class="sell_star">
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                </ul>
                                            <?php } ?> 
                                                <p><?php echo $product->get_price_html(); ?></p>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="bestseller_box_icons2">
<!--                                                <div class="days">
                                                    <h4>365 DAYS</h4>
                                                </div>-->
                                                <div class="days" >
                                                    <h4 id="defaultCountdown"></h4>
                                                </div>
<!--                                                <div class="days">
                                                    <h4>30 min</h4>
                                                </div>
                                                <div class="days">
                                                    <h4>45 sec</h4>                                       
                                                </div>-->
                                                <div class="clearfix"></div>

                                            </div>
                                            <div class="clearfix"></div>
                                        </div> 
                                    </div>           
                                </a>
                            </li>
                            <?php
                        }
                    endwhile;
                    ?>
                    <?php wp_reset_query(); ?>
                </ul>    

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--img section-->
<div class="image_wrapper">
    <div class="container">
        <div class="col-lg-5 col-sm-5 col-xs-12">
            <img src="<?php echo get_template_directory_uri(); ?>/images/img1.jpg" alt="images" class="img-responsive">
        </div>
        <div class="col-lg-7 col-sm-7 col-xs-12">
            <img src="<?php echo get_template_directory_uri(); ?>/images/img2.jpg" alt="images" class="img-responsive">
        </div>
        <div class="clearfix"></div>
    </div>    
</div>

<!--newproduct section-->
<div class="bestseller_wrapper">
    <div class="container">
        <div class="col-lg-9 col-sm-9 col-xs-12 less_pad">
            <div class="col-lg-12 col-xs-12 less_pad">
                <div class="seller_header">
                    <h3>NEW PRODUCT</h3>
                    <div class="clearfix"></div>
                </div> 
            </div>
            <div class="col-lg-12 col-xs-12 less_pad">
                <ul id="flexiselDemo6">
                    <?php
                    $args = array('post_type' => 'product', 'orderby' => 'asc');
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        ?>
                        <li>
                            <a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                                <div class="bestseller_wrap">
                                    <div class="bestseller_box">
                                        <div class="bestseller_box_text">
                                            <p>NEW</p>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_img">
                                            <?php
                                            if (has_post_thumbnail($loop->post->ID))
                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                            else
                                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
                                            ?>                           
                                        </div>
                                        <div class="bestseller_box_content">
                                            <h3><?php the_title(); ?></h3>
                                             <?php 
                                            global $product;

                                            if (get_option('woocommerce_enable_review_rating') === 'no')
                                            return;
                                            ?>

                                            <?php if ($rating_html = $product->get_rating_html()) {
                                                ?>
                                                 <ul class="sell_star">
                                                    <?php while ($rating_html < 6) { ?>
                                                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/star_<?php echo $rating_html; ?>.png" alt="star" class="img-responsive"></li> 
                                                        <?php
                                                        $rating_html++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } else { ?>

                                                 <ul class="sell_star">
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                </ul>
                                            <?php } ?> 
                                            <p><?php echo $product->get_price_html(); ?></p>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_icons">
                                            <div class="cart" style="text-align: center">
                                                <h4>Product Details>></h4>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> 
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>                
                </ul>    

                <div class="clearout"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-12 less_pad">
            <div class="col-lg-12 col-xs-12 less_pad">
                <div class="seller_header" style="width:90%;">
                    <h3>POPULAR</h3>
                    <div class="clearfix"></div>
                </div>
                <div id="demo2" class="slideup_wrapper">
                    <ul class="less_pad">
                        <?php
                        $args = array('post_type' => 'product', 'posts_per_page' => 4, 'orderby' => 'meta_value_num', 'meta_key' => '_wc_average_rating');
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) : $loop->the_post();
                            global $product;
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                    <div class="slideup_wrap">
                                        <div class="slide_img">
                                            <?php
                                            if (has_post_thumbnail($loop->post->ID))
                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_thumbnail');
                                            else
                                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="100px" height="100px" />';
                                            ?>  
                                        </div>
                                        <div class="slide_content">
                                            <h3><?php the_title(); ?></h3>
                                             <?php 
                                            global $product;

                                            if (get_option('woocommerce_enable_review_rating') === 'no')
                                            return;
                                            ?>

                                            <?php if ($rating_html = $product->get_rating_html()) {
                                                ?>
                                                 <ul class="popular_star">
                                                    <?php while ($rating_html < 6) { ?>
                                                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/star_<?php echo $rating_html; ?>.png" alt="star" class="img-responsive"></li> 
                                                        <?php
                                                        $rating_html++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } else { ?>

                                                 <ul class="popular_star">
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                </ul>
                                            <?php } ?> 
                                            <div class="clearfix"></div>
                                            <p><?php echo $product->get_price_html(); ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </li>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>                       
                    </ul>
                </div>
                <div class="clearfix"></div> 
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--fashion section-->
<div class="bestseller_wrapper">
    <div class="container">
        <div class="col-lg-9 col-sm-9 col-xs-12 less_pad">
            <div class="col-lg-12 col-xs-12 less_pad">
                <div class="seller_header">
                    <h3>FASHION</h3>
                    <div class="clearfix"></div>
                </div> 
            </div>
            <div class="col-lg-12 col-xs-12 less_pad">
                <ul id="flexiselDemo7">
                    <?php
                    $args = array('post_type' => 'product', 'posts_per_page' => 4, 'orderby' => 'rand', 'meta_key' => '_wc_average_rating');
                    $loop = new WP_Query($args);
                    while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        ?>
                        <li>
                            <a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
                                <div class="bestseller_wrap">
                                    <div class="bestseller_box">
                                        <?php if ($product->is_on_sale()) { ?>
                                            <div class="bestseller_box_text">
                                                <p>SALE</p>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="bestseller_box_text">
                                                <p style="background: white"></p>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php } ?>
                                        <div class="bestseller_box_text">                                            
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_img">
                                            <?php
                                            if (has_post_thumbnail($loop->post->ID))
                                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                            else
                                                echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
                                            ?>
            <!--                                        <img src="<?php echo get_template_directory_uri(); ?>/images/purse.png" alt="images" class="img-responsive" />-->
                                        </div>
                                        <div class="bestseller_box_content">
                                            <h3><?php the_title(); ?></h3>
                                             <?php 
                                            global $product;

                                            if (get_option('woocommerce_enable_review_rating') === 'no')
                                            return;
                                            ?>

                                            <?php if ($rating_html = $product->get_rating_html()) {
                                                ?>
                                                 <ul class="sell_star">
                                                    <?php while ($rating_html < 6) { ?>
                                                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/star_<?php echo $rating_html; ?>.png" alt="star" class="img-responsive"></li> 
                                                        <?php
                                                        $rating_html++;
                                                    }
                                                    ?>
                                                </ul>
                                            <?php } else { ?>

                                                 <ul class="sell_star">
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                    <li><img src="<?php echo get_template_directory_uri(); ?>/images/star2.png" alt="star" class="img-responsive"></li>
                                                </ul>
                                            <?php } ?> 
                                            <p><?php echo $product->get_price_html(); ?></p>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="bestseller_box_icons">
                                            <div class="cart" style="text-align: center">
                                                <h4>Product Details>></h4>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div> 
                                </div> 
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>                      
                </ul>    

                <div class="clearout"></div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-lg-3 col-sm-3 col-xs-12 less_pad">
            <div class="fashion_img">
                <img src="<?php echo get_template_directory_uri(); ?>/images/fashoin.jpg" alt="images" class="img-responsive">
            </div>    
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!--our brand section-->
<div class="bestseller_wrapper ourbrand_wrapper">
    <div class="container">
        <div class="col-lg-12 col-xs-12 less_pad">
            <div class="seller_header">
                <h3>OUR BRAND</h3>
                <div class="clearfix"></div>
            </div> 
        </div>

        <div class="col-lg-12 col-xs-12">
            <div class="brand_wrapper">
                <ul id="flexiselDemo8">
                    <?php
                    $home_contents = $wpdb->get_results("SELECT * from brand_logo", ARRAY_A);
			
                    foreach($home_contents as $home_content){ 
			if(!empty($home_content['logo_image'])){
                    ?>
                    <li>
                        <div class="brand_wrap">
                            <img src="<?php echo $home_content['logo_image']; ?>" alt="myntra" class="img-responsive">
                        </div>
                    </li> 
                    <?php } } ?>

                </ul> 

            </div>      
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<?php get_footer(); ?>
