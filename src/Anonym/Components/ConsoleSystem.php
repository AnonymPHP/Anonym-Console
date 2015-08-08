<?php
    /**
     *
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Components\Console;


    /**
     * Class System
     * @package Application\Console
     */
    abstract class ConsoleSystem
    {
        /**
         * Bu Kısıma eklediğiniz sınıflar birer komut olarak algılanacaktır
         * @var array
         */
        private $commands = [
            //
        ];

        /**
         * Komutları getirir
         *
         * @return array
         */
        public function getCommands()
        {
            return $this->commands;
        }

        /**
         * Komutları atar
         *
         * @param array $commands
         * @return System
         */
        public function setCommands($commands)
        {
            $this->commands = $commands;
            return $this;
        }
    }
