<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.04.2018
 * Time: 13:17
 */

namespace Lib\Parser\News;


class NewsParserObozrevatel extends BaseNewsParser implements InterfaceNewsParser
{
    public $url = 'https://www.obozrevatel.com/ukr/';

    public function __construct($count)
    {
        parent::__construct($this->url, $count);
    }

    public function get_link_list()
    {
        $array = $this->html->find('.news-feed');

        $count = ($this->count != null) ? $this->count : count($array);

//        foreach ($array as $k => $link) {
//            if($k < $count){
//                $link = pq($link);
//                $this->link_list[] = $link->find('.news-feed__news-title')->attr('href');
//            }
//            var_dump($link->text());
//        }

        return $array->find('article')->text();
    }

    public function parse_link_get_data()
    {
        foreach ($this->link_list as $k => $item) {

            $curl = self::curl($item);
            $html = \phpQuery::newDocument($curl);

            $title = $html->find('.news-full__title')->text();
            $res['title'] = $title;
            $this->titles[$k] = $title;
//
//            $img = $html->find('.b_photo');
//            $res['img'] = pq($img)->find('img')->attr('src');
//
            $res['text'] = $html->find('.news-full__text p')->text();

            $tag = $html->find('.footnote');

            foreach ($tag as $kk => $vv){
                $ua[$kk] = pq($vv)->find('a')->text();
            }

            $res['tag'] = $ua;

            $this->data[$k]['ua'] = $res;

//            //////////////////get ru content///////////////////////////////////////////////

            $ru_link = $html->find('.news-full__lang')->attr('href');
            $curl_ru = self::curl($ru_link);
            $html_ru = \phpQuery::newDocumentHTML($curl_ru);

            $title_ru = $html_ru->find('.news-full__title')->text();
            $res_ru['title'] = $title_ru;

            $res_ru['text'] = $html_ru->find('.news-full__text p')->text();

            $tag_ru = $html_ru->find('.footnote');

            foreach ($tag_ru as $kkk => $vvv){
                $ru[$kkk] = pq($vvv)->find('a')->text();
            }

            $res_ru['tag'] = $ru;

            $this->data[$k]['ru'] = $res_ru;
        }
    }
}