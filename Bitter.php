<!DOCTYPE html>
<html>
<head>
	<title>Gaano ka ka-Bitter?</title>
	<link rel="stylesheet" type="text/css" href="styles/inline.css">
	<img id="banner" src="images/Banner.png" height="210" width="800" align="center"/>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
	<button type="button" onclick="parent.location='action.php'">Predict</button>
</form>

<?php
    function UploadImage($settings = false)
        {
            // Input allows you to change where your file is coming from so you can port this code easily
            $inputname      =   (isset($settings['input']) && !empty($settings['input']))? $settings['input'] : "fileToUpload";
            // Sets your document root for easy uploading reference
            $root_dir       =   (isset($settings['root']) && !empty($settings['root']))? $settings['root'] : $_SERVER['DOCUMENT_ROOT'];
            // Allows you to set a folder where your file will be dropped, good for porting elsewhere
            $target_dir     =   (isset($settings['dir']) && !empty($settings['dir']))? $settings['dir'] : "/uploads/";
            // Check the file is not empty (if you want to change the name of the file are uploading)
            if(isset($settings['filename']) && !empty($settings['filename']))
                $filename   =   $settings['filename'];
            // Use the default upload name
            else
                $filename   =   preg_replace('/[^a-zA-Z0-9\.\_\-]/',"",$_FILES[$inputname]["name"]);
            // If empty name, just return false and end the process
            if(empty($filename))
                return false;
            // Check if the upload spot is a real folder
            if(!is_dir($root_dir.$target_dir))
                // If not, create the folder recursively
                mkdir($root_dir.$target_dir,0755,true);
            // Create a root-based upload path
            $target_file    =   $root_dir.$target_dir.$filename;
            // If the file is uploaded successfully...
            if(move_uploaded_file($_FILES[$inputname]["tmp_name"],$target_file)) {
                    // Save out all the stats of the upload
                    $stats['filename']  =   $filename;
                    $stats['fullpath']  =   $target_file;
                    $stats['localpath'] =   $target_dir.$filename;
                    $stats['filesize']  =   filesize($target_file);
                    // Return the stats
                    return $stats;
                }
            // Return false
            return false;
        }
?>

<?php
    // Make sure the above function is included...
    // Check file is uploaded
    if(isset($_FILES["fileToUpload"]["name"]) && !empty($_FILES["fileToUpload"]["name"])) {
        // Process and return results
        $file   =   UploadImage();
        // If success, show image
        if($file != false) { ?>
            <img src="<?php echo $file['localpath']; ?>" height="210" width="210" align="center"/>
	        <?php echo $file['localpath'];
					$path = $file['localpath'];?>
			<?php
            }
    }
?>
</body>
</html>