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
    ?>          
                <div class="form-check">
                <label for="<?php echo $row['userRole']; ?>">
                    <?php echo $row['userRole']; ?>
                    </label>
                    <input name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>">
                    <br/>
                </div>
            
        <?php else: 
            if($row['userRole']!='admin' && $row['userRole']!='manager'): ?>
                <div class="form-check">
                
                <label class="form-check-label" for="<?php echo $row['userRole']; ?>">
                    <?php echo $row['userRole']; ?>
                    </label>
                    <input class="" name="filterRadio" type="radio" value="<?php echo $row['userRole']; ?>" onchange="provideCheckInfo()" id="<?php echo $row['userRole']; ?>"><br/>
                </div>
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
