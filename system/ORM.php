<?php


namespace System;


class ORM extends DB
{
    private $table;
    private $param;

    public $query;

    const TODAY =  ' CURDATE()';
    const SORT_ASK =  ' ORDER BY id ASC ';
    const SORT_DESC =  ' ORDER BY id DESC ';
    const LEFT_JOIN =  'LEFT JOIN';
    const RIGHT_JOIN =  'RIGHT JOIN';
    const INNER_JOIN =  'INNER JOIN';

    public function __construct($table)
    {
        $this->table = $table;

    }


    public function select($data = '*', $join = null)
    {
        $q = '';

        if(is_array($data)){
            foreach ($data as $v){
                $q .= $v;
            }
        }elseif(is_string($data)){
            $q = $data;
        }

        $this->query = 'SELECT '.$q.' FROM ';

        if(!is_array($this->table)){
            $this->query .= $this->table;
        }else{
            $front_table = array_shift($this->table);
            $this->query .= $front_table;

            foreach ($this->table as $item){
                $this->query .= ' '.$join.' '.$item.' ON '.$front_table.'.id_'.$item.' = '.$item.'.id' ;
            }
        }
    }

    public function insert($param)
    {
        $this->param = $param;
        if($param == null || !is_array($param)){
            throw new \Exception("Не валідні данні для вставки");
        }

        $p1 = '';
        $p2 = '(';

        foreach ($param as $k => $v){
            $p1 .= $k.', ';
            $p2 .= (is_int($k)) ? ':'.$k.', ' : ''.':'.$k.', ' ;
        }

        $p2 = rtrim($p2, ', ');
        $p2 .= ')';

        $this->query = 'INSERT INTO '.$this->table.' ('.trim($p1, ', ').') VALUES '.$p2;

    }

    public function update($data)
    {
        $q = '';
//        foreach ($data as $items) {
            foreach ($data as $k => $item){
                $q .= $k.' = '.$item.', ';
            }
//        }

        $q ='UPDATE '.$this->table.' SET '.rtrim($q, ', ');
        $this->query .= $q;
    }

    public function delete(){
        $q = 'DELETE FROM '.$this->table.' ';
        $this->query = $q;
    }

    public function where($string)
    {
        if(is_string($string)){
            $this->query .= ' WHERE '. $string;
        }
//        elseif(is_array($string)){
//
//        }
    }

    public function run($sort = null)
    {
//        if (!$sort == null){
//            $this->query .= $sort;
//        }
        $res = array();
        try{
            $response = self::connection();
            $x = $response->prepare($this->query);
            $x->execute($this->param);
            $res = $x->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\Exception $e){
            $e->getMessage();
        }
        return $res;
    }

    public function limit($num = 0)
    {
        $q = ' LIMIT '.$num;
        $this->query .= $q;
    }

    public function sort($metod){
        $this->query .= $metod;
    }

    public static function lastID()
    {
        $id =  self::connection()->lastInsertId();
        return $id;
    }
}