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
    protected $description = 'Compter le nombre de mots dans un fichier';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $wordCount = str_word_count(file_get_contents(dirname(__FILE__) . "/../../../resources/my_text.txt"));
        echo "Nombre de mots dans le fichier : $wordCount" . PHP_EOL;
    }
}
