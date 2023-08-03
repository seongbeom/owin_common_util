<?php

namespace Owin\OwinCommonUtil;

use Owin\OwinCommonUtil\Enums\ServiceCodeEnum;
use Owin\OwinCommonUtil\Enums\CharactersEnum;

class CodeUtil
{
    /**
     * 주문 번호 생성
     * - 20 자리 => 시간 (12) + 서비스 코드 (2) + microtime 일부 (3) +  난수 (3)
     * @param ServiceCodeEnum $serviceCodeEnum
     * @return string
     */
    public static function generateOrderCode(ServiceCodeEnum $serviceCodeEnum): string
    {
        $microTime = explode(' ', microtime());
        $microTimeCode = sprintf('%03d', floor($microTime[0] * 100));

        return $serviceCodeEnum->value . date('ymdhis') . $microTimeCode . self::generateRandomCode(3);
    }

    /**
     * 서비스 코드 추출
     * @param string $orderCode
     * @return ServiceCodeEnum
     */
    public static function getServiceCodeEnumFromOrderCode(string $orderCode): ServiceCodeEnum
    {
        return ServiceCodeEnum::tryFrom(substr($orderCode, 0, 2));
    }

    /**
     * 난수 생성
     * @param int $length
     * @param string $characters
     * @return string
     */
    public static function generateRandomCode(int $length, string $characters = ''): string
    {
        $characters = $characters ?: CharactersEnum::ALPHANUMERIC->value;

        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $code;
    }

    /**
     * CU, SPC 용 주문 번호로 변환
     * - 20 자리 이하로 제한 해야 한다
     * @param $orderCode
     * @return string
     */
    public static function convertOrderCodeToCuSpc($orderCode): string
    {
        return substr($orderCode, -20);
    }
}