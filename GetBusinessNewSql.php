<?php		
		require 'dbh.php';

		$category = $_POST['entered_category'];

		if(empty($category)){
			header("Location: ../index.html?error=emptyfield");
			exit();
		}
		else{
			$sql = "SELECT business_name FROM business WHERE categories LIKE '%?%'"; //'%?%' -> '".%."?".%."'" categories LIKE '%?%'" 
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt, $sql)){
				//echo "error prepare";
				header("Location: ../index.html?error=sqlerror");
				exit();
			}
			else{
                $sql = "SELECT business_id, business_name FROM business WHERE categories LIKE '%".$category."%'";
                $result = mysqli_query($conn, $sql);
                //echo "SELECT business_name FROM business WHERE categories =".$category;
                
                if (mysqli_num_rows($result) > 0){ 
                    while($row = mysqli_fetch_assoc($result)) { 
                        echo "business_id: " . $row["business_id"]. "&emsp; Name: " . $row["business_name"]. "<br>"; 
                    }
                }
				else{
					header("Location: ../index.html?response=notfound");
					exit();
				}
			}

        }
    mysqli_close($conn);
?>