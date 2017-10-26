<?php

require_once __DIR__ . '/../models/Files.php';
require_once __DIR__ . '/../models/GoogleSpeech.php';

class AppController
{
    /**
     * @var string
     */
    public $api_key;

    /**
     * @var array
     */
    private $filenames = array();

    /**
     *
     */
    public function actionUploadFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['audio']['size'][0] != 0) {
            $this->filenames = Files::uploadFiles();
            $this->actionGetText();
        }

        include_once __DIR__ . '/../views/app.php';
    }

    /**
     *
     */
    private function actionGetText()
    {
        if (!empty($this->filenames)) {
            $text = 'date: ' . date('d-m-y, H-i-s');
            Files::writeFile($text);

            $start_time = microtime(true);

            foreach ($this->filenames as $filename) {
                $api = new GoogleSpeech($this->api_key);
                $text = $api->voiceToText($filename);
                Files::writeFile($text);
            }

            $end_time = microtime(true);
            exit('Request fulfilled, waiting time: ' . ($end_time - $start_time) . ' seconds');
        }

    }

}