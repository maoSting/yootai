# Yootai composer
Current version is 0.0.1


## ENV
php >= 7.0.0

## HOW TO USE IT

```
use Yootai\Config\Config;
use Yootai\Manager;


$data = Manager::action(["key"=>"your key", "secret"=>"your secret", "host"=> "http://test.domain.com"], Config::METHOD_SKU_LIST, ["page"=>1, "size"=>10 ]);
```
