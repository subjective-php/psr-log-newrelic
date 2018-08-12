<?php

namespace SubjectivePHPTest\Psr\Log;

use SubjectivePHP\Psr\Log\NewRelicLogger;
use Psr\Log\LogLevel;

/**
 * @coversDefaultClass \SubjectivePHP\Psr\Log\NewRelicLogger
 * @covers ::__construct
 * @covers ::<private>
 */
final class NewRelicLoggerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logWithOnlyMessage()
    {
        $newRelicAgentMock = $this->getNewRelicAgentMock(LogLevel::ERROR, 'an error message', ['foo' => 'bar']);
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log(LogLevel::ERROR, 'an error message', ['foo' => 'bar']);
    }

    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logWithException()
    {
        $exception = new \RuntimeException();
        $newRelicAgentMock = $this->getNewRelicAgentMock(LogLevel::ALERT, 'an alert message', [], $exception);
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log(LogLevel::ALERT, 'an alert message', ['exception' => $exception]);
    }

    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logIgnoredLevel()
    {
        $newRelicAgentMock = $this->getMockBuilder('\\SobanVuex\\NewRelic\\Agent')->getMock();
        $newRelicAgentMock->expects($this->exactly(0))->method('addCustomParameter');
        $newRelicAgentMock->expects($this->exactly(0))->method('noticeError');
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log(LogLevel::DEBUG, 'a debug message');
    }

    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logWithNonScalarContext()
    {
        $newRelicAgentMock = $this->getNewRelicAgentMock(
            LogLevel::ERROR,
            'an error message',
            [
                'foo' => 'bar',
                'extra' => var_export(new \StdClass(), true),
            ]
        );
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log(LogLevel::ERROR, 'an error message', ['foo' => 'bar', 'extra' => new \StdClass()]);
    }

    /**
     * @test
     * @covers ::log
     *
     * @return void
     */
    public function logError()
    {
        $error = new \Error('an error message', E_ERROR);
        $exception = new \ErrorException(
            $error->getMessage(),
            0,
            $error->getCode(),
            $error->getFile(),
            $error->getLine()
        );
        $newRelicAgentMock = $this->getNewRelicAgentMock(LogLevel::ALERT, 'an error message', [], $exception);
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log(LogLevel::ALERT, 'an error message', ['exception' => $error]);
    }

    private function getNewRelicAgentMock(
        string $level,
        string $message,
        array $parameters,
        \Exception $exception = null
    ) {
        $newRelicAgentMock = $this->getMockBuilder('\\SobanVuex\\NewRelic\\Agent')->setMethods(
            ['addCustomParameter', 'noticeError']
        )->getMock();
        $consecutiveKeyValues = [['level', $level]];
        foreach ($parameters as $key => $value) {
            $consecutiveKeyValues[] = [$key, $value];
        }

        $newRelicAgentMock->expects($this->exactly(count($consecutiveKeyValues)))->method(
            'addCustomParameter'
        )->withConsecutive(...$consecutiveKeyValues);
        $newRelicAgentMock->expects($this->once())->method('noticeError')->with($message, $exception);
        return $newRelicAgentMock;
    }
}
