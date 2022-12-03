<?php

include "../config.php";
session_start();

$message="";

if(isset($_POST['submit'])) {
  $opwd = mysqli_real_escape_string($conn,$_POST['opwd']);
  $npwd = mysqli_real_escape_string($conn,$_POST['npwd']);
  $cpwd = mysqli_real_escape_string($conn,$_POST['cpwd']);
  $uid = mysqli_real_escape_string($conn, $_SESSION['userid']);
  
  if($opwd!='' && $npwd!='' && $cpwd!='') {
    if($npwd==$cpwd) {
      $sql_query = "SELECT count(*) AS usercount FROM users WHERE id='$uid' AND password='$opwd';";
      $result = mysqli_query($conn, $sql_query);
      $row = mysqli_fetch_array($result);
      if($row['usercount']==1) {
        $sql_query = "UPDATE users SET password='$npwd' WHERE id='$uid';";
        $result = mysqli_query($conn, $sql_query);
        if($result) {
          header("Location: ../index.php");
        }
        else {
          $message = "Database error. Contact customer support";
        }
      }
      else {
        $message = "A password entered did not match";
      }
    }
    else {
      $message = "A password entered did not match";
    }
  }
  else {
    $message = "all fields are mandatory";
  }

  
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Simple changepwd Form Example</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-font-smoothing: antialiased;
    }

    body {
      background: #e35869;
      font-family: 'Rubik', sans-serif;
    }

    .changepwd-form {
      background: #fff;
      width: 500px;
      margin: 65px auto;
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
              flex-direction: column;
      border-radius: 4px;
      box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2);
    }
    .changepwd-form h1 {
      padding: 35px 35px 0 35px;
      font-weight: 300;
    }
    .changepwd-form .content {
      padding: 35px;
      text-align: center;
    }
    .changepwd-form .input-field {
      padding: 12px 5px;
    }
    .changepwd-form .input-field input {
      font-size: 16px;
      display: block;
      font-family: 'Rubik', sans-serif;
      width: 100%;
      padding: 10px 1px;
      border: 0;
      border-bottom: 1px solid #747474;
      outline: none;
      -webkit-transition: all .2s;
      transition: all .2s;
    }
    .changepwd-form .input-field input::-webkit-input-placeholder {
      text-transform: uppercase;
    }
    .changepwd-form .input-field input::-moz-placeholder {
      text-transform: uppercase;
    }
    .changepwd-form .input-field input:-ms-input-placeholder {
      text-transform: uppercase;
    }
    .changepwd-form .input-field input::-ms-input-placeholder {
      text-transform: uppercase;
    }
    .changepwd-form .input-field input::placeholder {
      text-transform: uppercase;
    }
    .changepwd-form .input-field input:focus {
      border-color: #222;
    }
    .changepwd-form button.link {
      text-decoration: none;
      background-color: lightgray;
      padding:5px 10px;
      border: none;
      color: #747474;
      letter-spacing: 0.2px;
      text-transform: uppercase;
      display: inline-block;
      margin-top: 20px;
    }
    .changepwd-form .action {
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
              flex-direction: row;
    }
    .changepwd-form .action button {
      width: 100%;
      border: none;
      padding: 18px;
      font-family: 'Rubik', sans-serif;
      cursor: pointer;
      text-transform: uppercase;
      background: #e8e9ec;
      color: #777;
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 0;
      letter-spacing: 0.2px;
      outline: 0;
      -webkit-transition: all .3s;
      transition: all .3s;
    }
    .changepwd-form .action button:hover {
      background: #d8d8d8;
    }
    .changepwd-form .action button:nth-child(1) {
      background: #2d3b55;
      color: #fff;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 4px;
    }
    .changepwd-form .action button:nth-child(1):hover {
      background: #3c4d6d;
    }
    .changepwd-form .error {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="changepwd-form">
  <form method="post" action=""> 
    <h1>changepwd</h1>
    <div class="content">
        <div class="input-field">
            <input type="password" placeholder="Old Password" name="opwd" autocomplete="new-password">
        </div>
        <div class="input-field">
            <input type="password" placeholder="New Password" name="npwd" autocomplete="new-password">
        </div>
        <div class="input-field">
            <input type="password" placeholder="Confirm New Password" name="cpwd" autocomplete="new-password">
        </div>
        <p class="error"><?php echo $message ?></p>
        <button type="submit" name="submit" class="link">SUBMIT</button>
    </div>
    
  </form>
</div>
<!-- partial -->
  <script>
    /*

inspiration: 
https://dribbble.com/shots/2292415-Daily-UI-001-Day-001-Sign-Up

*/

let form = document.querySelecter('form');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  return false;
});
  </script>

</body>
</html>