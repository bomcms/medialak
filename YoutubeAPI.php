<?php

namespace BomCMS\MediaLak;

use GuzzleHttp\Client;

class YoutubeAPI
{

    public $_client;

    public function __construct(Client $client)
    {
        $this->_client = $client;
    }

    /**
     * title : Tiêu đề của video.
     * thumbnail_url : Đường dẫn đến file ảnh thumbnail.
     * author : Tên tác giả video.
     * url_encoded_fmt_stream_map : Chứa url của các định dạng video.
     * length_seconds : Thời lượng.
     * @param $id
     */

    public static function getLink($id)
    {
        $client = new Client([
            'base_uri' => 'http://www.youtube.com'
        ]);
        $data = $client->request('GET', 'get_video_info', [
            'query' => [
                'video_id' => $id
            ],
        ]);
        $video = parse_str($data->getBody()->getContents(), $videos);


        echo '<pre>';
        print_r($videos);
    }
}