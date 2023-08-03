<?php


use Owin\OwinCommonUtil\CodeUtil;
use Owin\OwinCommonUtil\Enums\ServiceCodeEnum;
use PHPUnit\Framework\TestCase;

class CodeUtilTest extends TestCase
{
    public function testGenerateOrderCode()
    {
        $orderCodes = [];
        for ($i = 0; $i < 100; $i++) {
            $orderCodes[] = CodeUtil::generateOrderCode(ServiceCodeEnum::GTCS);
            usleep(1000);
        }
        $orderCode = $orderCodes[0];

        // 고유성 테스트
        $this->assertCount(100, array_unique($orderCodes));
        // 길이 테스트
        $this->assertEquals(20, strlen($orderCode));
        // 서비스 코드 테스트
        $this->assertEquals(ServiceCodeEnum::GTCS->value, substr($orderCode, 0, 2));
    }

    public function testGenerateRandomCode()
    {
        // 길이 테스트
        $randomCode = CodeUtil::generateRandomCode(10);
        $this->assertEquals(10, strlen($randomCode));
    }

    public function testGetServiceCodeFromOrderCode()
    {
        $orderCode = CodeUtil::generateOrderCode(ServiceCodeEnum::GTCS);
        $this->assertEquals(ServiceCodeEnum::GTCS, CodeUtil::getServiceCodeEnumFromOrderCode($orderCode));
    }

    public function testConvertOrderCodeToCuSpc()
    {
        // 20 자리 변환 테스트 => 유지
        $orderCode = CodeUtil::generateOrderCode(ServiceCodeEnum::GTCS);
        $this->assertEquals($orderCode, CodeUtil::convertOrderCodeToCuSpc($orderCode));

        // 20 자리 미만 변환 테스트 => 유지
        $orderCode = '2308011110abc';
        $this->assertEquals($orderCode, CodeUtil::convertOrderCodeToCuSpc($orderCode));

        // 기존 번호 체계 변환 확인 => 앞 1자리 제거
        $orderCode = '230803711110000002457';
        $this->assertEquals('30803711110000002457', CodeUtil::convertOrderCodeToCuSpc($orderCode));
    }
}
