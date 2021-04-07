<div class="row">
        <div class="col-md-3 ml">
            <h3>Filters</h3>
            <?php include('completedfilter.php'); ?>
        </div>
        <?php
            $dbObj=new dbConnection();
            $queryObj=new createTaskQuery();
            $dbObj->connectDb();
            $queryObj->selectAllTask($userId);
            $result=mysqli_query($dbObj->con,$queryObj->myQuery);
            $srNo=0;
            if(mysqli_num_rows($result)>0): 
            ?>
                <div class="col-md-9">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Ser. No.</th>
                                <th scope="col">UserId</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Task Id</th>
                                <th scope="col">Task Title</th>
                                <th scope="col">Task Detail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php if($_SESSION['userRole']=='admin'):
                        while($row=$result->fetch_assoc()):
                            $srNo+=1;
                            if($row['taskCompleted']=='yes'):
                            $datarow=getCurrentUser($row['userId']);
                    ?>
                            <tr>
                                <th scope="row"><?php echo $srNo; ?></th>                                
                                <td><?php echo $row['userId']; ?></td>
                                <td><?php echo $datarow['userName']; ?></td>
                                <td><?php echo $row['taskId']; ?></td>
                                <td><?php echo $row['taskTitle']; ?></td>
                                <td><?php echo $row['taskDisc'] ?></td>
                                <td>
                                    <a href="managerInterface.php?deleteTaskId=<?php echo $row['taskId']; ?>" onclick="return confirmDelete()" class="btn btn-danger stretched-link">Delete</a>
                                    <a href="managerInterface.php?reassignTask=<?php echo $row['taskId']; ?>" class="btn btn-primary stretched-link" >Reassign Task</a>
                                </td>
                            </tr>
                <?php endif; endwhile; endif; ?>
                <?php if($_SESSION['userRole']=='manager'):
                        while($row=$result->fetch_assoc()):
                            $datarow=getCurrentUser($row['userId']);
                            $srNo+=1;
                            $dataQueryObj=new createDataQuery();
                            $dataQuery=$dataQueryObj->selectWithCond($row['userId']);
                            $dataResult=userChange::handleAnyQuery($dbObj->con,$dataQueryObj->myQuery);
                            $dataRow=$dataResult->fetch_assoc(); 
                            if($dataRow['userRole']!='admin' && $dataRow['userRole']!='manager'):
                                if($row['taskCompleted']=='yes'):
                    ?>
                                <tr>
                                    <th scope="row"><?php echo $srNo; ?></th>
                                    <td><?php echo $row['userId']; ?></td>
                                    <td><?php echo $datarow['userName']; ?></td>
                                    <td><?php echo $row['taskId']; ?></td>
                                    <td><?php echo $row['taskTitle']; ?></td>
                                    <td><?php echo $row['taskDisc'] ?></td>
                                    <td>
                                        <a href="managerInterface.php?deleteTaskId=<?php echo $row['taskId']; ?>" onclick="return confirmDelete()" class="btn btn-danger stretched-link">Delete</a>
                                        <a href="managerInterface.php?reassignTask=<?php echo $row['taskId']; ?>" class="btn btn-primary stretched-link" >Reassign Task</a>
                                    </td>
                                </tr>
                    <?php endif; endif;
                        endwhile; 
                    endif; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        BadLuck! No Completed Task.
                    </div>

        <?php endif; ?>
    </div>
