<?php 
if(isset($_POST['email'])){
	$email = $_POST['email'];

	if(!empty($email)){
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			echo '2';
		}else{
			// $expemail = explode('@',$email);
			// if($expemail[1] == 'eratex.co.id'){
			// 	echo '1';
			// } else {
			// 	echo '2';
			// }
			echo '1';
		}

	}
}
?>