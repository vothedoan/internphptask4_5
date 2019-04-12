
<?php

/**
* Plugin Name: Woo Custom Shortcode
* Plugin URI: https://www.yourwebsiteurl.com/
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Your Name Here
* Author URI: http://yourwebsiteurl.com/
**/

/**
 * this is function add menu into page admin --> START
 */
function wcs_menu()
{
    add_menu_page('My Page Title', 'Woo Custom Shortcode','manage_options','wcs_menu','wcs_layout_main');  
    add_submenu_page('wcs_menu','Submenu Page Title', 'All Product','manage_options','wcs_submenu_allproduct','wcsmenu_all_product');
}
add_action('admin_menu','wcs_menu');
/**
 * this is function add menu into page admin --> END
 */
/**
 * this is layout for menu--> START
 */
function wcs_layout_main(){
    echo "this is main";
}
/**
 * this is layout for menu--> START
 */

 /** this is function add shortcode -->START 
  * 
 */
function wcs_shortcode_func($para)
{   
    extract( shortcode_atts(array(
        'product_cat' => '',
        'order'     => 'ASC',
        'ids' =>'',
        'liststyle'=>'list'
    ),$para));
     $arrayIDproduct;
    if($ids!="")
    {
         $arrayIDproduct= explode(',',$ids);
    }
    $array = array(
        'post_type' => 'product',
        'product_cat'=> $product_cat,
        'post__in' =>$arrayIDproduct,
        'orderby' => 'ID',
        'order'  => $order
    );
    $query = new WP_Query($array);
   ?>

    <?php
    if($liststyle =='slide')
        {  ob_start();
            ?>
        <div class="wcs__post__main--slide">
            <?php
            while($query->have_posts())
            {
                $query->the_post();
                ?>
                <div class="wcs__post__main__item">
                    <img class="wcs__post__main__item--img--slide" src="<?php the_post_thumbnail_url();?>" alt="">
                    <div class="wcs__post__main__item--content--slide">
                    <h4><?php echo get_the_title();?></h4>
                    <p>PRICE: $<?php $_product = wc_get_product( get_the_ID() ); echo $_product->get_price();?></p>
                    </div>              
                </div>
                <?php
            }
            ?>
        </div>
            <?php
             $html = ob_get_contents();
             ob_clean();
            return $html;
        }
    else
    {   ob_start();
        ?>
        <select name="select__client__liststyle" id="select__client__liststyle">
            <option value="gird">Grid</option>    
            <option value="list">List</option>      
        </select>
        <div class="wcs__post__main--list">
        <?php
        while($query->have_posts())
        {
            $query->the_post();
            ?>
            <div class="wcs__post__main__item--list">
                <img class="wcs__post__main__item--img--list" src="<?php the_post_thumbnail_url();?>" alt="">
                <div class="wcs__post__main__item--content--list">
                    <h4><?php echo get_the_title();?></h4>
                    <p>PRICE:$<?php $_product = wc_get_product(get_the_ID() ); echo $_product->get_price();?></p>

                </div>
            </div>
            <div class="wcs__post__main__item--grid">
                <img class="wcs__post__main__item--img" src="<?php the_post_thumbnail_url();?>" alt="">
                <div class="wcs__post__main__item--content">
                    <h4><?php echo get_the_title();?></h4>
                    <p>PRICE:$<?php $_product = wc_get_product( get_the_ID() ); echo $_product->get_price();?></p>
                </div>
                
            </div>
            <?php
        }
        ?>
        </div>
        <?php
         $html = ob_get_contents();
         ob_clean();
        return $html;
    }
 
}
add_shortcode('wcs_shortcode','wcs_shortcode_func');

function test__shortcode($para)
{
    extract(shortcode_atts(array(
        'a'=>'aaaaa',
        'b'=>'bbbbb',
    ),$para));
    ob_start();
    ?>
    <p>Just test shortcodea aaaa: <?php echo $a;?></p>
    <p>Just test shortcodea bbbb: <?php echo $b;?></p>
    <?php
      $html= ob_get_contents();
    ob_clean();
  
    return $html;
}
add_shortcode('testshortcode','test__shortcode');
 /** this is function add shortcode -->END 
  * 
 */
/**
 * This is function add media button editor -->START
 */

function add_button_media_edior(){
add_thickbox();
?>

    <div id="wcs_modal" style="display:none;">
        <div class="wcs__modal__head">
            <select name="select__category" class="wcs__modal__select" id="select__category">
                <option value="">--choose category--</option>
                <?php
                 $args = array(
                     'post_type'     =>'product',
                     'taxonomy'  => 'product_cat',
                    
                );
               $category= get_categories( $args );
            foreach ($category as $cate) {
                ?>
                <option value="<?php echo $cate->name?>"><?php echo $cate->name;?></option>
                <?php
            }
               ?>
            </select>
              <!--This is mutiple select start-->
              <select multiple class="wcs__modal__select" id="multi__select__product">
                <?php
                $array= array(
                    'post_type' => 'product'
                );
                $query = new WP_Query($array);
                while($query->have_posts())
                {
                    $query->the_post();
                    ?>
                    <option value="<?php echo get_the_ID()?>"><?php echo get_the_title();?></option>
                    <?php
                }
            ?>
            </select>
            <!--This is mutiple select end-->
            <select name="select__style__list" class="wcs__modal__select" id="select__style__list">
                <option value="">--choose list style--</option>
                <option value="list">list</option>
                <option value="gird">grid</option>
                <option value="slide">slide</option>
            </select>
            <select name="select__style__sort"  class="wcs__modal__select" id="select__style__sort">
                <option value="">--choose sort by--</option>
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
            </select>
        </div>
        <button class="button" id="btn__apply">Apply</button>
        <div class="wcs__modal__content">
            <textarea name="" id="wcs__input" cols="30" rows="10"></textarea>
        </div>
        <div class="wcs__modal__footer">
            <button class="button" id="btn__insert__shortcode">Insert Shortcode</button>
        </div>
        
        </div>
    <a href='#TB_inline?&width=600&height=550&inlineId=wcs_modal' class='thickbox button'>WCS SHORTCODE</a>
<?php
}

add_action('media_buttons','add_button_media_edior');
/**
 * This is function add media button editor -->END
 */
 /**
 * this is function add js and css admin --> START
 */
function wcs_admin_add_js()
{
    wp_enqueue_script('wcs_adminjs', plugin_dir_url(__FILE__) . '/js/wcs_adminjs.js' , array(), '1.0');
    wp_localize_script( 'wcs_adminjs', 'my_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_style('wcs_admincss', plugin_dir_url(__FILE__) . '/style/wcs_admincss.css'); 
    wp_enqueue_script('wcs_admin_typeahead',plugin_dir_url(__FILE__). '/js/typeahead.js');
    wp_enqueue_script('wcs_admin_multiselectjs', plugin_dir_url(__FILE__). '/js/multi-select/jquery.sumoselect.min.js');
    wp_enqueue_style('wcs_admin_multiselectcss', plugin_dir_url(__FILE__). '/js/multi-select/sumoselect.css');
}
add_action('admin_enqueue_scripts', 'wcs_admin_add_js' );
/**
 * this is function add js and css admin --> END
 */
 
 /**
  * this is function add js and css client -->START
  */
  function wcs_client_add_js(){
    wp_enqueue_script('wcs_clientjquery',plugin_dir_url(__FILE__).'../../themes/storefront-child/assets/js/jquery-3.3.1.min.js');
   // wp_enqueue_script('wcs_client-jquery', plugin_dir_url(__FILE__).'/js/jquery-3.3.1.min.js');
    wp_enqueue_script('wcs_clientjs', plugin_dir_url(__FILE__) . '/js/wcs_clientjs.js');
    wp_enqueue_style('wcs_clientcss', plugin_dir_url(__FILE__) . '/style/wcs_clientcss.css');
    wp_enqueue_style('wcs_slick_style', plugin_dir_url(__FILE__).'/js/slick-master/slick/slick.css');
    wp_enqueue_script('wcs_slick_js', plugin_dir_url(__FILE__). '/js/slick-master/slick/slick.min.js');
  }
  add_action('wp_enqueue_scripts','wcs_client_add_js');

 /**
  * this is function add js and css client -->END
  */
/**
 * This is function add column product -->START
 */
add_filter( 'manage_product_posts_columns', 'add_product_columns' );
function add_product_columns($columns) {
    $columns['feature_product'] = __( 'feature_product', 'your_text_domain' );
    return $columns;
}
/**
 * This is function add column product -->END
 */

 /**
  * This is function add value for column -->START
  */
add_action( 'manage_product_posts_custom_column' , 'custom_product_column', 10, 2 );
function custom_product_column($column) {
   if($column ==='feature_product'){
        if(get_post_meta(get_the_ID(),'wcs_id_product',true)=='true')      
        {?>
             <input class="checkbox__wcs" type="checkbox" data-value="<?php echo get_the_ID()?>" checked>
        <?php
        }
        else{
            ?>
                <input class="checkbox__wcs" type="checkbox" data-value="<?php echo get_the_ID()?>">
            <?php
        }
   }
}
/**
  * This is function add value for column -->END
  */

/**
 *  This is function add meta boxs for edit product -->START*/
function add_custom_metax_box()
{

        add_meta_box(
            'wsc_feature_product',           // box ID
            'Feature Product',  // Box title
            'wcs_custom_box_html',  // Content callback, must be of type callable
            'product'                  // Post type
        );
}
add_action('add_meta_boxes', 'add_custom_metax_box');


function wcs_custom_box_html(){
    global $post;
    $custom = get_post_custom($post->ID);
    $field_id = $custom["wcs_id_product"][0];
   ?>
   
    <label>Active</label>
    <?php $field_id_value = get_post_meta($post->ID, 'wcs_id_product', true);
    if($field_id_value == "true") $field_id_checked = 'checked="checked"'; ?>
      <input type="checkbox" name="wcs_id_product" value="true" <?php echo $field_id_checked; ?> />
    <?php
   
   }
   /**
 *  This is function add meta boxs for edit product -->END
 * */
   
   /*
   This is function save details product -->START
   */
   add_action('save_post', 'save_details');
   
   function save_details(){
    global $post;
   
   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post->ID;
   }
   
    update_post_meta($post->ID, "wcs_id_product", $_POST["wcs_id_product"]);
   }
   /**
 *  This is function add meta boxs for edit product -->END
 * */

 /**
  * This is function Ajax change wcs_id_product -->START
  */
  function change_wcs_product()
  {
      $post_id= $_POST['id'];
      $status =$_POST['status'];
      if($status=='true')
      {
        update_post_meta($post_id, "wcs_id_product",'true');
      }
      else
      {
        update_post_meta($post_id, "wcs_id_product",'false');
      }
      echo $post_id;
      die();
  }
  add_action('wp_ajax_change_wcs_product','change_wcs_product');
 /**
  * This is function Ajax change wcs_id_product -->END
  */

  /**
   * This is function Ajax change category -->START
   */
  function change_category()
  {
      $category = $_POST['category'];
     ?>
      <table>
                    <tr>
                        <th class="wcs__content__product__table--th--id">ID</th>
                        <th class="wcs__content__product__table--th--name">Name</th>
                        <th class="wcs__content__product__table--th--image">Image</th>
                        <th class="wcs__content__product__table--th--featuer">Feature</th>
                    </tr>
            <?php
                $array =array(
                    'post_type' =>'product',
                    'product_cat'=>$category,
                );
                $query = new WP_Query($array);
                while($query->have_posts())
                {
                    $query->the_post();
                    ?>
                    <tr>
                        <td><p class="wcs__content__product__item--id"><?php echo get_the_ID();?></p></td>
                        <td><p class="wcs__content__product__item--title"><?php echo get_the_title();?></p></td>
                        <td><img class="wcs__content__product__itemt--img" src="<?php the_post_thumbnail_url();?>" alt=""></td>
                        <td>
                            <?php
                        if(get_post_meta(get_the_ID(),'wcs_id_product',true)=='true')      
                        {?>
                             <input class="checkbox__wcs" type="checkbox" data-value="<?php echo get_the_ID()?>" checked>
                        <?php
                        }
                        else{
                            ?>
                                <input class="checkbox__wcs" type="checkbox" data-value="<?php echo get_the_ID()?>">
                            <?php
                        }
                             ?>
                        </td>
                    </tr>    
                    <?php
                }
                    ?>
            </table>
      <?php
      wp_die();
  }
  add_action('wp_ajax_change_category','change_category');

  function action__onchange__select__category()
  {
      $category = $_POST['category'];
      ?>
                <?php
                $array= array(
                    'post_type' => 'product',
                    'product_cat' =>$category
                );
                $query = new WP_Query($array);
                while($query->have_posts())
                {
                    $query->the_post();
                    ?>
                    <option value="<?php echo get_the_ID()?>"><?php echo get_the_title();?></option>
                    <?php
                }
            ?>
      <?php
      wp_die();

  }
  add_action('wp_ajax_action__onchange__select__category','action__onchange__select__category');
  /**
   * This is function Ajax change category -->END
   */
?>
<!-- <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script> -->
