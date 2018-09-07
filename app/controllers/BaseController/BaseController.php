<?php

namespace App\Controllers;

use Lib\Packeg\BasePackeg;
use System\DB;
use System\ORM;
use System\TwigView;
use System\Lang;

abstract class BaseController
{
    protected $twig;
    protected $options;
    protected $lang;
    protected $connection;
//    protected $user_id = null;

    public function __construct()
    {
        $this->verification();

//        $this->options = new BasePackeg();

//        $this->lang = new Lang(__DIR__ . '/../../../var/lang/' .$this->options->param['ln'].'.php');

//        $this->connection = DB::connection();

        $this->twig  = new TwigView();
//        $this->twig->addG('ln', $this->lang->get_list());
//        $this->twig->addG('opt', $this->options->param);
    }

    protected function verification()
    {
        if(isset($_SESSION['token']) && isset($_SESSION['id'])){
            $user_token = '\''.$_SESSION['token'].'\'';
            $user_id = '\''.$_SESSION['id'].'\'';

            $token = new ORM('token');
            $token->select();
            $token->where("hash = $user_token && id_user = $user_id");

            try{
                if($token->run()){
                    return true;
                }
                else{
                    return false;
                }

            }catch (\Exception $e){
                $e->getMessage('Dont work DB;');
            }
        }
    }


}