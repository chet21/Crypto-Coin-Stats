<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.03.2018
 * Time: 15:56
 */

namespace Lib\Parser\News;

use Lib\Parser\BaseParser;
use System\ORM;


abstract class BaseNewsParser extends BaseParser
{
    protected $curl;
    protected $html;
    protected $count;

    protected $titles = array();
    public $link_list = array();
    public $title_db;

    public $data;

    public function __construct($url, $count)
    {
        $this->count = $count;
        $this->curl = self::curl($url);
        $this->html = \phpQuery::newDocument($this->curl);
        $this->get_db_title();
    }

    public function check_valid()
    {
        foreach ($this->data as $k => $v){
            if($v['data']['title_ua'] == '' || $v['data']['title_ru'] == ''){
                unset($this->data[$k]);
            }
        }

        foreach ($this->data as $kk => $vv){
            if(in_array($vv, $this->title_db)){
                unset($this->data[$kk]);
            }
        }
    }
    private function get_db_title()
    {
        $limit = new ORM('news');
        $limit->select('title_ua');
        $limit->limit(30);
        $this->title_db = $limit->run();

    }
}