<?php
    if(isset($_POST['submitUpdatePassword'])){
        $userId=$_POST['updatingPassword'];
        $password=$_POST['enterUpdatePassword'];
        $confirmPassword=$_POST['confirmEnterUpdatePassword'];
        $password=sha1($password);
        $confirmPassword=sha1($password);
        $dbObj = new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createDataQuery();
        $queryObj->selectWithCond($userId);
        $result1=mysqli_query($dbObj->con,$queryObj->myQuery);
        $dataRow=$result1->fetch_assoc();
        if($dataRow['userPassword']!=$password){
            if($password==$confirmPassword){
                // $password=sha1($password);
                $queryObj->updatePassword($userId,$password);
                $result=mysqli_query($dbObj->con,$queryObj->myQuery);
                // var_dump($result);
                if($result){
                    echo "<div class=\"alert alert-success\" role=\"alert\">
                    Password is updated successfully!
                </div>";
                }else{
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
                    We are not able to do this task!
                </div>";
                }
            }else{
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                Confirm password is mismatched! Try Again!
            </div>";
            }
        }else{
            echo "<div class=\"alert alert-warning\" role=\"alert\">
                In concern of Privacy! New Password is same as the Previous password;
            </div>";
        }
    }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
</head>
<body>
    
</body>
</html> -->