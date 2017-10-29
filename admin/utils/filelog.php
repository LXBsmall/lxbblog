<?php

/**
 * Created by PhpStorm.
 * User: lxb
 * Date: 2017/10/15
 * Time: 10:42
 */

class LB_FileLog
{
    protected $logfile = __DIR__.'/../../log/lxbsmile.log';
    protected $errorlogfile = __DIR__.'/../../log/error.log';

    public function log($data){
        if(is_array($data)){
            $buf = 'array{';
            foreach($data as $k=>$v){
                $buf = $buf.''.$k.'=>'.$v.', ';
            }
            $buf = $buf.'};';
            $data = $buf;
        }
        $date =  date('Y-m-d h:i:s');
        $log = $date.' '.$data.PHP_EOL;
        $hlogfile = fopen($this->logfile, 'a');
        if(!$hlogfile){
            return false;
        }
        return fwrite($hlogfile, $log);
    }

    public function errorLog($data){
        if(is_array($data)){
            $buf = 'array{';
            foreach($data as $k=>$v){
                $buf = $buf.'{'.$k.'=>'.$v.',';
            }
            $buf = $buf.'};';
            $data = $buf;
        }

        $date =  date('Y-m-d h:i:s');
        $log = $date.' '.$data.PHP_EOL;
        $hlogfile = fopen($this->errorlogfile, 'a');
        if(!$hlogfile){
            return false;
        }
        return fwrite($hlogfile,$log);
    }

}