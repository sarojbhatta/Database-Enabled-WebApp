<?php

	require 'dbh.php';

	$uid = $_POST['entered_userid'];
	$uname = $_POST['entered_username']; //add more attribute here if required
	$review_count = 0;

	if(empty($uid) || empty($uname)){
		header("Location: ../index.html?error=emptyfield");
		exit();
	}
	else{
		$sql = "SELECT user_id FROM users WHERE user_id= ?"; //check here -> according to database
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			echo "from 14";
			//header("Location: ../index.html?error=sqlerror");
			//exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $uid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck>0){
				header("Location: ../index.html?error=userAlreadyExist");
				exit();
			}
			else{
				$sql = "INSERT into users(user_id, review_count, name) VALUES (?, ?, ?)"; //add statement EDIT
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo "from 30";
					//header("Location: ../index.html?error=sqlerror");
					//exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "sds", $uid, $review_count, $uname); //CHECK variables
					mysqli_stmt_execute($stmt);

					header("Location: ../index.html?success=useradded");
					exit();
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	
	


//if (isset($_POST['Submit'])){ the  above} ELSE {Header - indexpage}	