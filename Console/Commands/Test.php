<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Console\Commands;

    use Anonym\Components\Console\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;

    /**
     * Class Test
     * @package Anonym\Console\Commands
     */
    class Test extends Command
    {
        /**
         * Konsol İmzası
         *
         * @var string
         */
        protected $signature;
        /**
         * Komut açıklaması
         *
         * @var string
         */
        protected $description = 'Örnek komut';
        /**
         * Komut adı
         *
         * @var string
         */
        protected $name = 'test';

        /**
         * @param InputInterface $input
         * @param OutputInterface $output
         */
        public function handle(InputInterface $input, OutputInterface $output)
        {
            $this->info('başarıyla çalıştı');
        }
    }
