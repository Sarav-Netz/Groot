<?php
    if(isset($_POST['addDirectClick'])){
        $userId=$_POST['directUserId'];
        $taskTitle=$_POST['directTaskTitle'];
        $taskDesc=$_POST['directTaskDetail'];
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createTaskQuery();
        $queryObj->addTaskQuery($userId,$taskTitle,$taskDesc);
        $result=mysqli_query($dbObj->con,$queryObj->myQuery);
        if($result){
            echo "<div class=\"alert alert-success\" role=\"alert\">
            Task added successfully!
          </div>";
        }else{
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            We are unable to do this task!
          </div>";
        }
    }
?>