<?php

/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/13
 * Time: 12:45
 */
class LB_Query
{

    public $type;
    public $uri;
    public $query;
    public $objs;
    public $is_query_modification;

    private $internal_query;

    public function __construct()
    {

    }

    public function is_home(){
        return $this->type === 'home';
    }

    public function is_admin(){
        return $this->type === 'admin';
    }

    public function query(){

        $u = [];
        $this->parse_uri_string();
        if(preg_match('#(\'|"|;|\./|\\\\|&|=|>|<)#', $this->uri))
            return false;
        $rules = [
            '^/index\.[php|html]$'      => '',
            '^/$'                       => '',
            //'^/admin$'                  => 'admin=1'
        ];
        foreach ($rules as $rule => $rewrite){
            $pattern = '#'.$rule.'#';
            if (preg_match($pattern, $this->uri)){
                $u = preg_replace($pattern, $rewrite, $this->uri);
                break;
            }
        }

        if (!isset($u)){
            $this->type = 'unknown';
            $this->objs = null;
            //lb_die(503, '未知查询!');
            return false;
        }

        $this->internal_query = parse_query_string($u, false, false);

        if (isset($this->internal_query['memory'])){
            $this->type = 'memory';
            return true;
        }

        else if(isset($this->internal_query['admin'])){
            $this->type = 'admin';
            return true;
        }
        else{
            $this->type = 'home';
            return true;
        }


    }

    private function parse_uri_string(){
        $full_uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $pos = strpos($full_uri, '?');
        if(!$pos){
            $uri = $full_uri;
            $query = '';
        }
        else {
            $uri = substr($full_uri, 0, $pos);
            $query = substr($full_uri, $pos+1);
            if (!$query) $query ='';
        }

        $this->uri = urldecode($uri);
        $this->query = parse_query_string($query);

    }
}