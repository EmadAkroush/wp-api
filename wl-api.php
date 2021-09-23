
<?php

/**
 * Plugin Name: wl-api
 */
function wp_posts() {
    $args = [
        'numberposts' => 99999 ,
        'post_type' => 'post'
    ];
   $posts = get_posts($args); 
   $data = [];
   $i =0;
   foreach($posts as $post) {
       $data[$i]['id'] = $post->ID;
       $data[$i]['title'] =  $post->post_title;
       $data[$i]['content'] = $post->post_content;
       $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID , 'large');
       $i++;
   }
   return $data;
} 


add_action('rest_api_init' ,function() {

register_rest_route('wp/v1', 'posts',[
    'methods' => 'get',
    'callback' => 'wp_posts',
]);
});
