<?php
    session_start();
    if($_SESSION['userRole']){
        include('db.php');
        include('userHandlerClasses.php');
    }else{
        header('Location:admin.php');
    }

    function getCurenntUserTask(){
        $userId=$_SESSION['userId'];
        $dbObj=new dbConnection();
        $queryObj=new createTaskQuery();
        $dbObj->connectDb();
        $queryObj->selectTaskWithUserId($userId);
        $result=mysqli_query($dbObj->con,$queryObj->myQuery);
        return $result;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>StaffMember Desktop</title>
</head>
<body>


    <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand font-weight-bold text-light" href="staffInterface.php?home=true">Groot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-dark"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold text-light" href="toDo.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    TASK
                    </a>
                    <div class="dropdown-menu bg-dark " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item font-weight-bold text-light" href="staffInterface.php?myTask=true">My Task</a>
                    <a class="dropdown-item font-weight-bold text-light" href="staffInterface.php?addNewTask=true">Add New Task </a>
                    <a class="dropdown-item font-weight-bold text-light" href="staffInterface.php?completedTask=true">Completed Task</a>
                    <!-- <div class="dropdown-divider"></div> -->
                    </div>
                </li>
            </ul>
            <?php
                $userId=$_SESSION['userId'];
                $dbObj=new dbConnection();
                $queryObj=new createDataQuery();
                $dbObj->connectDb();
                $queryObj->selectWithCond($userId);
                $userObj=new userChange();
                $table = userChange::handleAnyQuery($dbObj->con,$queryObj->myQuery);
                $dbObj->dissconnectDb();
                $row=$table->fetch_assoc(); ?>
                <ul class='nav navbar-nav navbar-right'>
                    <li class='nav-item'>
                        <a class='nav-link font-weight-bold text-white float-right ' href='staffInterface.php?showMyDetailClick=true'><?php echo $row['userName']; ?></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link font-weight-bold text-warning' href='logOut.php?logout=true'>Log Out</a>
                    </li>
                </ul>
        </div>
    </nav>

    </div>


    <div class="container">
        <div>
            <?php 
                if(isset($_GET['home'])){
                    include('home.php');
                }
            ?>
        </div>

        <!-- Current user Information -->
        <div>
        <?php
            if(isset($_GET['showMyDetailClick'])):
                $userId=$_SESSION['userId'];
                $dbObj=new dbConnection();
                $queryObj=new createDataQuery();
                $dbObj->connectDb();
                $queryObj->selectWithCond($userId);
                $result=userChange::handleAnyQuery($dbObj->con,$queryObj->myQuery);
                $row=$result->fetch_assoc();
            ?>
                <div class="card">
                    <h5 class="card-header"><?php echo $row['userName']; ?> Information</h5>
                    <div class="card-body">
                        <h5 class="card-title">Your Email: <?php echo $row['userEmail'] ?></h5>
                        <p class="card-text">Your Role With Our company: <?php echo $row['userRole'] ?></p>
                        <a href="staffInterface.php?editMe=true" class="btn btn-primary">Edit</a>
                        <a href="staffInterface.php?updatePassword=true" class="btn btn-primary">Update PassWord</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div>
        <!-- EDIT ME SECTION -->
        <?php if(isset($_GET['editMe'])):
                $userId=$_SESSION['userId'];
                $dbObj=new dbConnection();
                $queryObj=new createDataQuery();
                // $userObj=new userChange();
                $dbObj->connectDb();
                $queryObj->selectWithCond($userId);                    
                $result=mysqli_query($dbObj->con,$queryObj->myQuery);
                $row=$result->fetch_assoc();
                include('edituser.php');    
        ?>
                <div>
                    <form action="" method="POST" class="container">
                    <div class="form-row">
                            <input type="hidden" class="form-control" id="userId" value="<?php echo $userId ?>" name="userId" placeholder="User Id">
                        <div class="form-group col-md-6">
                            <label for="userName">User Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $row['userName'] ?>" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userEmail">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?php echo $row['userEmail'] ?>" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userRole">User Role</label>
                            <input type="text" class="form-control" id="userRole" value="<?php echo $row['userRole'] ?>" name="userRole" placeholder="user Role">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="userValid">Validate User</label>
                            <input type="text" class="form-control" id="userValid" value="<?php echo $row['valid'] ?>" name="userValid" placeholder="user Role">
                        </div>
                    </div>
                    <button type="submit" name="updateInfo" class="btn btn-primary">Update</button>
                </form>
                </div>
            <?php endif; ?>

        </div>
        
        <div>
        <!-- section to show the tasks of the current user -->
        <?php
            if(isset($_GET['myTask'])):
                $result=getCurenntUserTask();
                $srNo=0;
                if(mysqli_num_rows($result)>0): 
                ?>
                <div class="container">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Ser. No.</th>
                                <th scope="col">Task Title</th>
                                <th scope="col">Task Detail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                    while($row=$result->fetch_assoc()):
                        $srNo+=1;
                        if($row['taskCompleted']=='no'):
                ?>
                            <tr>
                                <th scope="row"><?php echo $srNo; ?></th>
                                <td><?php echo $row['taskTitle']; ?></td>
                                <td><?php echo $row['taskDisc'] ?></td>
                                <td>
                                    <a href="staffInterface.php?editTaskId=<?php echo $row['taskId']; ?>">EDIT</a>|
                                    <a href="staffInterface.php?completedTaskId=<?php echo $row['taskId']; ?>" >Add to completed</a>
                                </td>
                            </tr>
                <?php endif; endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <?php else: ?>
                    <div class="alert alert-primary" role="alert">
                        Hurray! You have no Pending Task.
                    </div>
                <?php endif; ?>
                <a href="staffInterface.php?addNewTask=true" class="btn btn-primary">Add New Task</a>
                <?php endif; ?>
                
        </div>

        <div class="container">
            <div>
                <?php 
                    if(isset($_GET['updatePassword'])):
                    include('updatePassword.php');
                ?>
                    <div>
                        <form action="" method="POST">
                            <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo $_SESSION['userId']; ?>" id="updatingPassword" name="updatingPassword">
                                <label for="enterUpdatePassword">Enter Password</label>
                                <input type="text" class="form-control" id="enterUpdatePassword" name="enterUpdatePassword"  placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmEnterUpdatePassword">Confirm Password</label>
                                <input type="text" class="form-control" name="confirmEnterUpdatePassword" id="confirmEnterUpdatePassword" placeholder=" confirm Password">
                            </div>
                            <button name="submitUpdatePassword" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
            <?php   endif; ?>
            </div>
        </div>

        <div>
        <!-- ADD NEW TASK -->
        <?php
        if(isset($_GET['addNewTask'])):
            // $userId=$_GET['addNewTask'];
            include('addNewTask.php');
            ?>
            <div class="container">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="userIdForTask" value="<?php echo $_SESSION['userId']; ?>" >
                    <label >Title for the Taks</label>
                    <input type="text" class="form-control" name="newTaskTitle" placeholder="Enter Title" required>
                    <label >Description for the Task</label>
                    <input type="text"  name="newTaskDisc" class="form-control" placeholder="enter Description" required>
                    <button  class="btn btn-primary" name="addTASK">Add Task</button>
                </form>
        <?php
            endif; 
        ?> 
        </div>


        <!-- Complete any taks -->
        <div>  
        <?php
            if(isset($_GET['completedTaskId'])):
                $taskId=$_GET['completedTaskId'];
                $dbObj=new dbConnection();
                $dbObj->connectDb();
                $queryObj=new createTaskQuery();
                $queryObj->completeTask($taskId);
                $result=mysqli_query($dbObj->con,$queryObj->myQuery);
                if($result):
            ?>
                        <div class="alert alert-success" role="alert">
                                Task added to completed.
                        </div>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        There is some Failure to do this Task! please try Again!
                    </div>
            <?php endif; endif; ?>
        </div>
        <!-- completed task information -->
        <div>
        <?php 
            if(isset($_GET['completedTask'])):
                $result=getCurenntUserTask();
                $srNo=0;
                if(mysqli_num_rows($result)>0): 
                ?>
                <div class="container">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Ser. No.</th>
                                <th scope="col">Task Title</th>
                                <th scope="col">Task Detail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                    while($row=$result->fetch_assoc()):
                        $srNo+=1;
                        if($row['taskCompleted']=='yes'):
                ?>
                            <tr>
                                <th scope="row"><?php echo $srNo; ?></th>
                                <td><?php echo $row['taskTitle']; ?></td>
                                <td><?php echo $row['taskDisc'] ?></td>
                                <td>
                                    <!-- <a href="staffInterface.php?editTaskId=<?php //echo $row['taskId']; ?>">EDIT</a>| -->
                                    <!-- <a href="staffInterface.php?completedTaskId=<?php //echo $row['taskId']; ?>" >Add to completed</a> -->
                                    Cotact with Manager Or Admin regarding this Tasks.
                                </td>
                            </tr>
                <?php endif; endwhile; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert alert-primary" role="alert">
                        Hurray! You have no Pending Task.
                    </div>
            <?php endif; endif; ?>
        </div>


        <div>
        <!-- EDIT ANY GIVEN TASK -->
        <?php 
            if(isset($_POST['updateTask'])):
                $taskId=$_POST['taskId'];
                $taskTitle=$_POST['taskTitleEdit'];
                $taskDesc=$_POST['taskDiscEdit'];
                $taskDesc=strtolower($taskDesc);
                $taskTitle=strtolower($taskTitle);
                $dbObj=new dbConnection();
                $dbObj->connectDb();
                $queryObj=new createTaskQuery();
                $queryObj->updateTask($taskId,$taskTitle,$taskDesc);
                $result = mysqli_query($dbObj->con,$queryObj->myQuery);
                $dbObj->dissconnectDb();
                if($result): ?>
                    echo "<div class="alert alert-success"role="alert">
                    Task is updated successfully
                </div>
              <?php  else: ?>
                    echo "<div class="alert alert-danger"role="alert">
                    Sorry! but currently we are not able to do this task!
                </div>
            <?php endif; endif; 
        ?>
        <?php
            if(isset($_GET['editTaskId'])):
                $taskId=$_GET['editTaskId'];
                $dbObj=new dbConnection();
                $queryObj=new createTaskQuery();
                $dbObj->connectDb();
                $queryObj->selectTaskWithCond($taskId);
                $result=mysqli_query($dbObj->con,$queryObj->myQuery);
                $row=$result->fetch_assoc();
                 
        ?>
            <div>
                <form action="" method="POST" class="container">
                    <div class="form-row">
                            <input type="hidden" class="form-control" id="taskId" value="<?php echo $row['taskId']; ?>" name="taskId" placeholder="Task Id">
                        <div class="form-group col-md-6">
                            <label for="taskTitleEdit">Task Title</label>
                            <input type="text" class="form-control" id="taskTitleEdit" name="taskTitleEdit" value="<?php echo $row['taskTitle']; ?>" placeholder="Title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="taskDiscEdit">Task Detail</label>
                            <input type="text" class="form-control" id="taskDiscEdit" name="taskDiscEdit" value="<?php echo $row['taskDisc']; ?>" placeholder="Description">
                        </div>
                    <button type="submit" name="updateTask" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <?php 
             
            endif; 
        ?>
        


    </div>
    <script>
        function confirmDelete(){
            return confirm('Do you want to delete this Pemanently!');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>