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

class PaymentProcessorTestWithMock extends TestCase
{
    public function testProcessPaymentSuccess()
    {
        // Create a mock for PaymentGatewayInterface
        $gatewayMock = $this->createMock(PaymentGatewayInterface::class);
        
        // Expect the charge method to be called once with the specific amount
        $gatewayMock->expects($this->once())
                    ->method('charge')
                    ->with(100);

        // Create a mock for LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Payment of 100 processed successfully.');

        // Create PaymentProcessor with mocks
        $processor = new PaymentProcessor($gatewayMock, $loggerMock);

        // Assert the processPayment method returns true
        $this->assertTrue($processor->processPayment(100));
    }

    public function testProcessPaymentFailure()
    {
        // Create a mock for PaymentGatewayInterface
        $gatewayMock = $this->createMock(PaymentGatewayInterface::class);

        // Configure the mock to throw an exception when charge is called
        $gatewayMock->expects($this->once())
                    ->method('charge')
                    ->with(100)
                    ->will($this->throwException(new \Exception('Insufficient funds')));

        // Create a mock for LoggerInterface
        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())
                   ->method('log')
                   ->with('Payment failed: Insufficient funds');

        // Create PaymentProcessor with mocks
        $processor = new PaymentProcessor($gatewayMock, $loggerMock);

        // Assert the processPayment method returns false
        $this->assertFalse($processor->processPayment(100));
    }
}
