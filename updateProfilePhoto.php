<?php
    if(isset($_POST['updateImage'])):
        $userId= $_POST['profileImageUserId'];
        $dbObj=new dbConnection();
        $queryObj=new createDataQuery();
        $dbObj->connectDb();
        // echo __DIR__;
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
        if(($fileType="image/jpeg"||$fileType="image/png"||$fileType="image/gif")):
            
            // echo "i'm in the first Condition";
            if($fileSize<614400): 
                // echo "i'm in the 2nd condition ";
                $action=move_uploaded_file($filePath,__DIR__.'./uploaded/'.$finalImgWithExt);
                if($action):
                    // echo "i'm in the action";
                    $queryObj->updateProfileImage($userId,$finalImgWithExt);
                    $updatedResult=$queryObj->myQuery;
                    if($updatedResult): ?>
                        <div class="alert alert-success">
                            Profile picture is updated successfully
                        </div>
                <?php else: ?>
                    <div class="alert alert-danger">
                        There is some technical issue please try after some time
                    </div>
              <?php endif; ?>
                
         <?php  else: ?>
                <div class="alert alert-danger">
                    file is too big in  size";
                </div>
            
        <?php endif; ?>


        <?php else: ?>
            <div class="alert alert-danger">
                only jpeg/jpg/png are allowed to upload
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


<!-- 
    <form action="" class="form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" class="form-control" name="profileImage" id="profileImage">
        </div>
        <button class="btn btn-primary" name="updateImage">UPDATE</button>
    </form>
  -->