<?php
   require 'dbconnection.php';
   if(isset($_POST[submit])){
     $name =$_POST["name"];
     $age =$_POST["age"];
    $country =$_POST["country"];
      $gender =$_POST["gender"];
      $language =$_POST["language"];
      $language = "";
      foreach($language as $row)
{
          $language .= $row . ", ";
    }
    $query = "INSERT INTO tblstudentinfo VALUES('', '$name', '$age', '$country', '$gender','language')";
    mysqli_query($conn, $query);
    echo 
    "
       <script> alert ('Data Inserted Successfully'); </script>
    ";
}
?>

<!DOCTYPE html>
<html lang ="en" dir=ltr>
<head><h1> INSERT RECORD HERE </head></h1> <br>
<meta charset ="utf-8">
  <title> INSERT RECORD HERE!</title>
    <body>
     <form class =""  action="" method = "post" autocomplete="off">         
      <label for =""> NAME</label><br>
      <input type = "number" name = "Name"> </p>
       <label for =""> AGE</label><br>
      <input type = "number" name = "Age"> </p>
      <label for =""> COUNTRY</label><br>
      <select class=""  name="country" required>
         <option value="" selected hidden>Select Country </option><br>
        <option value = "Philippines"> Philippines </option>
         <option value = "USA"> USA </option>
        <option value = "JAPAN"> Japan </option>
          <option value = "SINGAPORE"> Singapore </option>
          </select> <p>
            <label for =""> GENDER</label><br>
         <input type = "radio" name = "gender" value ="Male" required> Male <br>
           <input type = "radio" name = "gender" value ="Female" required> Female <br><p>
           <label for =""> LANGUAGE</label><br>
            <input type = "checkbox" name = "language[]" value ="English" >English
            <input type = "checkbox" name = "language[]" value ="Chinese" >Chinese
             <input type = "checkbox" name = "language[]" value ="Tagalog" >Tagalog
            <br> <p>
<button type="submit" name = "submit">SUBMIT </button><p><br>

</form>
    </body>
</html>