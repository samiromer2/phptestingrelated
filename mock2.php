<?php

class Calculator
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function add(int $a, int $b): int
    {
        $result = $a + $b;
        $this->logger->log("Adding $a and $b to get $result");
        return $result;
    }

    public function subtract(int $a, int $b): int
    {
        $result = $a - $b;
        $this->logger->log("Subtracting $b from $a to get $result");
        return $result;
    }
}


interface LoggerInterface
{
    public function log(string $message): void;
}

use PHPUnit\Framework\TestCase;

class mock2 extends TestCase
{
    //CalculatorTest
    public function testAdd()
    {
        // Create a mock for LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);

        // Expect the log method to be called once with specific arguments
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Adding 2 and 3 to get 5');

        // Create an instance of Calculator with the logger mock
        $calculator = new Calculator($loggerMock);

        // Assert that the add method returns the correct result
        $this->assertSame(5, $calculator->add(2, 3));
    }

    public function testSubtract()
    {
        // Create a mock for LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);

        // Expect the log method to be called once with specific arguments
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Subtracting 3 from 5 to get 2');

        // Create an instance of Calculator with the logger mock
        $calculator = new Calculator($loggerMock);

        // Assert that the subtract method returns the correct result
        $this->assertSame(2, $calculator->subtract(5, 3));
    }
}