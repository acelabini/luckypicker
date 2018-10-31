<?php
date_default_timezone_set("Asia/Manila");
class LuckyPicker {

    protected $generatedOn;

    public function generateLuckyNumbers(int $combinations, int $luckyCount = 1)
    {
        $this->generatedOn = date('M d Y H:i:s');
        $result = $this->initiate($combinations, $luckyCount);
//        setcookie("results",$result, time() + (86400*7),"/");
        return $result; //$this->concatinateResult($result, "<br/>");
    }

    public function initiate(int $combinations, int $luckyCount)
    {
        $list = [];
        for($i = 1; $i <= $luckyCount; $i++) {
            $luckyPicked = [];
            $luckyPicked = $this->generateCombinations($luckyPicked, $combinations);
            if(!$this->checkDuplicates($list, $luckyPicked))
                $list[] = $luckyPicked;
        }
        $this->writeResult($list);
        return $list;
    }

    public function generateCombinations(array $luckyPicked, int $combinations) : array
    {
        for ($j = 1; $j <= $combinations; $j++) {
            $luckyPicked = $this->generateNumber($luckyPicked);
        }
        return $luckyPicked;
    }

    public function generateNumber(array $luckyPicked)
    {
        $start = 1;
        $end = 58;
        if(array_search($rand = rand($start, $end), $luckyPicked) === false) {
            $luckyPicked[] = $rand;
            return $luckyPicked;
        } else {
            return $this->generateNumber($luckyPicked);
        }
    }

    public function checkDuplicates(array $list, array $generatedNumbers) : bool
    {
        $luckyHits = array_map(
            function($item) use ($generatedNumbers) {
                return array_diff($item, $generatedNumbers);
            },$list
        );
        return count($list) ? count(array_filter($luckyHits)) === 0 : false;
    }

    public function concatinateResult(array $list, $breakLine = PHP_EOL, $withDate = null)
    {
        $result = array_map(
            function($item) use($withDate) {
                return $withDate.implode("  ",$item);
            }, $list
        );
        return implode($breakLine, $result). $breakLine;
    }

    private function writeResult(array $list)
    {
        $file = fopen('results.txt','a');
        $result = $this->concatinateResult($list, PHP_EOL, $this->systemGenerated());
        fwrite($file, $result);
    }

    public function systemGenerated() : string
    {
        return "[ ".$this->generatedOn." ] ";
    }
}


$luckyPicker = new LuckyPicker();
$result = $luckyPicker->generateLuckyNumbers(6, 1);
echo json_encode($result);