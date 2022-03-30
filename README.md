# think-alibabacloud

Face verify for tp5 or tp6
## 安装

### 执行命令安装
```
composer require qingsong/think-alibabacloud
```

## 调用方法
```
$faceobj = new \qingsong\alibabacloud\Faceverify($accessKeyId, $accessKeySecret);
$result = $faceobj->imagecomparison($imageurla, $imageurlb);   
if ($result['Data']['Confidence'] > 90) {
/////相似度大于90/////
}
```

## 删除包
```
composer remove qingsong/think-alibabacloud
```

