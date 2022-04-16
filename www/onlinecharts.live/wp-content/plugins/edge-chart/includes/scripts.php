 <?php

function load_scripts() {
    // Add libraries and custom js here
	wp_enqueue_script('d3js-lib', 'https://d3js.org/d3.v7.min.js', array());
	wp_enqueue_script('observable', STRIPE_BASE_URL . 'includes/js/HEBgraph.js', array());
	wp_enqueue_script('runtime', STRIPE_BASE_URL . 'includes/js/runtime.js', array());
	wp_enqueue_script('script', STRIPE_BASE_URL . 'includes/js/script.js', array('d3js-lib', 'runtime', 'observable', 'jquery'));
	wp_enqueue_style('styles', STRIPE_BASE_URL . 'includes/inspector.css');
	wp_localize_script('script', 'chart_vars', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'load_scripts');


// Add type tag to observable and runtime
function add_type_attribute($tag, $handle, $src) {

    if ('observable' === $handle || 'runtime' === $handle || 'script' === $handle) {
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
