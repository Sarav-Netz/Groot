<?php
    if(isset($_POST['addDirectClick'])){
        $userId=$_POST['directUserId'];
        $taskTitle=$_POST['directTaskTitle'];
        $taskDesc=$_POST['directTaskDetail'];
        $taskSelectedCategory=$_POST['directTaskCategory'];
        $taskEnterdCategory=$_POST['directEntersTaskCategory'];
        $finalCategory='';
        if(empty($taskEnterdCategory)){
          $finalCategory=$taskSelectedCategory;
        }else{
          $finalCategory=$taskEnterdCategory;
        }
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createTaskQuery();
        $queryObj->addTaskQuery($userId,$taskTitle,$finalCategory);
        $actionResult=mysqli_query($dbObj->con,$queryObj->myQuery);
        if($actionResult){
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