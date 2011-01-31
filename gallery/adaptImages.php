<?php

// Directory of the original images
$originalsDir = "originals";

// Directory of the resized images
$resizedDir = "images";

// Directory of the thumbnails
$thumbsDir = "thumbs";

// Size of the resized images
$resizedWidth = 500;
$resizedHeight = 800;

// Size of the thumbs images
$thumbsWidth = 80;
$thumbsHeight = 100;


// End of configuration section, do not edit after this line
// ---------------------------------------------------------

// Includes the image manipulation library SmartImage
include("SmartImage.class.php");

// Check write permissions
if (!is_writeable($resizedDir)){
	echo "Errore: the directory {$resizedDir} isn't writeable.";
	exit;
}
elseif (!is_writeable($thumbsDir)){
	echo "Errore: the directory {$thumbsDir} isn't writeable.";
	exit;
}
elseif (!is_readable($originalsDir)){
	echo "Errore: the directory {$originalsDir} isn't readable.";
	exit;
}

// Set max_execution_time to unlimited
set_time_limit(0);

// Adapt each file
if ($dirHandle = opendir($originalsDir)) {
	
	// Loop for each file in the originals directory
    while (false !== ($fileHandler = readdir($dirHandle))) { 
        // Skips "." and ".." directories
        if ($fileHandler == "." || $fileHandler == ".."){
        	continue;
        }
        
        // Complete image path
        $imagePath = $originalsDir."/".$fileHandler;
        
        // Resizes the image and saves it
		resize($imagePath, $resizedDir."/".$fileHandler, $resizedWidth, $resizedHeight);
		
		// Creates a thumbnail of the image and saves it
		resize($imagePath, $thumbsDir."/".$fileHandler, $thumbsWidth, $thumbsHeight);
    }
    
    // Close the directory
    closedir($dirHandle); 
}

function resize($imagePath, $destinationImagePath, $width, $height){
	// Check if the file is big (> 1Mb)
	$big = false;
	if (filesize($imagePath) > 1000000){
		$big = true;
	}
	
	// Log message
	echo "<p>Adapting image {$imagePath}. The image is ".($big?"big":"small")."...</p>";
	
	// Image manipulation object for resized image
	$smartimg = new SmartImage($imagePath, $big);
	
	// Resizes the image and saves it
	$smartimg->resize($width, $height, false);
	$smartimg->saveImage($destinationImagePath);
	
	// New size
	$newImageSize = $smartimg->getSize();
	$newImageWidth = $newImageSize[0];
	$newImageHeight = $newImageSize[1];
	
	// Log message
    echo "<p>Image resized to {$newImageWidth}x{$newImageHeight} and saved to {$destinationImagePath}.";
}

?>