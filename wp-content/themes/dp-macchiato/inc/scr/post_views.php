<?php
function dp_count_post_views($post_ID, $update = false) {
	//Set the name of the Posts Custom Field.
	$count_key = 'post_views_count';
	//Returns values of the custom field with the specified key from the specified post.
	$count = get_post_meta($post_ID, $count_key, true);
	
	//If the the Post Custom Field value is empty. 
	if ( $count == null ) {
		$count = 0; // set the counter to zero.
		//Delete all custom fields with the specified key from the specified post. 
		delete_post_meta($post_ID, $count_key); 
		//Add a custom (meta) field (Name/value)to the specified post.
		add_post_meta($post_ID, $count_key, 0);
		
	} else {	//If the the Post Custom Field value is NOT empty.
		if ($update) {
			//increment the counter by 1.
			//Update the value of an existing meta key (custom field) for the specified post.
			$count++;
			update_post_meta($post_ID, $count_key, $count);
		}
	}

	// Do action
	do_action( 'dp_count_post_views', array($post_ID, $update) );
}

//Gets the  number of Post Views to be used later.
function dp_get_post_views($post_ID, $meta_key){
	$meta_key = empty($meta_key) ? 'post_views_count' : $meta_key;
	//Returns values of the custom field with the specified key from the specified post.
	$count = get_post_meta($post_ID, $meta_key, true);
	return $count;
}

//Function that Adds a 'Views' Column to your Posts tab in WordPress Dashboard.
function dp_post_column_views($newcolumn){
	//Retrieves the translated string, if translation exists, and assign it to the 'default' array.
	$newcolumn['post_views'] = __('Views', 'DigiPress');
	return $newcolumn;
}
//Hooks a function to a specific filter action.
//applied to the list of columns to print on the manage posts screen.
add_filter('manage_posts_columns', 'dp_post_column_views');


//Function that Populates the 'Views' Column with the number of views count.
function post_custom_column_views($column_name, $id){
	
	if($column_name === 'post_views'){
		// Display the Post View Count of the current post.
		// get_the_ID() - Returns the numeric ID of the current post.
		echo dp_get_post_views(get_the_ID(), null);
	}
}
//Hooks a function to a specific action. 
//allows you to add custom columns to the list post/custom post type pages.
//'10' default: specify the function's priority.
//and '2' is the number of the functions' arguments.
add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);
?>