<?php
    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */
    namespace Console;
    use Console\Commands\Test;
    /**
     * Class System
     * @package Application\Console
     */
    abstract class System
    {
        /**
         * Bu Kısıma eklediğiniz sınıflar birer komut olarak algılanacaktır
         * @var array
         */
        protected $commands = [
            Test::class,
        ];
    }
