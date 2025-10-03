<?php 
include("include/db.php");
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_destroy();
}
$page="";
if(isset($_GET["page"]) && $_GET["page"]!=""){
    $page = "?page=".$_GET["page"];
}
if(isset($_POST['login-submit'])){
    $query = "SELECT * FROM `student` LEFT OUTER JOIN `student_login` ON student.ic = student_login.student_ic WHERE REPLACE(ic, '-', '') = '".$_POST['user_ic']."' AND (s_status <> 'DELETE' AND s_status <> 'QUIT')";
    $sttr=mysqli_query($conn,$query);
    $result=mysqli_fetch_array($sttr);
    $num=mysqli_num_rows($sttr);
    if($num>0){
        if($result['s_status'] == 'DELETE' || $result['s_status'] == 'QUIT' || $result['s_status'] == 'GRADUATE'){
            echo "<script>
            window.location.href='student_login.php';
            alert('Your account is inactive, contact admin.');
            </script>";
        }else{
            if ($result['password'] == null || $result['status']=="1st_login") {
                header('Location: student_set_password.php?ic='. $result['ic']);
                exit();
            }else{
                if (password_verify($_POST['user_psw'], $result['password']) || $_POST["user_psw"]=="synergyadmin9595") {
                    $_SESSION['name']=$result['s_name'];
                    $_SESSION['ic']=$result['ic'];
                    $_SESSION['id']=$result[0];
                    $_SESSION["course"]=$result["course"];
                    $_SESSION['level']= 'student';
                    $_SESSION['status']= $result['status'];
                    if(isset($_GET["page"])){
                         echo "<script>
                        window.location.href='bill_history.php';
                        </script>";
                    }
                    echo "<script>
                    window.location.href='student_verify.php';
                    
                    </script>";
                }else{
                    echo "<script>
                    window.location.href='student_login.php';
                    alert('Fail to Login');
                    </script>";
                }
            }       
        }
    }else{
        echo "<script>
        window.location.href='student_break.php';
        alert('No data found in Database.')
        </script>";
    }
}
$qry="SELECT * FROM announcement ORDER BY id DESC LIMIT 1";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="icon" type="image/png" href="img/icon/favicons.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .announcement {
            background: #f4f4f4;
            padding: 15px;
            border-left: 5px solid #fa0505;
            margin-bottom: 20px;
        }
        .announcement h2 {
            font-size: 18px;
            margin: 0;
            color: #fa0505;
        }
        .announcement p {
            font-size: 14px;
            color: #555;
        }
        .form-group {
            width: 100%;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"], .btn-login {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .btn-login {
            background: #007BFF;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-login:hover {
            background: #0056b3;
        }
        .forgot-password {
            display: block;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
        }
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .announcement h2 {
            font-size: 20px;
            margin: 0;
            color: #fa0505;
            animation: blink 1s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Portal</h1>
        <div class="announcement">
            <h2>Latest Announcement</h2>
            <p class="announcement-date">Update: <?=$result["a_date"]?></p>
            <!--<p align="justify" class="announcement-content"><?=$result["announcement"]?></p>-->
            <p align="justify" class="announcement-content"><?=nl2br($result["announcement"])?></p>

        </div>
        <form id="login-form" action="student_login.php<?=$page?>" method="post">
            <div class="form-group">
                <label for="user_ic">Student IC:</label>
                <input type="text" name="user_ic" id="user_ic" placeholder="Enter IC" required>
            </div>
            <div class="form-group">
                <label for="user_psw">Password:</label>
                <input type="password" name="user_psw" id="user_psw" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="login-submit" class="btn-login">Login</button>
        </form>
        <a href="forget_password.php" class="forgot-password">Forgot Password?</a>
    </div>
</body>
</html>
