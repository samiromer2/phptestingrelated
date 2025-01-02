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

class stub2 extends TestCase
{
    //CalculatorTest
    public function testAdd()
    {
        // Create a stub for LoggerInterface
        $loggerStub = $this->createStub(LoggerInterface::class);

        // Configure the stub's log method to do nothing
        $loggerStub->method('log');

        // Create an instance of Calculator with the logger stub
        $calculator = new Calculator($loggerStub);

        // Assert that the add method returns the correct result
        $this->assertSame(5, $calculator->add(2, 3));
    }

    public function testSubtract()
    {
        // Create a stub for LoggerInterface
        $loggerStub = $this->createStub(LoggerInterface::class);

        // Create an instance of Calculator with the logger stub
        $calculator = new Calculator($loggerStub);

        // Assert that the subtract method returns the correct result
        $this->assertSame(2, $calculator->subtract(5, 3));
    }
}