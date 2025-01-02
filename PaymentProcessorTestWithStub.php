<?php

interface PaymentGatewayInterface
{
    public function charge(float $amount): void;
}
interface LoggerInterface
{
    public function log(string $message): void;
}
class PaymentProcessor
{
    private $paymentGateway;
    private $logger;

    public function __construct(PaymentGatewayInterface $paymentGateway, LoggerInterface $logger)
    {
        $this->paymentGateway = $paymentGateway;
        $this->logger = $logger;
    }

    public function processPayment(float $amount): bool
    {
        if ($amount <= 0) {
            $this->logger->log("Invalid payment amount: $amount");
            return false;
        }

        try {
            $this->paymentGateway->charge($amount);
            $this->logger->log("Payment of $amount processed successfully.");
            return true;
        } catch (\Exception $e) {
            $this->logger->log("Payment failed: " . $e->getMessage());
            return false;
        }
    }
}


use PHPUnit\Framework\TestCase;

class PaymentProcessorTestWithStub extends TestCase
{
    public function testProcessPaymentWithValidAmount()
    {
        // Create a stub for PaymentGatewayInterface
        $gatewayStub = $this->createStub(PaymentGatewayInterface::class);
        
        // Configure the stub to do nothing (successful charge)
        $gatewayStub->method('charge');

        // Create a mock for LoggerInterface to verify interactions
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Payment of 100 processed successfully.');

        // Create PaymentProcessor with the stub and mock
        $processor = new PaymentProcessor($gatewayStub, $loggerMock);

        // Assert the processPayment method returns true for valid payment
        $this->assertTrue($processor->processPayment(100));
    }

    public function testProcessPaymentWithInvalidAmount()
    {
        // Create a stub for PaymentGatewayInterface
        $gatewayStub = $this->createStub(PaymentGatewayInterface::class);

        // Create a mock for LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Invalid payment amount: -10');

        // Create PaymentProcessor with the stub and mock
        $processor = new PaymentProcessor($gatewayStub, $loggerMock);

        // Assert the processPayment method returns false for invalid payment
        $this->assertFalse($processor->processPayment(-10));
    }
}
