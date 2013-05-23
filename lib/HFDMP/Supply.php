<?php
namespace HFDMP;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Supply
{
    public function run()
    {
        $this->bake();
    }

    public function bake()
    {
        setcookie("HeadFirstDMP", HFDMP\Common::generateId(), time()+3600);
    }

    public function log()
    {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('/tmp/your.log', Logger::WARNING));
    }
}
