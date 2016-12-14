<?php

namespace BomCMS\MediaLak;

use GuzzleHttp\Client;

class YoutubeAPI {

    public $youtube;
    public function __construct()
    {
        $this->youtube = new Client([
            'base_uri' => 'http://www.youtube.com'
        ]);
    }

    public static function getLink($id) {
print_r($id);
    }
}