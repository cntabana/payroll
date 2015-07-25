
<?php
require_once('openConnection.php');
   
$db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully<br>";
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS payroll
      (
      firstname           varchar(20),
      familyname           varchar(20),
      middlename           varchar(20),
      Payroll_Ref TEXT    ,
      Total_Hours_Worked INTEGER ,
      Total_Pay REAL,
      Work_Date NUMERIC);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo $sql;
   }
   $db->close();
?>