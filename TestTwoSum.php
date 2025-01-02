<?php
use PHPUnit\Framework\TestCase;

require 'codetowsums.php';

class TestTwoSum extends TestCase
{
    public function testExample1()
    {
        $nums = [2, 7, 11, 15];
        $target = 9;
        $result = twoSum($nums, $target);
        $this->assertEquals([0, 1], $result);
    }
    public function testExample2()
    {
        $nums = [3,2,4];
        $target = 6;
        $result = twoSum($nums, $target);
        $this->assertEquals([1, 2], $result);
    }
    public function testExample3()
    {
        $nums = [3, 3];
        $target = 6;
        $result = twoSum($nums, $target);
        $this->assertEquals([0, 1], $result);
    }
    public function testNegativeNumbers()
    {
        $nums = [-3, 4, 3, 90];
        $target = 0;
        $result = twoSum($nums, $target);
        $this->assertEquals([0, 2], $result);
    }
    public function testLargeInput()
    {
        $nums = range(1, 1000000);
        $target = 1999999;
        $result = twoSum($nums, $target);
        $this->assertEquals([999998, 999999], $result);
    }
}


