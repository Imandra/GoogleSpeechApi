<?php

require_once __DIR__ . '/../models/Files.php';
require_once __DIR__ . '/../models/GoogleSpeech.php';

class AppController
{
    /**
     * Google Speech API key
     * @var string
     */
    public $api_key = 'AIzaSyBOti4mM-6x9WDnZIjIeyEU21OpBXqWBgw';

    /**
     * Bitrate of audio files.
     * @var int
     */
    public $rate = 22000;

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
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            exit ('Must select the audio files!');
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

            $api = new GoogleSpeech();

            foreach ($this->filenames as $filename) {
                $text = $api->voiceToText($filename, $this->api_key, $this->rate);
                Files::writeFile($text);
            }

            $end_time = microtime(true);
            exit('Request fulfilled, waiting time: ' . ($end_time - $start_time) . ' seconds');
        }

    }

}