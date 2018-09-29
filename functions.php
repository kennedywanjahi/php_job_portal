<?php
function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));


}










function confirmQuery($result) {

    global $connection;

    if(!$result ) {

          die("QUERY FAILED ." . mysqli_error($connection));


      }


}











function addEmployer()
{
  global $connection;
  $industry = $_POST['category'];
  $name = $_POST["name"];
  $mobile = $_POST["mobile"];
  $email = $_POST["email"];
  $city = $_POST['city'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $password = $_POST["password1"];
  $password2 = $_POST["password2"];

  if ($password === $password2) {
    $query = "INSERT INTO employers (`Name`, `Mobile`, `Industry`, `City`)";
    $query .="VALUES ('{$name}', '{$mobile}', '{$industry}', '{$city}')";
     $add_employer_query= mysqli_query($connection, $query);
     if(!$add_employer_query){
       die("QUERY FAILED" .mysqli_error($connection));
     }
     $password = md5($password);
     $query = "INSERT INTO employer_accounts (`Email`, `Company_name`, `Password`, `First_name`, `Last_name`)";
     $query .="VALUES ('{$email}', '{$name}', '{$password}', '{$fname}', '{$lname}' )";
      $add_employer_account= mysqli_query($connection, $query);
      if(!$add_employer_account){
        die("QUERY FAILED" .mysqli_error($connection));
      }
      echo "<h1 style='text-align:center;'>Employer account Added successfully</h1>" ;

  }else {
    echo "<h1>Passwords do not match</h1>" ;
  }
}






function showIndustry()
{
  global $connection;
  $query = "SELECT * FROM industry";
  $showIndustry_query = mysqli_query($connection,$query);
  confirmQuery($showIndustry_query);
  while($row = mysqli_fetch_assoc($showIndustry_query )) {
  $cat_id = $row['Id'];
  $cat_title = $row['Name'];
      echo "<option value='$cat_title'>{$cat_title}</option>";
  }

}










function loginEmployer()
{ global $connection;
  $password = escape($_POST["password"]);
  $email = escape($_POST["email"]);
  $passwordmd5 = md5($password);

  /*************Query To Check if username Exists***/
  $query = "SELECT * FROM employer_accounts WHERE Email = '{$email}' ";
  $select_employer_accounts =mysqli_query($connection,$query);
  confirmQuery($select_employer_accounts);
  /*************Query***/
  while ($row = mysqli_fetch_array($select_employer_accounts)) {
      $db_Email = $row['Email'];
      $db_company = $row['Company_name'];
      $db_Password = $row['Password'];
      $db_Status = $row['Status'];




    }
    if (!$db_Email) {

      echo "<script>alert('Incorrect credentials, try again');</script>";
      echo '<script>window.location="index.php?source=account" </script>';

    }
    $db_Passwordmd5 = md5($db_Password);
    if ($email === $db_Email && $passwordmd5 === $db_Password) {
       $_SESSION['account_operator'] = $db_Email;
       $_SESSION['company'] = $db_company;
       $_SESSION['account_status'] = $db_Status;

       if($_SESSION['account_status'] == 1){

       echo '<script>window.location="home.php" </script>';
       }else {
      echo "account unapproved";
  }
}else {
  echo "<script>alert('Incorrect credentials, try again');</script>";
}

}









function employerAddJob()
{
  global $connection;
  $companyName = $_SESSION['company'];
  $jobPosition = mysqli_real_escape_string($connection, $_POST['jobPosition']);
  $jobDescription = mysqli_real_escape_string($connection, $_POST['jobDescription']);
  $jobQualifications = mysqli_real_escape_string($connection, $_POST['jobQualifications']);
  $jobStatus = mysqli_real_escape_string($connection, $_POST['jobStatus']);
  $companyEmail = mysqli_real_escape_string($connection, $_POST['companyEmail']);
  $companyTelephone = mysqli_real_escape_string($connection, $_POST['companyTelephone']);
          $query = "INSERT INTO jobs(`Company`, `Position`, `Description`, `Qualifications`, `Status`, `Email`, `Telephone`)";
          $query .="VALUES ('{$companyName}', '{$jobPosition}', '{$jobDescription}', '{$jobQualifications}', '{$jobStatus}', '{$companyEmail}',
          '{$companyTelephone}')";
           $add_job_query= mysqli_query($connection, $query);

           if(!$add_job_query){
             die("QUERY FAILED" .mysqli_error($connection));
           }
           echo "<script>alert('Job Opening Added successfully');</script>";
           echo '<script>window.location="jobs.php" </script>';
}









function employerViewJobs()
{
  global $connection;
  $query = "SELECT * FROM jobs WHERE Company = '{$_SESSION['company']}'";
  $select_orders =
  mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($select_orders)){
    $job_id = $row['Id'];
    $companyName = $row['Company'];
    $jobPosition = $row['Position'];
    $jobDescription = $row['Description'];
    $jobQualifications = $row['Qualifications'];
    $jobStatus = $row['Status'];
    $companyEmail = $row['Email'];
    $companyTelephone = $row['Telephone'];
    $posted = $row['Date_posted'];
    echo "<tr>";
                echo "<td class='tbl-logo'><img src='img/job-logo1.png'></td>";
                echo "<td class='tbl-title'><h4>{$jobPosition}</h4></td>";
                echo "<td><p>{$jobQualifications}</p></td>";
                if ($jobStatus == 1) {
                  echo "<td><p>AVAILABLE</p></td>";
                }
                else {
                  echo "<td><p>UNAVAILABLE</p></td>";
                }
                echo "<td class='tbl-apply'><a href=''>View Applications</a></td>";
                if ($jobStatus == 1) {
                  echo "<td class='tbl-apply'><a href='jobs.php?close=$job_id'>Close Availability</a></td>";
                }
                else {
                  echo "<td class='tbl-apply'><a href='jobs.php?open=$job_id'>Open Availability</a></td>";
                }
                echo "<td class='tbl-apply'><a href=''>Edit</a></td>";
                echo "<td class='tbl-apply'><a href='jobs.php?delete=$job_id'>Delete</a></td>";





    echo "</tr>";


  }
}









function employerOpenJobs()
{
  global $connection;
  $query = "SELECT * FROM jobs WHERE Company = '{$_SESSION['company']}' && Status = 1 order by Id DESC";
  $select_all_jobs = mysqli_query($connection,$query);
  $open_jobs_count = mysqli_num_rows($select_all_jobs);
  confirmQuery($select_all_jobs);
  $_SESSION['open_job_count'] = $open_jobs_count;
}









function closePosition()
{
  global $connection;
  $action = escape($_GET['close']);
  $query = "UPDATE jobs SET Status = 0  WHERE Id = '$action'";
  $closePosition = mysqli_query($connection, $query);
  echo '<script>window.location="./jobs.php" </script>';
}









function openPosition()
{
  global $connection;
  $action = escape($_GET['open']);
  $query = "UPDATE jobs SET Status = 1  WHERE Id = '$action'";
  $openPosition = mysqli_query($connection, $query);
  echo '<script>window.location="./jobs.php" </script>';
}







 ?>