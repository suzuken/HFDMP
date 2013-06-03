<?php
namespace HFDMP;

class Deliver
{
    public $exists = false;
    public $segment = null;
    public $id = null;

    public function run()
    {
        $this->read();
        $this->searchSegment();
        $this->output();
    }

    public function searchSegment()
    {
        $handle = fopen(__DIR__ . "/../../log/your.log", "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $r = json_decode(trim($buffer), true);
                if (
                    isset($r["context"]["cookie"])
                    && isset($r["context"]["cookie"]["HeadFirstDMP"])
                    && $r["context"]["cookie"]["HeadFirstDMP"] === $this->id
                    && $r["context"]["req"]["segment"] === $this->segment
                ) {
                    $this->exists = true;
                    return;
                }
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
    }

    public function read()
    {
        $this->segment = isset($_GET["seg"]) ? $_GET["seg"] : null;
        $this->id = isset($_COOKIE["HeadFirstDMP"]) ? $_COOKIE["HeadFirstDMP"] : null;
    }

    public function output()
    {
        header('Content-Type: application/json; charset=utf-8');
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        $success = ($this->exists) ? 1 : 0;
        echo json_encode(array("seg"=>$this->segment, "success"=>$success));
    }

}
