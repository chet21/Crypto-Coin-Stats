<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.07.2018
 * Time: 18:56
 */

namespace Lib\Parser\News;
use Helper\DateHelp;


class SaveNews
{
    public static function add_new($obj){
        if(is_object($obj)){
            try{
                foreach ($obj->data as $v){
                    $add_news = new \System\ORM('news');
                    $add_news->insert($v['data']);
                    $add_news->run();
                    $news_id = $add_news::lastID();

                    $get_tag = new \ValidTag($v['tag']);

                    foreach ($get_tag->result as $tag_id){

                        $tag_cloud = array('id_news' => $news_id, 'id_tag' => $tag_id);

                        try{
                            $add_cloud_tag = new \System\ORM('tags');
                            $add_cloud_tag->insert($tag_cloud);
                            $add_cloud_tag->run();
                        }catch ( \Exception $e){
                            $e->getLine();
                        }
                    }
                }
            }catch (\ExeptionNewsParser $e){
                file_put_contents('parse_news.txt', 'Can`t add news '.'<br>'.$e->getLine());
            }
        }else{
            file_put_contents('parse_news.txt', DateHelp::time_log().' Can`t add news, data must by obj <br>'.PHP_EOL, FILE_APPEND );
            throw new \Exception('Obj is null');
        }
    }
}