<?php
    if(isset($_POST['addTASK'])):
        $userId=$_POST['userIdForTask'];
        $taskName=$_POST['newTaskTitle'];
        $taskDetail=$_POST['newTaskDisc'];
        $userId=(int)$userId;
        $taskName=strtolower($taskName);
        $taskDetail=strtolower($taskDetail);
        // var_dump($userId);
        // var_dump($taskName);
        // var_dump($taskDetail);
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $queryObj=new createTaskQuery();
        // var_dump($dbObj);
        // var_dump($queryObj);
        $queryObj->addTaskQuery($userId,$taskName,$taskDetail);
        $result = mysqli_query($dbObj->con,$queryObj->myQuery);
        // $result = mysqli_query($dbObj->con,"INSERT INTO  `usermanagement`.`usertask` (`userId`, `taskTitle`, `taskDisc`) VALUES ('$userId', '$taskName', '$taskDetail');");
        // $result="INSERT INTO `usertask` (`userId`, `taskTitle`, `taskDisc`) VALUES ('$userId', '$taskName', '$taskDetail');";
        if($result): ?>

            <div class="alert alert-success" role="alert">
                Task added successfully
            </div>
            
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Sorry! but we are unable to do this task;
            </div>
        <?php endif; endif; ?>
        
