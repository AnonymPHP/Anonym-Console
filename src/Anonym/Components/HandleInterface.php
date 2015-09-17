<?php

    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Components\Console;


    /**
     * Interface HandleInterface
     * @package Anonym\Console
     */
    interface HandleInterface
    {
        /**
         * execute the command
         *
         * @return mixed
         */
        public function handle();
    }
