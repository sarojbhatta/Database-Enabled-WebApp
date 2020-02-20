<?php
	require 'dbh.php';

	$bname = $_POST['entered_rating'];

	if(!is_numeric($bname)){
		header("Location: ../index.html?error=improperRating");
		exit();
	}
	
	if(empty($bname)){
			header("Location: ../index.html?error=emptyfield");
			exit();
	}
	else{
		$sql = "SELECT R.business_id, R.review_text FROM reviews R WHERE R.stars >= '?'"; 
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)){
			//echo "error at prepare";
			header("Location: ../index.html?error=sqlerror");
			exit();
		}
		else{
            $sql = "SELECT R.business_id, R.review_text FROM reviews R WHERE R.stars >= '".$bname."'";
            $result = mysqli_query($conn, $sql);
            //echo "SELECT business_name FROM business WHERE categories =".$category;
            
            if (mysqli_num_rows($result) > 0){ 
                while($row = mysqli_fetch_assoc($result)) { 
                    echo "Business_ID: " . $row["business_id"]."&emsp; Review: " . $row["review_text"]. "<br>"; 
                    //echo $row;
                }
            }
            else{
                //echo "SELECT review_text FROM reviews WHERE business_name = '".$bname."'";
                header("Location: ../index.html?response=notfound");
                exit();
            }
		}
	}
?>