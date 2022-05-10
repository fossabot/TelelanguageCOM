<?php
define('WP_USE_THEMES', false);
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);
global $post;


$args = array( 'post_type'=>'question','posts_per_page'=>1,'post__in'=>array( $_POST['post_id'] ) );
$loadposts = new WP_Query($args);

/*
if( isset($_POST['repeat']) && ( $_POST['repeat']=='yes' ) ){

}
*/

while($loadposts->have_posts()){ 
	$loadposts->the_post(); 
	$question = rwmb_meta( 'question_id' ); // Get the list of Question as array

	if( $_POST['user_id'] != 0 ){
		
	/*
	@this is the check of user quiz status
	// not = not yet attened this quiz
	// passed = already passed
	// continue = quiz time is ongoing.
	*/
	$quiz_status = 'not';
	$check = get_user_meta( $_POST['user_id'],'question-reasult-trigger',false );
	if(is_array($check)){
		if(!empty($check)){
	
			$time = rwmb_meta( 'quiz-time' );
			$time = $time*60;

			foreach ($check as $value) {
				$arr = explode( "####", $value );
				if( ( $arr[0] == $_POST['post_id'] ) && ( $arr[2] == 'done' ) ){
					$quiz_status = 'passed';
				}
				if( ( $arr[0] == $_POST['post_id'] ) && ( $arr[2] == 'continue' ) ){
					if( ( time() - $arr[1] ) >= $time  ){
						$quiz_status = 'passed';
					}else{
						$quiz_status = 'continue';
					}
				}
			}

		}
	}

	// Check the field repeatable or not
	$repeatable = 0;
	if( $repeatable == 1 ) {
		$quiz_status = 'continue';
	}



	if( ( $quiz_status == 'continue' ) || ( $quiz_status == 'not' ) ){

		/*
		 @Return the Html to ajax call Form.
		*/
		$i = 1;
	    $checker = 'no';
	    update_user_meta($_POST['user_id'],'question-reasult-trigger', $_POST['post_id'].'####'.time().'####'.'continue' );
	    
	    if(is_array($question)){
	    	foreach ($question as $value) {

		    	if( $i == $_POST['question_no'] ){
		            if( $value['question_no'] != '' ){
		                echo "<div class='quiz-title'>".$value['question_no']."</div>";
		                echo '<form id="question-area" >';
		                if( $value['ans_number1'] != '' ){ echo '<input type="radio" name="q1" value="1">'.$value["ans_number1"].'<br/>'; }
		                if( $value['ans_number2'] != '' ){ echo '<input type="radio" name="q1" value="2">'.$value["ans_number2"].'<br/>'; }
		                if( $value['ans_number3'] != '' ){ echo '<input type="radio" name="q1" value="3">'.$value["ans_number3"].'<br/>'; }
		                if( $value['ans_number4'] != '' ){ echo '<input type="radio" name="q1" value="4">'.$value["ans_number4"].'<br/>'; }
		                echo '</form>';
		                $checker = 'yes';
		            }
	    		}
	    	$i++;
	        }
	        if($checker == 'no'){ 
	        	echo "<h3>".__( 'Exam is Over', 'themeum' )."</h3><a class='back-to-home btn btn-primary' href='".esc_url(site_url())."'>".__( 'Back to Homepage', 'themeum' )."</a>"; 
	        	update_user_meta($_POST['user_id'],'question-reasult-trigger', $_POST['post_id'].'####'.time().'####'.'done' );
	        }
	    }




		if( $_POST['question_exits'] == 'yes' ){

		$s = 1;
		if( is_array($question) ){
			$total = count($question);
			$percent = round(((1/$total)*100),2);

		    	foreach ($question as $value){
			    	if( $s == $_POST['question_no'] ){  
			    		
			            if( $_POST['select_ans'] == $question[$s-2]['correct_answer'] ){
			          		//Correct Answer
			            	$var = get_user_meta($_POST['user_id'],'question-reasult',false);
			            	$code_data = array();
			            	if(!empty($var)){
			            		foreach ($var as $value){
			            			$pieces = explode( "####", $value );
			            			$code_data[$pieces[0]] = $pieces[1]; 
			            		}
			            		if(array_key_exists($_POST['post_id'],$code_data)){
			            			if( ($code_data[$_POST['post_id']] != 0) && ($code_data[$_POST['post_id']] != '')  ){
			            				$percent = $percent + $code_data[$_POST['post_id']];
			            				update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.$percent );
			            			}else{
			            				update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.$percent );
			            			}
			            		}else{
			            			update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.$percent );
			            		}
			            	}else{
			            		update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.$percent );
			            	}
			            	
			            }else{
			            	//in Correct Answer
			            	$var = get_user_meta($_POST['user_id'],'question-reasult',false);
			            	$code_data = array();
			            	if(!empty($var)){
			            		foreach ($var as $value){
			            			$pieces = explode("####", $value);
			            			$code_data[$pieces[0]] = $pieces[1]; 
			            		}
			            		if(array_key_exists($_POST['post_id'],$code_data)){
			            			if( ($code_data[$_POST['post_id']] != 0) && ($code_data[$_POST['post_id']] != '')  ){
			            				$percent = $percent - $code_data[$_POST['post_id']];
			            				if($percent <= 0){
			            					update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.'0');
			            				}else{
			            					update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.$percent);
			            				}
			            			}else{
			            				update_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.'0');
			            			}
			            		}else{
			            			add_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.'0' );
			            		}
			            	}else{
			            		add_user_meta( $_POST['user_id'],'question-reasult', $_POST['post_id'].'####'.'0' );
			            	}
			            }
		    		}
		    		$s++;
		        }
		    }

		} // Update Question Result End


	} // Quiz Status Check End


    }                
}
wp_reset_postdata();





die();
