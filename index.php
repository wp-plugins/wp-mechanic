<?php 



/*



Plugin Name: WP Mechanic



Plugin URI: http://www.websitedesignwebsitedevelopment.com/wordpress-mechanic



Description: WordPress mechanic is a combination of FAQ feeds, blogging, consolidated tips and suggestions from WordPress gurus on your dashboard.



Version: 1.2.3



Author: Fahad Mahmood 



Author URI: http://www.androidbubbles.com



License: GPL3



*/ 



	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        global $info_file;
        global $how_it_works;
        global $sitting_time;
        global $admin_email;
        global $auth_file;
        
        $info_file = dirname(__FILE__).'/info.dat';
        $auth_file = dirname(__FILE__).'/auth.dat';
        $admin_email = get_bloginfo('admin_email');
        
        include('functions.php');
        

        


	function wm_menu()



	{



		 //add_options_page('WordPress Mechanic', 'WordPress Mechanic', 'update_core', 'wp_mechanic', 'wp_mechanic');



	}

	function wp_mechanic() 



	{ 



		if ( !current_user_can( 'update_core' ) )  {



			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );



		}



		global $wpdb; 

		

		

	
	
		

			



	}	

        

        function register_wm_scripts() {
                
                wp_register_style( 'wm-style', plugins_url('style.css', __FILE__) );
		
                wp_enqueue_style('wm-style');
                
                wp_register_script( 'wm-script', plugins_url('wm_scripts.js', __FILE__) );
                
                wp_enqueue_script('jquery');

                wp_enqueue_script('jquery-ui-accordion');

                wp_enqueue_script('wm-script');
                
	}	

	

	register_activation_hook(__FILE__, 'wm_start');



	register_deactivation_hook(__FILE__, 'wm_end' );




	add_action( 'admin_menu', 'wm_menu' );	


        add_action( 'admin_enqueue_scripts', 'register_wm_scripts' );
	add_action('wp_dashboard_setup', 'wm_add_dashboard_widgets' );

	
        add_action('init', 'wm_sync');
	add_action('wp_ajax_wmpost_question', 'wmpost_question');