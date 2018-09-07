<?php

namespace Lib\Parser\News;

class NewsParser24Ua extends BaseNewsParser implements InterfaceNewsParser
{
    protected $url = 'https://24tv.ua/';

    public function __construct($count)
   {
       parent::__construct($this->url, $count);

       $this->get_link_list();
       $this->parse_link_get_data();
       $this->check_valid();
   }

    public function get_link_list()
    {
        $array = $this->html->find('.news-list li');

        $count = ($this->count != null) ? $this->count : count($array);

        foreach ($array as $k => $article) {
            if($k <= $count - 1){
                $article = pq($article);
                $l = $article->find('a')->attr('href');
                $this->link_list[] = $this->url . $l;
            }
        }
    }

    public function parse_link_get_data()
    {
        foreach ($this->link_list as $k => $item) {

            $curl = self::curl($item);
            $html = \phpQuery::newDocument($curl);
//
            $title = $html->find('.article');
            $res['data']['title_ua'] = pq($title)->find('.article_title')->text();
            $this->titles[$k] = pq($title)->find('.article_title')->text();

            $img = $html->find('.b_photo');
            $res['data']['img'] = pq($img)->find('img')->attr('src');

            $text = $html->find('.article_text');
            $res['data']['text_ua'] = pq($text)->find('#newsSummary')->text();

            $tag = $html->find('.tags a');

            foreach ($tag as $kk => $vv){
                $ua[$kk] = pq($vv)->text();
            }

            $res['tag']['ua'] = $ua;

            //////////////////get ru content///////////////////////////////////////////////

            $ru_link = $html->find('.changeLangRU')->attr('href');

            $curl_ru = self::curl($ru_link);
            $html_ru = \phpQuery::newDocumentHTML($curl_ru);

            $title_ru = $html_ru->find('.article');
            $res['data']['title_ru'] = pq($title_ru)->find('.article_title')->text();

            $text_ru = $title_ru->find('.article_text');
            $res['data']['text_ru'] = pq($text_ru)->find('#newsSummary')->text();

            $tag_ru = $html_ru->find('.tags a');

            foreach ($tag_ru as $ku => $vvv){
                $ru[$ku] = pq($vvv)->text();
            }

            $res['tag']['ru'] = $ru;

            $this->data[$k] = $res;
        }
    }
}