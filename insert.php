<?php
$con = mysql_connect("localhost","root","");
if (!$con)
	{
	die('could not connect: ' . mysql_error());
	}

		mysql_select_db("dbconnect", $con);

$sql="INSERT INTO tblconnect (name, address, email, schoolname, cpnumber, average) VALUES('$_POST[name]','$_POST[address]','$_POST[email]','$_POST[schoolname]','$_POST[cpnumber]','$_POST[average]')";

if (!mysql_query($sql,$con))
	{
	die('Error: ' . mysql_error());
	}
echo "1 record added";
mysql_close($con)
?>