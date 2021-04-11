<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}
class HappydenCustomPostsPlugin
{
	function __construct()
	{
		add_action('init', array($this, 'happyden_service'));
		add_action('init', array($this, 'happyden_team'));

		// Projects 
		add_action('init', array($this, 'happyden_project'));
		add_action('init', array($this, 'happyden_project_category'));
		add_action('init', array($this, 'happyden_project_tags'));
	}


	

	

	/**
	 *
	 * Service Post Type
	 *
	 */
	public function happyden_service()
	{
		$labels = array(
			'name'               => _x('Service', 'post type general name', 'happyden'),
			'singular_name'      => _x('Service', 'post type singular name', 'happyden'),
			'menu_name'          => _x('Service', 'admin menu', 'happyden'),
			'name_admin_bar'     => _x('Service', 'add new on admin bar', 'happyden'),
			'add_new'            => __('Add New Service', 'happyden'),
			'add_new_item'       => __('Add New Service', 'happyden'),
			'new_item'           => __('New Service', 'happyden'),
			'edit_item'          => __('Edit Service', 'happyden'),
			'view_item'          => __('View Service', 'happyden'),
			'all_items'          => __('All Service Services', 'happyden'),
			'search_items'       => __('Search Service Services', 'happyden'),
			'parent_item_colon'  => __('Parent :', 'happyden'),
			'not_found'          => __('No Service Services found.', 'happyden'),
			'not_found_in_trash' => __('No Service Services found in Trash.', 'happyden')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'happyden'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-welcome-write-blog',
			'rewrite'            => array('slug' => 'service',  'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor', 'excerpt', 'thumbnail')
		);
		register_post_type('service', $args);
	}

	/**
	 *
	 * 	Team Custom Post Type
	 *
	 */
	public function happyden_team()
	{
		$labels = array(
			'name'               => _x('Team Member', 'post type general name', 'happyden'),
			'singular_name'      => _x('Team Member', 'post type singular name', 'happyden'),
			'menu_name'          => _x('Team Member', 'admin menu', 'happyden'),
			'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'happyden'),
			'add_new'            => __('Add New Member', 'happyden'),
			'add_new_item'       => __('Add New Member', 'happyden'),
			'new_item'           => __('New Member', 'happyden'),
			'edit_item'          => __('Edit Member', 'happyden'),
			'view_item'          => __('View Member', 'happyden'),
			'all_items'          => __('All Team Members', 'happyden'),
			'search_items'       => __('Search Team Members', 'happyden'),
			'parent_item_colon'  => __('Parent :', 'happyden'),
			'not_found'          => __('No Team Members found.', 'happyden'),
			'not_found_in_trash' => __('No Team Members found in Trash.', 'happyden')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'happyden'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-businessperson',
			'rewrite'            => array('slug' => 'team',  'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'thumbnail',  'page-attributes')
		);
		register_post_type('team', $args);
	}


	/**
	 *
	 * Project Post Type
	 *
	 */
	public function happyden_project()
	{
		$labels = array(
			'name'               => _x('Project', 'post type general name', 'happyden'),
			'singular_name'      => _x('Project', 'post type singular name', 'happyden'),
			'menu_name'          => _x('Project', 'admin menu', 'happyden'),
			'name_admin_bar'     => _x('Project', 'add new on admin bar', 'happyden'),
			'add_new'            => __('Add New Project', 'happyden'),
			'add_new_item'       => __('Add New Project', 'happyden'),
			'new_item'           => __('New Project', 'happyden'),
			'edit_item'          => __('Edit Project', 'happyden'),
			'view_item'          => __('View Project', 'happyden'),
			'all_items'          => __('All Projects', 'happyden'),
			'search_items'       => __('Search Projects', 'happyden'),
			'parent_item_colon'  => __('Parent :', 'happyden'),
			'not_found'          => __('No Projects found.', 'happyden'),
			'not_found_in_trash' => __('No Projects found in Trash.', 'happyden')
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __('Description.', 'happyden'),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'menu_icon'          => 'dashicons-id',
			'rewrite'            => array('slug' => 'project', 'with_front' => true, 'pages' => true, 'feeds' => true),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'elementor', 'editor',  'excerpt', 'thumbnail',  'page-attributes')
		);
		register_post_type('project', $args);
	}

	public function happyden_project_category()
	{
		$labels = array(
			'name'              => _x('Categories', 'taxonomy general name', 'happyden'),
			'singular_name'     => _x('Category', 'taxonomy singular name', 'happyden'),
			'search_items'      => __('Search Categories', 'happyden'),
			'all_items'         => __('All Categories', 'happyden'),
			'parent_item'       => __('Parent Category', 'happyden'),
			'parent_item_colon' => __('Parent Category:', 'happyden'),
			'edit_item'         => __('Edit Category', 'happyden'),
			'update_item'       => __('Update Category', 'happyden'),
			'add_new_item'      => __('Add New Category', 'happyden'),
			'new_item_name'     => __('New Category Name', 'happyden'),
			'menu_name'         => __('Category', 'happyden'),
		);
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-category'),
		);
		register_taxonomy('project-category', array('project'), $args);
	}

	public function happyden_project_tags()
	{
		$labels = array(
			'name'              => _x('Tags', 'taxonomy general name', 'happyden'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'happyden'),
			'search_items'      => __('Search Tags', 'happyden'),
			'all_items'         => __('All Tags', 'happyden'),
			'parent_item'       => __('Parent Tag', 'happyden'),
			'parent_item_colon' => __('Parent Tag:', 'happyden'),
			'edit_item'         => __('Edit Tag', 'happyden'),
			'update_item'       => __('Update Tag', 'happyden'),
			'add_new_item'      => __('Add New Tag', 'happyden'),
			'new_item_name'     => __('New Tag Name', 'happyden'),
			'menu_name'         => __('Tag', 'happyden'),
		);
		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'project-tag'),
		);
		register_taxonomy('project-tag', array('project'), $args);
	}
}
$Happydencases_stydyInstance = new HappydenCustomPostsPlugin;







