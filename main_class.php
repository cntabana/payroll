<?php
error_reporting(0);
require_once('openConnection.php');

class main_class{

	 function displayMembers(){

      	$db = new MyDB();
	    $sql = "SELECT * from payroll ";
		$ret = $db->query($sql);
	    
	    return $ret;
	   
	    $db->close();
     	
      }

      function import_csv_to_sqlite()
      {
				// specify connection info
			$db = new MyDB();
		
		    $csv_path = 'csv/';
			$csv_file = $csv_path . basename($_FILES['csvdoc']['name']);
           
			echo '<pre>';
			if (move_uploaded_file($_FILES['csvdoc']['tmp_name'], $csv_file)) {
			    $csvfile = fopen($csv_file, 'r');
				$theData = fgets($csvfile);
				$i = 0;
			    $ret = null;

     			while (!feof($csvfile))
				{
				   $csv_data[] = fgets($csvfile, 1024);
				   $csv_array = explode(",", $csv_data[$i]);
				   $insert_csv = array();
				   if(!empty($csv_array[0])){

				   	          $olddate = str_replace('"', ' ', $csv_array[4]);             // returns bool(false)
                              $Work_Date = strtotime(str_replace('/', '-', $olddate));  	 
                              
					                   $names = explode(" ", $csv_array[0]);        
	                                   $insert_csv['firstname'] = str_replace('"', ' ',$names[0]);
									   $insert_csv['middlename'] = str_replace('"', ' ',$names[1]);
									   $insert_csv['familyname'] = str_replace('"', ' ',$names[2]);
									   $insert_csv['Payroll_Ref']= $csv_array[1];
									   $insert_csv['Total_Hours_Worked'] = $csv_array[2];
									   $insert_csv['Total_Pay'] = $csv_array[3];
									   $insert_csv['Work_Date'] = $Work_Date;
							    
									   $query = "INSERT INTO payroll (firstname,familyname,middlename,Payroll_Ref,Total_Hours_Worked,Total_Pay,Work_Date ) VALUES
									             ('".$insert_csv['firstname']."',
									              '".$insert_csv['familyname']."',
									              '".$insert_csv['middlename']."',
									              ".$insert_csv['Payroll_Ref'].",
									              ".$insert_csv['Total_Hours_Worked'].",
									              ".$insert_csv['Total_Pay'].",
									              ".$insert_csv['Work_Date']."
									              )";

									   $ret = $db->exec($query);
									  
									  
									   $i++;

				   }
				  
				  
				} 

				fclose($csvfile);
				
				if(!$ret){
				     header('Location: index.php?warning='.$db->lastErrorMsg());
				   } else {
				    header('Location: index.php');
				   }
				
					$db->close();// closing connection
				} else {
				    echo "Possible file upload attack!\n";
				}
			}
}
  

?>