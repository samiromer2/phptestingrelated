<?php
use PHPUnit\Framework\TestCase;
function isPalindrome($x) {
    if ($x < 0) return false;
    $str = strval($x);
    return $str === strrev($str);
}
class PalindromeTest extends TestCase
{
    public function testIsPalindrome()
    {
        // Example 1
        $this->assertTrue(isPalindrome(121));
        
        // Example 2
        $this->assertFalse(isPalindrome(-121));
        
        // Example 3
        $this->assertFalse(isPalindrome(10));
        
        // Additional Test Cases
        $this->assertTrue(isPalindrome(0)); // Edge case: single-digit number
        $this->assertTrue(isPalindrome(1221)); // Even number of digits
        $this->assertFalse(isPalindrome(1234)); // Not a palindrome
    }
}
