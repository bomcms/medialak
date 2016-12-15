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
        $response = $client->request('GET', 'get_video_info', [
            'query' => [
                'video_id' => $id
            ],
        ]);
        parse_str($response->getBody()->getContents(), $data);
        if(isset($data['url_encoded_fmt_stream_map'])) {
            $result = [
                'title' => $data['title'],
                'keywords' => $data['keywords'],
                'token' => $data['token'],
                'view_count' => $data['view_count'],
            ];
            $aries = explode(',', $data['url_encoded_fmt_stream_map']);
            foreach ($aries as $ary) {
                parse_str($ary, $links[]);
            }

            $videos = [];
            foreach ($links as $link) {
                $video = [
                    'file' => $link['url']
                ];
                $videos[] = $video;
            }
            $result['videos']['sources'] = json_encode($videos);
        }
        return $result;
    }
}