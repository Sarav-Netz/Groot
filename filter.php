<?php
        // $dbObj=new dbConnection();
        // $dbObj->connectDb();
        // $query="SELECT DISTINCT userRole FROM workmate;";
        // $result=mysqli_query($dbObj->con,$query);
        // while($row=$result->fetch_assoc()):
        //     if($_SESSION['userRole']=='admin'): 
    ?>
            <!-- <a class="dropdown-item font-weight-bold text-light" href="managerInterface.php?<?php //echo $row['userRole']; ?>=true"><?php //echo $row['userRole']; ?></a> -->
    <!-- <a class="dropdown-item font-weight-bold text-light" href="managerInterface.php?showDeveloper=true">Developer</a>
    <a class="dropdown-item font-weight-bold text-light" href="managerInterface.php?showDesigner=true">Designer</a>
    <a class="dropdown-item font-weight-bold text-light" href="managerInterface.php?showTesting=true">Testing </a> -->
    <!-- <div class="dropdown-divider"></div> -->
        <?php //else: 
            //if($row['userRole']!='admin' && $row['userRole']!='manager'): ?>
                <!-- <a class="dropdown-item font-weight-bold text-light" href="managerInterface.php?<?php //echo $row['userRole']; ?>=true"><?php //echo $row['userRole']; ?></a> -->
            <?php //endif; endif; endwhile; ?>
<!-- 

    <form >
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
    ?>          
                <div class="form-check">
                <label for="<?php //echo $row['userRole']; ?>">
                    <?php //echo $row['userRole']; ?>
                    </label>
                    <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //Echo $row['userRole']; ?>">
                    <br/>
                </div>
            
        <?php //else: 
            //if($row['userRole']!='admin' && $row['userRole']!='manager'): ?>
                <div class="form-check">
                
                <label class="form-check-label" for="<?php //echo $row['userRole']; ?>">
                    <?php //echo $row['userRole']; ?>
                    </label>
                    <input class="" name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>"><br/>
                </div>
        <?php ////endif; endif; endwhile; ?>
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
        </script> -->
        <form >
    <select name="filterSelctionOption" onchange="provideCheckInfo()" class="form-select" aria-label="Default select example" id="filterSelctionOption">
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
    ?>          
                <!-- <div class="form-check">
                <label for="<?php //echo $row['userRole']; ?>">
                    <?php //echo $row['userRole']; ?>
                    </label> -->
                    <!-- <input name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>"> -->
                    <!-- <br/> -->
                <!-- </div> -->
                <option value="<?php echo $row['userRole']; ?>"><?php echo $row['userRole']; ?></option>
            
        <?php else: 
            if($row['userRole']!='admin' && $row['userRole']!='manager'): ?>
                <!-- <div class="form-check">
                    <input class="" name="filterRadio" type="radio" value="<?php //echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php //echo $row['userRole']; ?>"><br/>
                </div> -->
                <option value="<?php echo $row['userRole']; ?>"><?php echo $row['userRole']; ?></option>
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

            //commented function is working perfectlu but when you want to use radio buttons for the filter option;
            // function provideCheckInfo(){
            //     userRole=document.getElementsByName('filterSelctionOption');
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
                let selectedValue = document.getElementById('filterSelctionOption').value;
                // console.log(selectedValue);
                window.location.assign(`managerInterface.php?taskDetail=${selectedValue}`);
            }
            function provideCategoryCheckInfo(){
                let selectedcategory=document.getElementById('filterSelectionOptionCategories').value;
                console.log(selectedcategory);
                window.location.assign(`managerInterface.php?taskCategory=${selectedcategory}`);
            }

        </script>