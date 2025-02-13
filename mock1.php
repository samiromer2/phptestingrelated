<?php
//this is the mock
interface HttpFetcher
{
    public function fetch(): array;
}
class BuildData
{
    public function __construct(
        private HttpFetcher $fetcher,
    ) {}

    public function build(): array
    {
        $data = $this->fetcher->fetch();

        if ($data['status'] !== 'OK') {
            throw new Exception('Status was not OK.');
        }

        return $data;
    }
}



use PHPUnit\Framework\TestCase;

class mock1 extends TestCase
{
    public function testBuildReturnsDataWhenStatusIsOk()
    {
        // Create a mock for the HttpFetcher class
        $fetcherMock = $this->createMock(HttpFetcher::class);

        // Configure the mock to return specific data
        $fetcherMock->method('fetch')->willReturn([
            'status' => 'OK',
            'data' => ['key' => 'value']
        ]);

        // Instantiate the BuildData class with the mock
        $buildData = new BuildData($fetcherMock);

        // Call the build method and assert the results
        $result = $buildData->build();
        $this->assertSame(['status' => 'OK', 'data' => ['key' => 'value']], $result);
    }

    public function testBuildThrowsExceptionWhenStatusIsNotOk()
    {
        // Create a mock for the HttpFetcher class
        $fetcherMock = $this->createMock(HttpFetcher::class);

        // Configure the mock to return specific data
        $fetcherMock->method('fetch')->willReturn([
            'status' => 'ERROR',
        ]);

        // Instantiate the BuildData class with the mock
        $buildData = new BuildData($fetcherMock);

        // Assert that the build method throws an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Status was not OK.');

        $buildData->build();
    }
}