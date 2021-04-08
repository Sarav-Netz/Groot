<!-- <?php 
    //$FilterUserRole = $_GET['taskDetail'];
    // echo "$FilterUserRole";
?>

<div class="row">
    <div class="col-md-2 border-right">
        <form >
            <h3>Filters</h3>
        <?php
            //$dbObj=new dbConnection();
            //$dbObj->connectDb();
            //$query="SELECT DISTINCT userRole FROM workmate;";
            // var_dump($query);
            // var_dump($dbObj->con);
            //$result=mysqli_query($dbObj->con,$query);
            // var_dump($result);
            //while($row=$result->fetch_assoc()):
                //if($_SESSION['userRole']=='admin'):
                    //if($row['userRole']==$FilterUserRole): 
        ?>          
                    <div class="form-check">
                    <label for="<?php //echo $row['userRole']; ?>">
                        <?php //echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>">
                        <br/>
                    </div>
                <?php //else: ?>
                    <div class="form-check">
                    <label for="<?php ////echo $row['userRole']; ?>">
                        <?php //echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>">
                        <br/>
                    </div>
                <?php //endif; ?>
            
        <?php //else: 
           // if($row['userRole']!='admin' && $row['userRole']!='manager'):
                //if($row['userRole']==$FilterUserRole): 
                    ?>          
                                <div class="form-check">
                                <label for="<?php //echo $row['userRole']; ?>">
                                    <?php// echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>">
                                    <br/>
                                </div>
                            <?php //else: ?>
                                <div class="form-check">
                                <label for="<?php //echo $row['userRole']; ?>">
                                    <?php //echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php// echo $row['userRole']; ?>">
                                    <br/>
                                </div>
                            <?php //endif; ?>
        <?php// endif; endif; endwhile; ?>
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
                window.location.assign(`managerInterface.php?taskDetail=${value}`);
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
                     <th scope="col">User Role</th> -->
                    <!-- <th scope="col">Task Title</th>
                    <th scope="col">Task Detail</th>
                    <th scope="col">Actions</th> -->
                <!-- </tr>
            </thead>
            <tbody> -->
    <?php        
                // $dbObj=new dbConnection();
                // $queryObj=new createTaskQuery();
                // $dbObj->connectDb();
                // $queryObj->getDistinctUserIdTask();
                // $UserIdresult=mysqli_query($dbObj->con,$queryObj->myQuery);
                // $srNo=0;
                // while($row=$UserIdresult->fetch_assoc()):
                //     $userObj=new createDataQuery();
                //     $userObj->selectWithCond($row['userId']);
                //     $userDataResult=mysqli_query($dbObj->con,$userObj->myQuery);
                //     $userDataRow=$userDataResult->fetch_assoc();
                //     if($userDataRow['userRole']==$FilterUserRole):
                //         $queryObj->selectTaskWithUserId($userDataRow['userId']);
                //         $taskDataResult=mysqli_query($dbObj->con,$queryObj->myQuery);
                //         while($taskRow=$taskDataResult->fetch_assoc()):

                //             $srNo+=1;
                //             if($taskRow['taskCompleted']=='no'):

            ?>
                            <!-- <tr>
                                <th scope="row"><?php //echo $srNo; ?></th>                                
                                <td><?php //echo $taskRow['userId']; ?></td>
                                <td><?php //echo $userDataRow['userName']; ?></td>
                                <td><?php //echo $userDataRow['userRole']; ?></td>
                                 <td><?php //echo $taskRow['taskTitle']; ?></td>
                                <td><?php //echo $taskRow['taskDisc'] ?></td> -->
                                <td> 
                                    <!-- <a href="managerInterface.php?editTaskId=<?php //echo $taskRow['taskId']; ?>" >EDIT</a>| -->
                                    <!-- <a href="managerInterface.php?deleteTaskId=<?php //echo $taskRow['taskId']; ?>" onclick="return confirmDelete()">Delete</a>| -->
                                    <!-- <a href="managerInterface.php?addNewTask=<?php //echo $taskRow['userId']; ?>" >Assign New Task</a>|
                                    <a// href="managerInterface.php?completeTaskId=<?php //echo $taskRow['taskId']; ?>" >Marks as Completed</a>| -->
                                </td>
                            </tr>
                            <!-- <?php //endif; endwhile; endif; endwhile; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div> -->

<?php 
    $FilterUserRole = $_GET['taskDetail'];
    // echo "$FilterUserRole";
?>

<div class="row">
    <div class="col-md-2 border-right">
        <form >
            <h3>Filters</h3>
            <select name="advancedFilterSelctionOption" onchange="provideCheckInfo()" class="form-select" aria-label="Default select example" id="advancedFilterSelctionOption">
            <option value="">---SELECT USER---</option>
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
                    <!-- <div class="form-check">
                    <label for="<?php echo $row['userRole']; ?>">
                        <?php echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                        <br/>
                    </div> -->
                    <option value="<?php echo $row['userRole']; ?>" selected><?php echo $row['userRole']; ?></option>
                <?php else: ?>
                    <!-- <div class="form-check">
                    <label for="<?php //echo $row['userRole']; ?>">
                        <?php //echo $row['userRole']; ?>
                        </label>
                        <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                        <br/>
                    </div> -->
                    <option value="<?php echo $row['userRole']; ?>"><?php echo $row['userRole']; ?></option>
                <?php endif; ?>
            
        <?php else: 
            if($row['userRole']!='admin' && $row['userRole']!='manager'):
                if($row['userRole']==$FilterUserRole): 
                    ?>          
                                <!-- <div class="form-check">
                                <label for="<?php //echo $row['userRole']; ?>">
                                    <?php //echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" checked onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>">
                                    <br/>
                                </div> -->
                                <option value="<?php echo $row['userRole']; ?>" selected><?php echo $row['userRole']; ?></option>
                            <?php else: ?>
                                <!-- <div class="form-check">
                                <label for="<?php //echo $row['userRole']; ?>">
                                    <?php //echo $row['userRole']; ?>
                                    </label>
                                    <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>">
                                    <br/>
                                </div> -->
                                <option value="<?php echo $row['userRole']; ?>"><?php echo $row['userRole']; ?></option>
                            <?php endif; ?>
        <?php endif; endif; endwhile; ?>
            </select>
        </form>



        <button disabled class="btn btn-danger m-3" style="border-radius: 50%; ">OR</button>
        <!-- categories selection -->

        <form >
    <select name="filterSelectionOptionCategories" onchange="provideCategoryCheckInfo()" class="form-select" aria-label="Default select example" id="filterSelectionOptionCategories">
    <option value="">---TASK CATEGORIES---</option>
    <?php
        $dbObj=new dbConnection();
        $dbObj->connectDb();
        $query="SELECT DISTINCT taskCategory FROM usertask;";
        $result=mysqli_query($dbObj->con,$query);
        
        while($row=$result->fetch_assoc()):
    ?>          
                <option value="<?php echo $row['taskCategory']; ?>"><?php echo $row['taskCategory']; ?></option>
            
        
        <?php  endwhile; ?>
        </select>
        </form>

        <script>
            // function provideCheckInfo(){
            //     userRole=document.getElementsByName('filterRadio');
            //     console.log(userRole);
            //     var value;
            //     for (var i = 0; i < userRole.length; i++) {
            //         if (userRole[i].checked) {

            //             value = userRole[i].value;       
            //         }
            //     }
            //     console.log(value);
            //     window.location.assign(`managerInterface.php?taskDetail=${value}`);
            // }
            function provideCheckInfo(){
                let selectedValue=document.getElementById('advancedFilterSelctionOption').value;
                window.location.assign(`managerInterface.php?taskDetail=${selectedValue}`);
            }
            function provideCategoryCheckInfo(){
                let selectedcategory=document.getElementById('filterSelectionOptionCategories').value;
                // console.log(selectedcategory);
                window.location.assign(`managerInterface.php?taskCategory=${selectedcategory}`);
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
                    <!-- <th scope="col">User Role</th> -->
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
                            if($taskRow['taskCompleted']=='no'):

            ?>
                            <tr>
                                <th scope="row"><?php echo $srNo; ?></th>                                
                                <td><?php echo $taskRow['userId']; ?></td>
                                <td><?php echo $userDataRow['userName']; ?></td>
                                <!-- <td><?php //echo $userDataRow['userRole']; ?></td> -->
                                <td><?php echo $taskRow['taskTitle']; ?></td>
                                <td><?php echo $taskRow['taskDisc'] ?></td>
                                <td>
                                    <a href="managerInterface.php?editTaskId=<?php echo $taskRow['taskId']; ?>" >EDIT</a>|
                                    <a href="managerInterface.php?deleteTaskId=<?php echo $taskRow['taskId']; ?>" onclick="return confirmDelete()">Delete</a>|
                                    <!-- <a href="managerInterface.php?addNewTask=<?php //echo $taskRow['userId']; ?>" >Assign New Task</a>| -->
                                    <a href="managerInterface.php?completeTaskId=<?php echo $taskRow['taskId']; ?>" >Marks as Completed</a>|
                                </td>
                            </tr>
                            <?php endif; endwhile; endif; endwhile; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>