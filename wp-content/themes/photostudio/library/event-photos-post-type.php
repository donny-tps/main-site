<?php

// let's create the function for the custom type
function event_photos() {
    // creating (registering) the custom type 
    register_post_type('event_photos', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
            // let's now add all the options for this post type
            array('labels' => array(
            'name' => __('Event Photos', 'bonestheme'), /* This is the Title of the Group */
            'singular_name' => __('Event Photo', 'bonestheme'), /* This is the individual type */
            'all_items' => __('All Event Photos', 'bonestheme'), /* the all items menu item */
            'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
            'add_new_item' => __('Add New Event Photo', 'bonestheme'), /* Add New Display Title */
            'edit' => __('Edit', 'bonestheme'), /* Edit Dialog */
            'edit_item' => __('Edit Event Photos', 'bonestheme'), /* Edit Display Title */
            'new_item' => __('New Event Photo', 'bonestheme'), /* New Display Title */
            'view_item' => __('View Event Photo', 'bonestheme'), /* View Display Title */
            'search_items' => __('Search Event Photos', 'bonestheme'), /* Search Custom Type Title */
            'not_found' => __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */
            'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
        ), /* end of arrays */
        'description' => __('This is the event photos post type', 'bonestheme'), /* Custom Type Description */
        'public' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 3, /* this is what order you want it to appear in on the left hand side menu */
        'menu_icon' => 'dashicons-images-alt', /* the icon for the custom post type menu */
        'rewrite' => array('slug' => 'event-photos', 'with_front' => true), /* you can specify its url slug */
        'has_archive' => 'event-photos', /* you can rename the slug here */
        'capability_type' => 'post',
        'hierarchical' => false,
        /* the next one is important, it tells what's enabled in the post editor */
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
            ) /* end of options */
    ); /* end of register post type */

    /* this adds your post categories to your custom post type */
    register_taxonomy_for_object_type('event_dates', 'event_photos');
    /* this adds your post tags to your custom post type */
    register_taxonomy_for_object_type('event_tags', 'event_photos');
}

// adding the function to the Wordpress init
add_action('init', 'event_photos');

/*
  for more information on taxonomies, go here:
  http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

// now let's add custom categories (these act like categories)
register_taxonomy('event_dates', array('event_photos'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */ array('hierarchical' => true, /* if this is true, it acts like categories */
    'labels' => array(
        'name' => __('Events', 'bonestheme'), /* name of the custom taxonomy */
        'singular_name' => __('Event', 'bonestheme'), /* single taxonomy name */
        'search_items' => __('Search Events', 'bonestheme'), /* search title for taxomony */
        'all_items' => __('All Events', 'bonestheme'), /* all title for taxonomies */
        'parent_item' => __('Parent Events', 'bonestheme'), /* parent title for taxonomy */
        'parent_item_colon' => __('Parent Events', 'bonestheme'), /* parent taxonomy title */
        'edit_item' => __('Edit Events', 'bonestheme'), /* edit custom taxonomy title */
        'update_item' => __('Update Event', 'bonestheme'), /* update title for taxonomy */
        'add_new_item' => __('Add New Event', 'bonestheme'), /* add new title for taxonomy */
        'new_item_name' => __('New Event', 'bonestheme') /* name title for taxonomy */
    ),
    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'event'),
        )
);

// now let's add custom tags (these act like categories)
register_taxonomy('event_tags', array('event_photos'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */ array('hierarchical' => false, /* if this is false, it acts like tags */
    'labels' => array(
        'name' => __('Event Tags', 'bonestheme'), /* name of the custom taxonomy */
        'singular_name' => __('Event Tag', 'bonestheme'), /* single taxonomy name */
        'search_items' => __('Search Event Tags', 'bonestheme'), /* search title for taxomony */
        'all_items' => __('All Event Tags', 'bonestheme'), /* all title for taxonomies */
        'parent_item' => __('Parent Event Tag', 'bonestheme'), /* parent title for taxonomy */
        'parent_item_colon' => __('Parent Event Tag:', 'bonestheme'), /* parent taxonomy title */
        'edit_item' => __('Edit Event Tag', 'bonestheme'), /* edit custom taxonomy title */
        'update_item' => __('Update Event Tag', 'bonestheme'), /* update title for taxonomy */
        'add_new_item' => __('Add New Event Tag', 'bonestheme'), /* add new title for taxonomy */
        'new_item_name' => __('New Event Tag Name', 'bonestheme') /* name title for taxonomy */
    ),
    'show_admin_column' => true,
    'show_ui' => true,
    'query_var' => true,
        )
);
?>
