<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <form name="FilterForm" id="FilterForm" action="" method="">
        <input type="checkbox" name="filterStatus" value="ISO " />
        <label for="filter_1">ISO</label>
        <input type="checkbox" name="filterStatus" value="AMCA" />
        <label for="filter_2">AMCA</label>
        <input type="checkbox" name="filterStatus" value="UL" />
        <label for="filter_3">UL</label>
    </form>
    <table style="border: 2px;" id="StatusTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>ISO</th>
                <th>AMCA</th>
                <th>UL</th>
            </tr>
        <tbody>
            <tr class="ISO">
                <td class="Name">Name1</td>
                <td class="ISO">&#x2713;</td>
                <td class="AMCA">&nbsp;</td>
                <td class="UL">&nbsp;</td>
            </tr>
            <tr class="ISO AMCA">
                <td class="Name">Name2</td>
                <td class="ISO">&#x2713;</td>
                <td class="AMCA">&#x2713;</td>
                <td class="UL">&nbsp;</td>
            </tr>
            <tr class="ISO AMCA UL">
                <td class="Name">Name3</td>
                <td class="ISO">&#x2713;</td>
                <td class="AMCA">&#x2713;</td>
                <td class="UL">&#x2713;</td>
            </tr>
        </tbody>
    </table>
    <script>

        $("input[name='filterStatus']").change(function () {
            var classes = [];

            $("input[name='filterStatus']").each(function () {
                if ($(this).is(":checked")) { classes.push('.' + $(this).val()); }
            });

            if (classes == "") { // if no filters selected, show all items
                $("#StatusTable tbody tr").show();
            } else { // otherwise, hide everything...
                $("#StatusTable tbody tr").hide();

                $("#StatusTable tr").each(function () {
                    var show = true;
                    var row = $(this);
                    classes.forEach(function (className) {
                        if (row.find('td' + className).html() == '&nbsp;') { show = false; }
                    });
                    if (show) { row.show(); }
                });
            }
        });
    </script>
</body>

</html> -->

<!-- <?php 
    // include('db.php');

    // $dbObj=new dbConnection();
    // $dbObj->connectDb();
    // $queryObj=new createTaskQuery();
    // $queryObj->getDistinctUserIdTask();
    
    // $result=mysqli_query($dbObj->con,$queryObj->myQuery);
    // // var_dump($result);
    // $dbObj->dissconnectDb();
    // // var_dump($result);
    // while($row=$result->fetch_assoc()){
    //     echo $row['userId'];
    //     // echo "taskId";
    //     // echo $row['taskId'];
    //     echo "<hr/>";
    // }

?> -->


<?php
    $conn=mysqli_connect('localhost','root','root','masterdb');
    if($conn){
        echo "i'm connected";
    }else{
        echo "i'm unable to connect";
    }
    if(isset($_POST['submit'])){
        echo __DIR__;
        $image=$_FILES['profileImage'];
        // print_r($image);
        $fileName = $image['name'];
        $fileType = $image['type'];
        $fileSize = $image['size'];
        $filePath = $image['tmp_name']; 
        $imageMakerName=explode(".",$fileName);
        // print_r($imageExt);
        $finalImageName=$imageMakerName[0].date('ymd').time(); #this willgive the final name of the uploaded image 
        $finalImageExt=strtolower(end($imageMakerName)); #this is the final image extention
        // echo "$finalImageName"."$finalImageExt";
        $finalImgWithExt=$finalImageName.".".$finalImageExt;  #this is the final name of the file to save in the database;
        // echo $finalImgWithExt;

        // $allowedExt=array('jpeg','jpg','image/png');
        if(($fileType="image/jpeg"||$fileType="image/png"||$fileType="image/gif")){
            
            // echo "i'm in the first Condition";
            if($fileSize<614400){
                // echo "i'm in the 2nd condition ";
                $action=move_uploaded_file($filePath,__DIR__.'./uploaded/'.$finalImgWithExt);
                if($action){
                    // echo "i'm in the action";
                    $query=mysqli_query($conn,"INSERT INTO `masterdb`.`imageinfo` ( `image` ) VALUES ('$finalImgWithExt')");
                    if($query){
                        echo "File is uploaded successfully";
                    }else{
                        echo "we need to complete this taks again";
                    }
                }
            }else{
                echo "file is too big in  size";
            }
        }else{
            echo "only jpeg/jpg/png are allowed to upload";
        }
// if($file_name!="" && ($file_type="image/jpeg"||$file_type="image/png"||$file_type="image/gif")&& $file_size<=614400)

        // [name] => wallpaper1.jpg [type] => image/jpeg [tmp_name] => C:\Users\ratio\AppData\Local\Temp\phpA851.tmp [error] => 0 [size] => 115215
        // $query="INSERT INTO `masterdb`.`imageinfo` (`image`) VALUES ('$image')";
        // $result = mysqli_query($conn,$image);
        // if($result){
        //     echo "image added successfully";
        // }else{
        //     echo "we are not able to add this image";
        // }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faltu Page</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="profileImage" id="profileImage">
        <button name="submit">Submit</button>
    </form>


    <?php
        $result=  mysqli_query($conn,"SELECT `image` FROM `masterdb`.`imageinfo`");
        if($result): 
            while($row=$result->fetch_assoc()):
            // var_dump($row['image']);
    ?>  
            <img src="./uploaded/<?php echo $row['image']; ?>" class="card-img-top" alt="database image">

        <?php endwhile; endif; ?>
 
</body>
</html>