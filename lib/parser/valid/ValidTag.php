<?php

use System\ORM;

class ValidTag
{

    public $db_data;
    public $parse_data;

    public $result = [];

    public function __construct($parse_data)
    {
        $this->parse_data = $parse_data;
        $this->get_db_tag();
        $this->unset_if_exist();
    }

    private function get_db_tag()
    {
        $new_data = new ORM('tag');
        $new_data->select();
        $data = $new_data->run();

        foreach ($data as $items) {
            foreach ($items as $item) {
                if ($item['title_ua'] != '') {
//                    echo 'id = ' . $item['id'] . ' ua = ' . $item['title_ua'] . '<br>';
                    $this->db_data[$item['id']] = $item['title_ua'];
                } else {
//                    echo 'id = ' . $item['id'] . ' ru = ' . $item['title_ru'] . '<br>';
                    $this->db_data[$item['id']] = $item['title_ru'];
                }
            }
        }
    }

    private function add_new_tag($arr)
    {
        $new_tag = new ORM('tag');
        $new_tag->insert($arr);
        $new_tag->run();

        return $new_tag::lastID();
    }

    public function unset_if_exist()
    {
        foreach ($this->parse_data as $ln => $items) {
            foreach ($items as $item) {
                if ($id = array_search($item, $this->db_data)) {
                    $this->result[] = $id;
                } else {
                    $lan = 'title_' . $ln;
                    $new_id = $this->add_new_tag([$lan => $item]);
                    $this->result[] = $new_id;
                }

            }
        }
    }
}

