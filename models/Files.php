<?php

class Files
{
    /**
     * Uploads selected audio files in data directory.
     * @return array
     */
    public static function uploadFiles()
    {
        self::removeFiles();

        foreach ($_FILES['audio']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['audio']['tmp_name'][$key];
                $name = basename($_FILES['audio']['name'][$key]);
                move_uploaded_file($tmp_name, "data/$name");
            }
        }
        return $_FILES['audio']['name'];
    }

    /**
     *  Removes all audio files from data directory.
     */
    private static function removeFiles()
    {
        array_map('unlink', glob('data/*.flac'));
    }

    /**
     * Saves data to text file.
     * @param string $text
     */
    public static function writeFile($text)
    {
        $file = fopen('data/app.txt', 'a+');
        fwrite($file, $text . "\r\n");
        fclose($file);
    }

}