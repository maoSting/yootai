# Yootai composer 包
Current version is 0.0.1


## 运行环境
php >= 7.0.0

## 使用方法

```
use Yootai\Config\Config;
use Yootai\Manager;


    $data = Manager::action(["key"=>"your key", "secret"=>"your secret"], Config::METHOD_SKU_LIST, ["page"=>1, "size"=>10 ]);
```