<?php

use fileuploader\server\FileUploader;

session_start();

include '../../server/class.fileuploader.php';

include_once '../../secure_upload.php';

$upload_dir = $upload_config['upload_dir'];
$filename = $_POST['_file'];
$thumbnails = $_POST['thumbnails'];

if (isset($_POST['fileuploader']) && isset($_POST['_file']) && isset($_POST['_editor']) && isset($_POST['thumbnails'])) {
    $source = $upload_dir . $filename;
    if (is_file($source)) {
        $editor = json_decode($_POST['_editor'], true);

        Fileuploader::resize($source, null, null, $source, (isset($editor['crop']) ? $editor['crop'] : null), 100, (isset($editor['rotation']) ? $editor['rotation'] : null));

        // get resized image info
        $resized_image_info = getimagesize($source);

        // store image information
        list($image_width, $image_height, $image_type) = $resized_image_info;

        /* define the thumnails sizes
        -------------------------------------------------- */

        $lg_thumb_width  = 526;
        $lg_thumb_height = 526;

        $md_thumb_width  = 288;
        $md_thumb_height = 288;

        $sm_thumb_width  = 208;
        $sm_thumb_height = 208;

        if ($thumbnails == 'true') {
            $thumbs = array(
                // large thumb
                array(
                    'width' => $lg_thumb_width,
                    'height' => $lg_thumb_height,
                    'destination' => $upload_dir . 'thumbs/lg/' . $filename,
                    'dest_folder' => $upload_dir . 'thumbs/lg',
                    'crop' => false
                ),
                // medium thumb
                array(
                    'width' => $md_thumb_width,
                    'height' => $md_thumb_height,
                    'destination' => $upload_dir . 'thumbs/md/' . $filename,
                    'dest_folder' => $upload_dir . 'thumbs/md',
                    'crop' => false
                ),
                // small thumb
                array(
                    'width' => $sm_thumb_width,
                    'height' => $sm_thumb_height,
                    'destination' => $upload_dir . 'thumbs/sm/' . $filename,
                    'dest_folder' => $upload_dir . 'thumbs/sm',
                    'crop' => false
                )
            );
            $has_error = false;
            $error_log = '';
            foreach ($thumbs as $key => $thumb) {
                if (!file_exists($thumb['dest_folder'])) {
                    $has_error = true;
                    $error_log .= 'Thumbnail folder doesn\' exist: ' . $thumb['dest_folder'] . "\n";
                }
            }
            if ($has_error === true) {
                echo $error_log;
                exit;
            }
        }
        foreach ($thumbs as $thumb) {
            FileUploader::resize($source, $thumb['width'], $thumb['height'], $thumb['destination'], false, 90, 0);
        }
    }
}
