<?php


/**
 * Plugin name:AB post slider 
 * Plugin URI: https://github.com/ab-post-slider
 * Description:Post slider
 * Version: 1.0.0
 * Author:Anel Balalic
 * 
 */

//prevent direct access to file
if(!defined('ABSPATH')){
   exit;
}

function ab_display_specific_posts($atts){

      $atts=shortcode_atts([
        'ids' => ''
      ],$atts);

      $post_ids=explode(',', $atts['ids']); //1,2,3

      $args=[
          'post_type' =>'post',
          'post__in'=>$post_ids,
          'orderby'=>'post__in',
      ];

      $query=new WP_Query($args);

      if(!$query->have_posts()){
        return '<p>No posts found</p>';

      }
       //start outputing buffer
      ob_start();

      if($query->have_posts()){
         while($query->have_posts())
            $query->the_post();
             ?>


           <h2><?php the_title(); ?></h2> 
            <h2><?php the_content(); ?></h2>
    <?php
    
   }

   wp_reset_postdata();

   //get the contents of the output buffer and clean it up
   return ob_get_clean();
};

add_shortcode('ab_slider','ab_display_specific_posts');