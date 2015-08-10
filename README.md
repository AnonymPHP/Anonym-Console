Anonym Console
================

AnonymFramework Console Component, laravel'in artisan'ını nasıl kullandığını merak ediyorsanız
inceleyebilirsiniz.

Autoload olayının aktifleşmesi için composer de autoload psr 4 kısmına aşağıyı eklemeniz gerek

```json
"Console\\" : "path"
```

Komutların yüklenebilmesi için 

```php

namespace Console;

class System
{
         /**
          * Bu Kısıma eklediğiniz sınıflar birer komut olarak algılanacaktır
          * @var array
          */
         protected $commands = [
             
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

```



