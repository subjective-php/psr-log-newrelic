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
        $this->runNewRelicAgentMock(
            LogLevel::CRITICAL,
            'an error message',
            ['foo' => 'bar'],
            ['foo' => 'bar']
        );
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
        $this->runNewRelicAgentMock(
            LogLevel::EMERGENCY,
            'an alert message',
            [],
            ['exception' => $exception],
            $exception
        );
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
        $this->runNewRelicAgentMock(
            LogLevel::CRITICAL,
            'an error message',
            [
                'foo' => 'bar',
                'extra' => var_export(new \StdClass(), true),
            ],
            ['foo' => 'bar', 'extra' => new \StdClass()]
        );
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
        $this->runNewRelicAgentMock(
            LogLevel::EMERGENCY,
            'an error message',
            [],
            ['exception' => $error],
            $exception
        );
    }

    private function runNewRelicAgentMock(
        string $level,
        string $message,
        array $parameters,
        array $callParams,
        \Exception $exception = null
    ) {
        $builder = $this->getMockBuilder('\\SobanVuex\\NewRelic\\Agent');
        list($majorVersion) = explode('.', \PhpUnit\Runner\Version::id());
        if ($majorVersion < 9) {
            $builder->setMethods(['addCustomParameter', 'noticeError']);
        } else {
            $builder->onlyMethods(['addCustomParameter', 'noticeError']);
        }

        $newRelicAgentMock = $builder->getMock();
        $consecutiveKeyValues = [['level', $level]];
        foreach ($parameters as $key => $value) {
            $consecutiveKeyValues[] = [$key, $value];
        }

        $incrementCalls = new \ArrayObject();
        $newRelicAgentMock->expects(
            $this->exactly(count($consecutiveKeyValues))
        )->method(
            'addCustomParameter'
        )->willReturnCallback(
            function ($key, $value) use ($incrementCalls) {
                $incrementCalls[] = [$key, $value];
            }
        );
        $newRelicAgentMock->expects($this->once())->method('noticeError')->with($message, $exception);
        $logger = new NewRelicLogger($newRelicAgentMock);
        $logger->log($level, $message, $callParams);
        $this->assertSame($consecutiveKeyValues, $incrementCalls->getArrayCopy());
    }
}
