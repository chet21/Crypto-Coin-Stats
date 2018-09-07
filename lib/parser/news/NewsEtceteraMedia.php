<?php

namespace Lib\Parser\News;


class NewsEtceteraMedia extends BaseNewsParser implements InterfaceNewsParser
{
    public $url = 'https://uk.etcetera.media/';

    public function __construct($count)
    {
        parent::__construct($this->url, $count);

        $this->get_link_list();
        $this->parse_link_get_data();
//        $this->check_valid();
    }

    public function get_link_list(){
        $array = $this->html->find('.featured-acme-col-posts .acme-col-1');

        $count = ($this->count != null) ? $this->count : count($array);

        foreach ($array as $k => $article) {
            if($k <= $count - 1){
                $article = pq($article);
                $article->find('span')->remove();
                $l = $article->find('a')->attr('href');
                $this->link_list[] = $l;
            }
        }
    }

    public function parse_link_get_data()
    {
        foreach ($this->link_list as $k => $item) {

            $curl = self::curl($item);
            $html = \phpQuery::newDocument($curl);
////
            $block = $html->find('article');
            $block = pq($block);

            $this->titles[$k] = $block->find('.entry-title')->text();
//
            $res['data']['title_ua'] = $block->find('.entry-title')->text();
            $res['data']['img'] = $block->find('img')->attr('data-lazy-src');
//
//            $text = $html->find('.article_text');
            $block->find('.entry-content p em')->remove();
            $res['data']['text_ua'] = $block->find('.entry-content p')->html();
//
            $tag = $html->find('.tags-links a');
//
            foreach ($tag as $kk => $vv){
                $ua[$kk] = pq($vv)->text();
            }
//
            $res['tag']['ua'] = $ua;
//
//            //////////////////get ru content///////////////////////////////////////////////
//
//            $ru_link = $html->find('.flags_language_selector a')->attr('href');
//
//            $curl_ru = self::curl($ru_link);
//            $html_ru = \phpQuery::newDocumentHTML($curl_ru);
//
//            $title_ru = $html_ru->find('.article');
//            $res['data']['title_ru'] = pq($title_ru)->find('.article_title')->text();
//
//            $text_ru = $title_ru->find('.article_text');
//            $res['data']['text_ru'] = pq($text_ru)->find('#newsSummary')->text();
//
//            $tag_ru = $html_ru->find('.tags a');
//
//            foreach ($tag_ru as $ku => $vvv){
//                $ru[$ku] = pq($vvv)->text();
//            }
//
//            $res['tag']['ru'] = $ru;
//
            $this->data[$k] = $res;
        }
    }
}