<?php
/*
Plugin Name: Edge Chart Plugin
Description: This plugin enables the heirarchical edge bundling graph features to function on wordpress.
Author: Jamie Butler
Version: 1.0
*/

/**********************************
* constants and globals
**********************************/

if(!defined('STRIPE_BASE_URL')) {
	define('STRIPE_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('STRIPE_BASE_DIR')) {
	define('STRIPE_BASE_DIR', dirname(__FILE__));
}

/**********************************
* includes
**********************************/

include(STRIPE_BASE_DIR . '/includes/scripts.php');
include(STRIPE_BASE_DIR . '/includes/shortcodes.php');


/*
Ajax call to enable the create_datalist function to execute asynchronously 
*/
add_action("wp_ajax_create_datalist", "create_datalist");
add_action("wp_ajax_nopriv_create_datalist", "create_datalist");

function create_datalist() {
	/*
	Executes two Python scripts to begin processing user uploaded network
	*/

	//Italian flag state
	$tickbox = $_POST['tag'];
	echo $tickbox;

	$command = "python3 ../py/write_node_pairs.py " . $tickbox;

	error_log(shell_exec($command));

	$command = "python3 ../py/write_node_list.py";

	error_log(shell_exec($command));

	echo "Done";
	wp_die();

}


/*
Ajax call to enable the load_chart function to execute asynchronously 
*/
add_action("wp_ajax_nopriv_load_chart", "load_chart");
add_action("wp_ajax_load_chart", "load_chart");

function load_chart() {
	/*
	Executes load_dataset to create dataset for the heirarchical edge bundling chart
	*/

	//User input of root node
	$input = $_POST['root'];

	//Italian flag state
	$tickbox = $_POST['tag'];

	$command = "python3 ../py/load_dataset.py " . $input . " " . $tickbox;

	$output = shell_exec($command);
	
	//print output through to JS Ajax call
	echo $output;
	wp_die();
}


/*
Ajax call to enable the delete_uploads function to execute asynchronously 
*/
add_action("wp_ajax_nopriv_delete_uploads", "delete_uploads");
add_action("wp_ajax_delete_uploads", "delete_uploads");

function delete_uploads() {
	/*	
	Clears the database of user uploaded files
	*/

	// Location of user uploaded files
	$dir = "../wp-content/uploads/wp_dndcf7_uploads/wpcf7-files";

	// Iterate through and delete all files uploaded by users
	if(file_exists($dir)){
    		$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    		$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
    		foreach ( $ri as $file ) {
        		$file->isDir() ?  rmdir($file) : unlink($file);
    		}
	}

	wp_die();

}


