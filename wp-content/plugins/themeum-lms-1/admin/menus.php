<?php

function themeum_lms_settings() {
	?>
    <form id="themeum-lms-options" role="form" method="post" action="options.php">

        <?php settings_fields('themeum_lms_options'); ?>

        <h2><?php _e('General Settings', 'themeum-lms'); ?></h2>
        <table class="form-table">
        	<tbody>

        		<tr>
        			<th scope="row"><label for="paypal_curreny_code"><?php _e('Currency', 'themeum-lms'); ?></label></th>
        			<td>
        				<select id="paypal_curreny_code" name="paypal_curreny_code"> 
        					<?php $currency_code = get_option('paypal_curreny_code'); ?>
							<option <?php if( $currency_code == "AUD"){ echo 'selected'; }  ?> value="AUD"><?php _e('Australian Dollar($)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "BRL"){ echo 'selected'; }  ?> value="BRL"><?php _e('Brazilian Real(R$)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "CAD"){ echo 'selected'; }  ?> value="CAD"><?php _e('Canadian Dollar($)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "CZK"){ echo 'selected'; }  ?> value="CZK"><?php _e('Czech Koruna(Kč)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "DKK"){ echo 'selected'; }  ?> value="DKK"><?php _e('Danish Krone(kr.)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "EUR"){ echo 'selected'; }  ?> value="EUR"><?php _e('Euro(€)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "HKD"){ echo 'selected'; }  ?> value="HKD"><?php _e('Hong Kong Dollar(HK$)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "HUF"){ echo 'selected'; }  ?> value="HUF"><?php _e('Hungarian Forint(Ft)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "ILS"){ echo 'selected'; }  ?> value="ILS"><?php _e('Israeli New Sheqel(₪)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "JPY"){ echo 'selected'; }  ?> value="JPY"><?php _e('Japanese Yen(¥)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "MYR"){ echo 'selected'; }  ?> value="MYR"><?php _e('Malaysian Ringgit(RM)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "MXN"){ echo 'selected'; }  ?> value="MXN"><?php _e('Mexican Peso(Mex$)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "NOK"){ echo 'selected'; }  ?> value="NOK"><?php _e('Norwegian Krone(kr)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "NZD"){ echo 'selected'; }  ?> value="NZD"><?php _e('New Zealand Dollar($)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "PHP"){ echo 'selected'; }  ?> value="PHP"><?php _e('Philippine Peso(₱)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "PLN"){ echo 'selected'; }  ?> value="PLN"><?php _e('Polish Zloty(zł)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "GBP"){ echo 'selected'; }  ?> value="GBP"><?php _e('Pound Sterling(£)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "RUB"){ echo 'selected'; }  ?> value="RUB"><?php _e('Russian Ruble(₽)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "SGD"){ echo 'selected'; }  ?> value="SGD"><?php _e('Singapore Dollar($)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "SEK"){ echo 'selected'; }  ?> value="SEK"><?php _e('Swedish Krona(kr)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "CHF"){ echo 'selected'; }  ?> value="CHF"><?php _e('Swiss Franc(CHF)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "TWD"){ echo 'selected'; }  ?> value="TWD"><?php _e('Taiwan New Dollar(角)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "THB"){ echo 'selected'; }  ?> value="THB"><?php _e('Thai Baht(฿)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "TRY"){ echo 'selected'; }  ?> value="TRY"><?php _e('Turkish Lira(TRY)', 'themeum-lms'); ?></option>
							<option <?php if( $currency_code == "USD"){ echo 'selected'; }  ?> value="USD"><?php _e('U.S. Dollar($)', 'themeum-lms'); ?></option>
						</select>
        			</td>
        		</tr>


				<tr>
					<th scope="row"><label for="paypal_payment_checkout_page_id"><?php _e('Checkout Page','themeum-lms'); ?></label></th>
					<td>
						<?php
						$paypal_payment_checkout_page_id = '<select name="paypal_payment_checkout_page_id" id="paypal_payment_checkout_page_id">';
						foreach ( get_all_page_ids() as $value) {
							$page_title_all = get_post($value);
							if( get_option('paypal_payment_checkout_page_id') == $value ){
								$paypal_payment_checkout_page_id .= '<option selected="selected" value="'.$value.'">'.$page_title_all->post_title.'</option>';
							}
							else{
								$paypal_payment_checkout_page_id .= '<option value="'.$value.'">'.$page_title_all->post_title.'</option>';
							}
						}
						$paypal_payment_checkout_page_id .= '</select>';

						echo $paypal_payment_checkout_page_id;
						?>
					</td>
				</tr>

				
				<tr>
					<th scope="row"><label for="payment_success_page"><?php _e('Payment Success Return Page','themeum-lms'); ?></label></th>
					<td>
						<?php
						$payment_success_page = '<select name="payment_success_page" id="payment_success_page">';
						foreach ( get_all_page_ids() as $value) {
							$page_title_all = get_post($value);
							if(get_option('payment_success_page')==get_page_link($value)){
								$payment_success_page .= '<option selected="selected" value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
							else{
								$payment_success_page .= '<option value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
						}
						$payment_success_page .= '</select>';

						echo $payment_success_page;
						?>
					</td>
				</tr>

				<tr>
					<th scope="row"><label for="payment_cancel_page"><?php _e('Payment Cancel Return Page','themeum-lms'); ?></label></th>
					<td>
						<?php
						$payment_cancel_page = '<select name="payment_cancel_page" id="payment_cancel_page">';

						foreach ( get_all_page_ids() as $value) {
							$page_title_all = get_post($value);
							if(get_option('payment_cancel_page')==get_page_link($value)){
								$payment_cancel_page .= '<option selected="selected" value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
							else{
								$payment_cancel_page .= '<option value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
						}
						$payment_cancel_page .= '</select>';

						echo $payment_cancel_page;
						?>
					</td>
				</tr>


				<tr>
					<th scope="row"><label for="certificate_page"><?php _e('Certificate Page','themeum-lms'); ?></label></th>
					<td>
						<?php
						$certificate_page = '<select name="certificate_page" id="certificate_page">';

						foreach ( get_all_page_ids() as $value) {
							$page_title_all = get_post($value);
							if(get_option('certificate_page')==get_page_link($value)){
								$certificate_page .= '<option selected="selected" value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
							else{
								$certificate_page .= '<option value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
						}
						$certificate_page .= '</select>';

						echo $certificate_page;
						?>
					</td>
				</tr>



				<tr>
					<th scope="row"><label for="quiz_page"><?php _e('Quiz Page','themeum-lms'); ?></label></th>
					<td>
						<?php
						$quiz_page = '<select name="quiz_page" id="quiz_page">';

						foreach ( get_all_page_ids() as $value) {
							$page_title_all = get_post($value);
							if(get_option('quiz_page')==get_page_link($value)){
								$quiz_page .= '<option selected="selected" value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
							else{
								$quiz_page .= '<option value="'.get_page_link($value).'">'.$page_title_all->post_title.'</option>';
							}
						}
						$quiz_page .= '</select>';

						echo $quiz_page;
						?>
					</td>
				</tr>


        	</tbody>
        </table>

        <hr>

        <h2><?php _e('Paypal', 'themeum-lms'); ?></h2>
        <p><?php _e('PayPal standard works by sending customers to PayPal where they can enter their payment information.', 'themeum-lms'); ?></p>
		<table class="form-table">
        	<tbody>
        		<tr>
        			<th scope="row"><label for="enable_paypal_payment"><?php _e('Enable/Disable', 'themeum-lms'); ?></label></th>
        			<td>
        				<select  id="enable_paypal_payment" name="enable_paypal_payment">
							<?php
								$enable_paypal = get_option('enable_paypal_payment');
							?>
							<option value="<?php echo $enable_paypal; ?>"><?php if( $enable_paypal == '1' ){ _e('Enable','themeum-lms'); }else{ _e('Disable','themeum-lms'); } ?></option>
							<?php if( $enable_paypal == '1' ){  ?>
							 	<option value="0"><?php _e('Disable','themeum-lms'); ?></option>
							 <?php	}else{ ?>
								<option value="1"><?php _e('Enable','themeum-lms'); ?></option>
							 <?php	}  ?>
						</select>
        			</td>
        		</tr>

        		<tr valign="top">
					<th scope="row"><label for="paypal_email_address"><?php _e('Paypal Email Address','themeum-lms'); ?></label></th>
					<td><input type="text" id="paypal_email_address" name="paypal_email_address" value="<?php echo get_option('paypal_email_address'); ?>" class="regular-text" /></td>
				</tr>

        		<tr>
					<th scope="row"><label for="paypal_mode"><?php _e('PayPal','themeum-lms'); ?> </label></th>
					<td>
						<select  id="paypal_mode" name="paypal_mode">
							<?php
								$mode_paypal = get_option('paypal_mode');
							?>
							<option value="<?php echo $mode_paypal; ?>"><?php if( $mode_paypal == 'real' ){ _e('PayPal','themeum-lms'); }else{ _e('PayPal Sandbox','themeum-lms'); } ?></option>
							<?php if( $mode_paypal == 'real' ){  ?>
							 	<option value="developer"><?php _e('PayPal Sandbox','themeum-lms'); ?></option>
							 <?php	}else{ ?>
								<option value="real"><?php _e('PayPal','themeum-lms'); ?></option>
							 <?php	}  ?>
						</select>
					</td>
				</tr>
				
				<?php do_action('themeum_lms_payment_method'); ?>

        	</tbody>
        </table>

        <?php submit_button(); ?>
    </form>
	
	<hr>
    <h2><?php _e('Export Order Data', 'themeum-lms'); ?></h2>
	<form name="data-export-form" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>" method="post" id="data-export-form">
	<input type="hidden" name="action" value="order_data_export">
	<button id="dataexport" type="submit"><span class="dashicons dashicons-redo"></span> Export Order</button>
	</form>
    <?php
}

function themeum_admin_menu(){
	add_menu_page( __( 'Themeum LMS', 'themeum-lms' ), __( 'Themeum LMS', 'themeum-lms' ), 'administrator', 'edit.php?post_type=course', null, 'dashicons-welcome-learn-more' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Course Categories', 'themeum-lms' ), __( 'Course Categories', 'themeum-lms' ), 'administrator', 'edit-tags.php?taxonomy=course_cat&post_type=course' );
	add_submenu_page( 'edit.php?post_type=course', __( 'All Lessons', 'themeum-lms' ), __( 'Lessons', 'themeum-lms' ), 'administrator', 'edit.php?post_type=lesson' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Teachers', 'themeum-lms' ), __( 'Teachers', 'themeum-lms' ), 'administrator', 'edit.php?post_type=teacher' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Teacher Categories', 'themeum-lms' ), __( 'Teacher Categories', 'themeum-lms' ), 'administrator', 'edit-tags.php?taxonomy=teacher_cat&post_type=teacher' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Students', 'themeum-lms' ), __( 'Students', 'themeum-lms' ), 'administrator', 'edit.php?post_type=student' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Student Categories', 'themeum-lms' ), __( 'Student Categories', 'themeum-lms' ), 'administrator', 'edit-tags.php?taxonomy=student_cat&post_type=student' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Questions', 'themeum-lms' ), __( 'Questions', 'themeum-lms' ), 'administrator', 'edit.php?post_type=question' );
	add_submenu_page( 'edit.php?post_type=course', __( 'All Events', 'themeum-lms' ), __( 'Events', 'themeum-lms' ), 'administrator', 'edit.php?post_type=event' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Event Categories', 'themeum-lms' ), __( 'Event Categories', 'themeum-lms' ), 'administrator', 'edit-tags.php?taxonomy=event_cat&post_type=event' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Event Speakers', 'themeum-lms' ), __( 'Event Speakers', 'themeum-lms' ), 'administrator', 'edit.php?post_type=speaker' );
	add_submenu_page( 'edit.php?post_type=course', __( 'Themeum Settings', 'themeum-lms' ), __( 'Settings', 'themeum-lms' ), 'administrator', 'themeum_lms_settings', 'themeum_lms_settings' );
	add_submenu_page( 'edit.php?post_type=course', __( 'All Orders', 'themeum-lms' ), __( 'All Orders', 'themeum-lms' ), 'administrator', 'edit.php?post_type=lmsorder' );
}

add_action( 'admin_menu', 'themeum_admin_menu' );


function register_themeum_lms_settings() {
	add_option( 'paypal_email_address', 'example@example.com');
	add_option( 'paypal_curreny_code', 'USD');
	add_option( 'paypal_mode', 'developer');
	add_option( 'payment_success_page', '');
	add_option( 'payment_cancel_page', '');
	add_option( 'certificate_page', '');
	add_option( 'quiz_page', '');
	add_option( 'enable_paypal_payment', '1');
	add_option( 'paypal_payment_checkout_page_id', '');

	register_setting( 'themeum_lms_options', 'enable_paypal_payment');
	register_setting( 'themeum_lms_options', 'paypal_payment_checkout_page_id');
	register_setting( 'themeum_lms_options', 'paypal_email_address');
	register_setting( 'themeum_lms_options', 'paypal_curreny_code');
	register_setting( 'themeum_lms_options', 'paypal_mode');
	register_setting( 'themeum_lms_options', 'payment_success_page');
	register_setting( 'themeum_lms_options', 'payment_cancel_page');
	register_setting( 'themeum_lms_options', 'certificate_page');
	register_setting( 'themeum_lms_options', 'quiz_page');
} 
add_action( 'admin_init', 'register_themeum_lms_settings' );


function themeum_lms_admin_menu_highlight() {
	global $parent_file, $submenu_file, $post_type;

	switch ( $post_type ) {

		case 'course' :
		$screen = get_current_screen();

		if ( 'course_cat' == $screen->taxonomy ) {
			$submenu_file = 'edit-tags.php?taxonomy=course_cat&post_type=course';
		}

		break;
	}
}

add_action( 'admin_head', 'themeum_lms_admin_menu_highlight' );


// Order Data Export 
function order_data_export(){
	    $args = array( 'post_type' => 'lmsorder','posts_per_page' => -1 );
	    $e_query = new WP_Query($args);
	    $data = array();
	    while ( $e_query->have_posts() ) :  $e_query->the_post();
	       $array  = array();
	       $array['course_name'] = get_the_title();
	       $array['product_id'] = rwmb_meta('themeum_order_course_id');
	       $array['user_id'] = rwmb_meta('themeum_order_user_id');
	       $array['price'] = rwmb_meta('themeum_order_price'); 
	       $array['payment_id'] = rwmb_meta('themeum_payment_id');
	       $array['order_status'] = rwmb_meta('themeum_status_all');
	       $array['date'] = get_the_time('d-m-Y'); 
	       $data[] = $array;
	    endwhile;
	    wp_reset_query();

	    $arr_condition = array("course_name", "product_id", "user_id","price","payment_id","order_status","date");
	    $csv_header = array("Course Name", "Product ID", "User ID","Price","Payment ID","Order Status","Date");

	    
	    $csv_string =  implode(",", $csv_header)."\n";
	    $count = count($arr_condition);
	    
	    foreach($data as $key) {
	            $i=0;
	            foreach( $arr_condition as $value ) {
	                $i++;
	                if(!isset($key[$value])){  $raw_value = "";  }else{ $raw_value = $key[$value]; }
	                    if($i==$count){
	                        $csv_string .= '"'.$raw_value.'"'."\n";
	                    }
	                    else{
	                        $csv_string .= '"'.$raw_value.'"'.",";
	                    }
	            }
	        }
	        
	        $file_name = date("d-m-y") . '.csv';
	        header('Content-Type: application/csv'); 
	        header('Content-Disposition: attachment; filename="' . $file_name . '"'); 
	        echo $csv_string;
 	    }
add_action('wp_ajax_order_data_export', 'order_data_export');
add_action('wp_ajax_nopriv_order_data_export', 'order_data_export');  