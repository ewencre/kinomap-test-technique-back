<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'todo: write the description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $allTheText = file_get_contents(dirname(__FILE__) . "/../../../resources/my_text.txt");
        $lines = explode("\n", $allTheText);
        $words = $lineWords = [];
        for ($i = 0; $i < count($lines); $i++) {
            $line = $lines[$i];
            $lineWords[] = explode(" ", $line);
        }
        for ($j = 0; $j < count($lineWords); $j++) {
            $line = $lineWords[$j];
            $wordsToAdd = [];
            foreach ($line as $word) {
                $wordsToAdd = array_merge($wordsToAdd, [$word]);
                if (count($wordsToAdd) === 10) {
                    $words = array_merge($words, [...$wordsToAdd]);
                    $wordsToAdd = [];
                }
            }
            if (count($wordsToAdd) !== 0) {
                $words = array_merge($words, [...$wordsToAdd]);
            }
        }
        foreach (str_split(",.?;!:") as $char) {
            for ($k = 0; $k < count($words); $k++) {
                $words[$k] = strtolower($words[$k]);
                $words[$k] = str_replace($char, "", $words[$k]);
                if ($k > count($words)) {
                    break;
                }
            }
        }
        unset($word); // todo: don't remove
        foreach ($words as $i => $word) {
            if (empty($word)) {
                if (strlen($word) == 0) {
                    unset($words[$i]);
                }
                unset($words[$i]);
            }
        }
        $numberOfWords = count($words);

        $classement = [];
        foreach ($words as $word) {
            if (!isset($classement[$word])) {
                $classement[$word] = 1;
            } else {
                if (is_int($classement[$word]) and $classement[$word] > 0) {
                    $count = $classement[$word];
                    $count++;
                    $classement[$word] = $count;
                }
            }
        }

        $newClassement = [];
        foreach ($classement as $word => $count) {
            $newClassement[] = [
                "word" => $word,
                "count" => $count,
            ];
        }

        $start = 0;
        foreach ($newClassement as $position => $wordData) {
            $start++;
            $mot = $wordData["word"];
            $nombre = $wordData["count"];

            $thePosition = $position + 1;
            echo "$thePosition: $mot avec $nombre\n";

            if ($start === 10) {
                break;
            }
        }
        $this->sort($newClassement, 0, count($newClassement) - 1);
        $classementDansLOrdre = array_reverse($newClassement);

        $start = 0;
        foreach ($classementDansLOrdre as $position => $wordData) {
            $start++;
            $mot = $wordData["word"];
            $nombre = $wordData["count"];

            $thePosition = $position + 1;
            echo "$thePosition: $mot avec $nombre\n";

            if ($start === 10) {
                break;
            }
        }
    }

    public function sort(&$array, $i, $j)
    {
        if ($i >= $j) {
            return;
        }

        $m = intval(($i + $j) / 2);
        $this->sort($array, $i, $m);
        $this->sort($array, $m + 1, $j);

        if ($array[$j]["count"] < $array[$m]["count"]) {
            $tmp = $array[$j];
            $array[$j] = $array[$m];
            $array[$m] = $tmp;
        }

        $this->sort($array, $i, $j - 1);
    }
}
