<?php

// let's create the function for the custom type
function gallery_post() {
    // creating (registering) the custom type 
    register_post_type('gallery_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
            // let's now add all the options for this post type
            array('labels' => array(
            'name' => __('Gallery', 'bonestheme'), /* This is the Title of the Group */
            'singular_name' => __('Gallery', 'bonestheme'), /* This is the individual type */
            'all_items' => __('All Gallery Posts', 'bonestheme'), /* the all items menu item */
            'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
            'add_new_item' => __('Add New Gallery', 'bonestheme'), /* Add New Display Title */
            'edit' => __('Edit', 'bonestheme'), /* Edit Dialog */
            'edit_item' => __('Edit Gallery', 'bonestheme'), /* Edit Display Title */
            'new_item' => __('New Gallery', 'bonestheme'), /* New Display Title */
            'view_item' => __('View Gallery', 'bonestheme'), /* View Display Title */
            'search_items' => __('Search Galleries', 'bonestheme'), /* Search Custom Type Title */
            'not_found' => __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ), /* end of arrays */
        'description' => __('This is the galleries area', 'bonestheme'), /* Custom Type Description */
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
        'menu_icon' => 'dashicons-format-gallery', /* the icon for the custom post type menu */
        'rewrite' => array('slug' => 'gallery', 'with_front' => false), /* you can specify its url slug */
        'has_archive' => 'gallery', /* you can rename the slug here */
        'capability_type' => 'post',
        'hierarchical' => false,
        /* the next one is important, it tells what's enabled in the post editor */
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
            ) /* end of options */
    ); /* end of register post type */
}

// adding the function to the Wordpress init
add_action('init', 'gallery_post');

/*
  for more information on taxonomies, go here:
  http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

// now let's add custom categories (these act like categories)
register_taxonomy('gallery_cat', array('gallery_type'), /* if you change the name of register_post_type( 'gallery_type', then you have to change this */ array('hierarchical' => true, /* if this is true, it acts like categories */
    'labels' => array(
        'name' => __('Gallery Categories', 'bonestheme'), /* name of the custom taxonomy */
        'singular_name' => __('Gallery Category', 'bonestheme'), /* single taxonomy name */
        'search_items' => __('Search Gallery Categories', 'bonestheme'), /* search title for taxomony */
        'all_items' => __('All Gallery Categories', 'bonestheme'), /* all title for taxonomies */
        'parent_item' => __('Parent Gallery Category', 'bonestheme'), /* parent title for taxonomy */
        'parent_item_colon' => __('Parent Gallery Category:', 'bonestheme'), /* parent taxonomy title */
        'edit_item' => __('Edit Gallery Category', 'bonestheme'), /* edit custom taxonomy title */
        'update_item' => __('Update Gallery Category', 'bonestheme'), /* update title for taxonomy */
        'add_new_item' => __('Add New Gallery Category', 'bonestheme'), /* add new title for taxonomy */
        'new_item_name' => __('New Gallery Category Name', 'bonestheme') /* name title for taxonomy */
    ),
    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'gallery-category'),
        )
);

// now let's add custom tags (these act like categories)
register_taxonomy('gallery_tag', array('gallery_type'), /* if you change the name of register_post_type( 'gallery_type', then you have to change this */ array('hierarchical' => false, /* if this is false, it acts like tags */
    'labels' => array(
        'name' => __('Gallery Tags', 'bonestheme'), /* name of the custom taxonomy */
        'singular_name' => __('Gallery Tag', 'bonestheme'), /* single taxonomy name */
        'search_items' => __('Search Gallery Tags', 'bonestheme'), /* search title for taxomony */
        'all_items' => __('All Gallery Tags', 'bonestheme'), /* all title for taxonomies */
        'parent_item' => __('Parent Gallery Tag', 'bonestheme'), /* parent title for taxonomy */
        'parent_item_colon' => __('Parent Gallery Tag:', 'bonestheme'), /* parent taxonomy title */
        'edit_item' => __('Edit Gallery Tag', 'bonestheme'), /* edit custom taxonomy title */
        'update_item' => __('Update Gallery Tag', 'bonestheme'), /* update title for taxonomy */
        'add_new_item' => __('Add New Gallery Tag', 'bonestheme'), /* add new title for taxonomy */
        'new_item_name' => __('New Gallery Tag Name', 'bonestheme') /* name title for taxonomy */
    ),
    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
        )
);
?>