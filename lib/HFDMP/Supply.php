<?php
namespace HFDMP;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Supply
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Tokyo");
    }

    public function run()
    {
        $this->bake();
        $this->log();
        $this->output();
    }

    public function bake()
    {
        if (!isset($_COOKIE["HeadFirstDMP"])) {
            setcookie("HeadFirstDMP", Common::generateId(), time()+3600);
        }
    }

    public function log()
    {
        $log = new Logger('name');
        $stream = new StreamHandler(__DIR__ . '/../../log/your.log', Logger::DEBUG);
        $log->pushHandler($stream);
        $log->addInfo("hoge");
    }

    public function output()
    {
        header('Content-Type: image/gif');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        echo base64_decode("R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==");
    }
}
