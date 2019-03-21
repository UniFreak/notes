# Core concept

## logger

every Logger instance has a `channel` (name) and a stack of `handlers`

## channel

a great way to identify to which part of the application a record is related. like `db`, `request`, `router`...

## handler

    file&syslog

    + `StreamHandler`:
    + `RotatingFileHandler`
    + `SyslogHandler`
    + `ErrorLogHandler`
    + `ProcessHandler`

    alerts&emails

    + `NativeMailerHandler`
    + `SwiftMailerHandler`
    + `SendGridHandler`
    + `MandrillHandler`
    + `PushoverHandler`
    + `HipChatHandler`
    + `FlowdockHandler`
    + `SlackbotHandler`
    + `SlackWebhookHandler`
    + `SlackHandler`
    + `FleepHookHandler`
    + `IFTTTHandler`

    server&networked

    + `SocketHandler`
    + `AmqpHandler`
    + `GelfHandler`
    + `CubeHandler`
    + `RavenHandler`
    + `ZendMonitorHandler`
    + `NewRelicHandler`
    + `LogglyHandler`
    + `RollbarHandler`
    + `SyslogUdpHandler`
    + `LogEntriesHandler`
    + `LogmaticHandler`
    + `SqsHandler`

    development:

    + `FirePHPHandler`
    + `ChromePHPHandler`
    + `BrowserConsoleHandler`
    + `PHPConsoleHandler`

    database

    + `RedisHandler`
    + `MongoDBHandler`
    + `CouchDBHandler`
    + `DoctrineCouchDBHandler`
    + `ElasticSearchHandler`
    + `DynamoDbHandler`

    wrappers/special handlers

    + `FingersCrossedHandler`
    + `DeduplicationHandler`
    + `WhatFailureGroupHandler`
    + `BufferHandler`
    + `GroupHandler`
    + `FilterHandler`
    + `SamplingHandler`
    + `NoopHandler`
    + `NullHandler`
    + `PsrHandler`
    + `TestHandler`
    + `HandlerWrapper`

## record

understand this is essential to extend Monolog

log message structure:
- message
- level
- level_name
- context
- channel
- datetime
- extra

The main difference is that context can be supplied in user land (it is the 3rd parameter to Logger::addRecord()) whereas extra is internal only and can be filled by processors. The reason processors write to extra and not to context is to prevent overriding any user provided data in context


## formatter

- `LineFormatter`
- `HtmlFormatter`
- `NormalizerFormatter`
- `ScalarFormatter`
- `JsonFormatter`
- `WildfireFormatter`
- `ChromePHPFormatter`
- `GelfMessageFormatter`
- `LogstashFormatter`
- `ElasticaFormatter`
- `LogglyFormatter`
- `FlowdockFormatter`
- `MongoDBFormatter`
- `LogmaticFormatter`

## processor

- `PsrLogMessageProcessor`
- `IntrospectionProcessor`
- `WebProcessor`
- `MemoryUsageProcessor`
- `MemoryPeakUsageProcessor`
- `ProcessIdProcessor`
- `UidProcessor`
- `GitProcessor`
- `MercurialProcessor`
- `TagProcessor`

# Log levels

# Adding extra data in the record
- by using the logging context
- or using processor: can be registered on a specific handler instead of the logger to apply only for this handler

# Utilities

- Registry
- ErrorHandler
- ErrorLevelActivationStrategy
- ChannelLevelActivationStrategy

# Extending

writing your own handler:


```php
<?php

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class PDOHandler extends AbstractProcessingHandler
{
    private $initialized = false;
    private $pdo;
    private $statement;

    public function __construct(PDO $pdo, $level = Logger::DEBUG, $bubble = true)
    {
        $this->pdo = $pdo;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        $this->statement->execute(array(
            'channel' => $record['channel'],
            'level' => $record['level'],
            'message' => $record['formatted'],
            'time' => $record['datetime']->format('U'),
        ));
    }

    private function initialize()
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS monolog '
            .'(channel VARCHAR(255), level INTEGER, message LONGTEXT, time INTEGER UNSIGNED)'
        );
        $this->statement = $this->pdo->prepare(
            'INSERT INTO monolog (channel, level, message, time) VALUES (:channel, :level, :message, :time)'
        );

        $this->initialized = true;
    }
}
```

