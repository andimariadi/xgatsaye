<?php

function buatFolderUpload($dir = "document")
{
    $target_path = "../../../uploads";
    if (!file_exists($target_path)) {
        $oldmask = umask(0);
        mkdir($target_path, 0777);
        umask($oldmask);
    }
    $target_path = "../../../uploads/" .$dir;
    if (!file_exists($target_path)) {
        $oldmask = umask(0);
        mkdir($target_path, 0777);
        umask($oldmask);
    }
    $target_path = "../../../uploads/".$dir."/".date('Y');
    if (!file_exists($target_path)) {
        $oldmask = umask(0);
        mkdir($target_path, 0777);
        umask($oldmask);
    }
    $target_path = "../../../uploads/".$dir."/".date('Y')."/".date('m');
    if (!file_exists($target_path)) {
        $oldmask = umask(0);
        mkdir($target_path, 0777);
        umask($oldmask);
    }
    $target_path = "../../../uploads/".$dir."/".date('Y')."/".date('m')."/".date('d');
    if (!file_exists($target_path)) {
        $oldmask = umask(0);
        mkdir($target_path, 0777);
        umask($oldmask);
    }
    return $target_path . "/";
}

function filePath($dir = "document", $filename)
{
    $target_path = "/uploads/".$dir."/".date('Y')."/".date('m')."/".date('d');
    return $target_path . "/" . $filename;
}