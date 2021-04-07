<?php 
    $FilterUserRole = $_GET['completedTaskDetail'];
    // echo "$FilterUserRole";
?>

<div class="row">
    <div class="col-md-2 border-right">
        <h3>Filters</h3>
        <form >
        <?php
            $dbObj=new dbConnection();
            $dbObj->connectDb();
            $query="SELECT DISTINCT userRole FROM workmate;";
            // var_dump($query);
            // var_dump($dbObj->con);
            $result=mysqli_query($dbObj->con,$query);
            // var_dump($result);
            while($row=$result->fetch_assoc()):
                if($_SESSION['userRole']=='admin'):
                    if($row['userRole']==$FilterUserRole): 
        ?>          
                    <div class="form-check">
                    <label for="<?php echo $row['userRole']; ?>">
                        <?php echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                        <br/>
                    </div>
                <?php else: ?>
                    <div class="form-check">
                    <label for="<?php echo $row['userRole']; ?>">
                        <?php echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                        <br/>
                    </div>
                <?php endif; ?>
            
        <?php else: 
            if($row['userRole']!='admin' && $row['userRole']!='manager'): 
                if($row['userRole']==$FilterUserRole): 
                    ?>          
                                <div class="form-check">
                                <label for="<?php echo $row['userRole']; ?>">
                                    <?php echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                                    <br/>
                                </div>
                            <?php else: ?>
                                <div class="form-check">
                                <label for="<?php echo $row['userRole']; ?>">
                                    <?php echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                                    <br/>
                                </div>
                            <?php endif; ?>
        <?php endif; endif; endwhile; ?>
        </form>

        <script>
            function provideCheckInfo(){
                userRole=document.getElementsByName('filterRadio');
                console.log(userRole);
                var value;
                for (var i = 0; i < userRole.length; i++) {
                    if (userRole[i].checked) {

                        value = userRole[i].value;       
                    }
                }
                console.log(value);
                window.location.assign(`managerInterface.php?completedTaskDetail=${value}`);
            }
        </script>

    </div>
    <div class="col-md-10">
    <div>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Ser. No.</th>
                    <th scope="col">UserId</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Role</th>
                    <th scope="col">Task Title</th>
                    <th scope="col">Task Detail</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
    <?php        
                $dbObj=new dbConnection();
                $queryObj=new createTaskQuery();
                $dbObj->connectDb();
                $queryObj->getDistinctUserIdTask();
                $UserIdresult=mysqli_query($dbObj->con,$queryObj->myQuery);
                $srNo=0;
                while($row=$UserIdresult->fetch_assoc()):
                    $userObj=new createDataQuery();
                    $userObj->selectWithCond($row['userId']);
                    $userDataResult=mysqli_query($dbObj->con,$userObj->myQuery);
                    $userDataRow=$userDataResult->fetch_assoc();
                    if($userDataRow['userRole']==$FilterUserRole):
                        $queryObj->selectTaskWithUserId($userDataRow['userId']);
                        $taskDataResult=mysqli_query($dbObj->con,$queryObj->myQuery);
                        while($taskRow=$taskDataResult->fetch_assoc()):
                            $srNo+=1;
                            if($taskRow['taskCompleted']=='yes'):
                        ?>
                                <tr>
                                <th scope="row"><?php echo $srNo; ?></th>                                
                                <td><?php echo $taskRow['userId']; ?></td>
                                <td><?php echo $userDataRow['userName']; ?></td>
                                <td><?php echo $userDataRow['userRole']; ?></td>
                                <td><?php echo $taskRow['taskTitle']; ?></td>
                                <td><?php echo $taskRow['taskDisc'] ?></td>
                                    <td>
                                        <a href="managerInterface.php?deleteTaskId=<?php echo $taskRow['taskId']; ?>" onclick="return confirmDelete()" class="btn btn-danger stretched-link">Delete</a>
                                        <a href="managerInterface.php?reassignTask=<?php echo $taskRow['taskId']; ?>" class="btn btn-primary stretched-link" >Reassign Task</a>
                                    </td>
                                </tr>
                            <?php endif; endwhile; endif; endwhile; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>