<?php

namespace qingsong\alibabacloud;

ini_set("display_errors", "on");

require_once 'autoload.php';

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\NlsCloudMeta\NlsCloudMeta;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

/**
 * Class Faceverify
 *
 * 图片相似度比对
 */
class Faceverify {

    private static $accessKeyId;
    private static $accessKeySecret;

    public function __construct($accessKeyId = '', $accessKeySecret = '') {
        self::$accessKeyId = $accessKeyId;
        self::$accessKeySecret = $accessKeySecret;
    }

    public static function imagecomparison($imageurla, $imageurlb) {
        AlibabaCloud::accessKeyClient(self::$accessKeyId, self::$accessKeySecret)
                ->regionId('cn-shanghai')
                ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                    ->product('facebody')
                    // ->scheme('https') // https | http
                    ->version('2019-12-30')
                    ->action('CompareFace')
                    ->method('POST')
                    ->host('facebody.cn-shanghai.aliyuncs.com')
                    ->options([
                        'query' => [
                            'RegionId' => "cn-shanghai",
                            'ImageURLA' => $imageurla,
                            'ImageURLB' => $imageurlb,
                        ],
                    ])
                    ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }

}
