<?php

class GoogleSpeech
{
    /**
     * Instance curl.
     * @var Resource
     */
    private $ch;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->ch = curl_init();
    }

    /**
     *  Destructor.
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * @param string $file
     * @param string $api_key
     * @param int $rate
     * @return string
     */
    public function voiceToText($file, $api_key, $rate)
    {
        $curl_file = new CURLFile(__DIR__ . '/../data/' . $file, 'audio/ogg');
        $file_to_upload = array('myfile' => $curl_file);

        $result = $this->request($file_to_upload, $api_key, $rate);

        $result_arr = explode("\n", $result);
        $result = $result_arr[1];
        $json_array = json_decode($result, true);
        $text = $json_array['result'][0]['alternative'][0]['transcript'];

        return $text;
    }

    /**
     * Executes request.
     * @param array $file_to_upload
     * @param string $api_key
     * @param int $rate
     * @return string
     */
    private function request($file_to_upload = array(), $api_key, $rate)
    {
        curl_setopt_array($this->ch, array(
            CURLOPT_URL => 'https://www.google.com/speech-api/v2/recognize?output=json&lang=ru-RU&key=' . $api_key,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array('Content-Type: audio/x-flac; rate=' . $rate . ';'),
            CURLOPT_POSTFIELDS => $file_to_upload,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SAFE_UPLOAD => 0
        ));

        return curl_exec($this->ch);
    }

}