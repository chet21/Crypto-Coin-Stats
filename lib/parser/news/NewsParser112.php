<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.03.2018
 * Time: 12:38
 */

namespace Lib\Parser\News;


class NewsParser112 extends BaseNewsParser implements InterfaceNewsParser
{
    protected $url = 'https://112.ua';

    public function __construct($count)
    {
        parent::__construct($count);
    }

    public function get_link_list()
    {
        $array = $this->html->find('.news-list li');
        $link_list = array();
//
//        $count = ($this->count != null) ? $this->count : count($array);
//
        foreach ($array as $k => $article) {
//            if($k <= $count - 1){
                $article = pq($article);
                $l = $article->find('p a')->text();
                $link_list[] = $this->url . $l;
//            }
        }

        $this->link_list = $link_list;
    }

    public function parse_link_get_data()
    {
        $array_news = array();

        $title_for_check = array();

        foreach ($this->link_list as $k => $item) {
            $curl = self::curl($item);
            $html = \phpQuery::newDocument($curl);
            $title = $html->find('.b-news-full');
            $res['title'] = pq($title)->find('h1')->text();
            $title_for_check[$k] = pq($title)->find('h1')->text();
            $img = $html->find('.b-news-full');
            $res['img'] = $this->url.pq($img)->find('.b-news-full-img img')->attr('src');
            $text = $html->find('.b-news-holder');
            $res['text'] = pq($text)->find('.b-news-text')->text();
            $tag = $html->find('.b-news-full');
            $string = trim(trim(pq($tag)->find('.b-news-tags')->text(), 'Теги:'), ' ');
            $res['tag'] = explode(", ", $string);
            $array_news[$k]['ua'] = $res;
        }
        foreach ($this->link_list as $k => $item){
            $item = preg_replace('/uk/', 'ru', $item);
            $curl = self::curl($item);
            $html = \phpQuery::newDocument($curl);
            $title = $html->find('.b-news-full');
            $res['title'] = pq($title)->find('h1')->text();
            $img = $html->find('.b-news-full');
            $res['img'] = $this->url.pq($img)->find('.b-news-full-img img')->attr('src');
            $text = $html->find('.b-news-holder');
            $res['text'] = pq($text)->find('.b-news-text')->text();
            $tag = $html->find('.b-news-full');
            $string = trim(trim(pq($tag)->find('.b-news-tags')->text(), 'Теги:'), ' ');
            $res['tag'] = explode(", ", $string);
            $array_news[$k]['ru'] = $res;
        }

        $this->titles = $title_for_check;
        $this->data = $array_news;
    }
}