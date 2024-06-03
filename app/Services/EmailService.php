<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require __DIR__ . '/../../bootstrap.php';

class EmailService
{
    private $connection;
    private $channel;
    protected $defaultQueue = 'email_queue';

    public function __construct()
    {
        $config = include __DIR__ . '/../../config/rabbitmq.php';
        $this->connection = new AMQPStreamConnection($config['host'], $config['port'], $config['user'], $config['password']);
        $this->channel = $this->connection->channel();
        
    }

    public function send($data)
    {
        $this->channel->queue_declare($this->defaultQueue, false, false, false, false);
        $msg = new AMQPMessage(json_encode($data));
        $this->channel->basic_publish($msg, '', $this->defaultQueue);

        return self::close();
    }

    public function consume($callback)
    {
        $this->channel->basic_consume($this->defaultQueue, '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }

        return self::close();
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }

    // public function __destruct()
    // {
    //     $this->channel->close();
    //     $this->connection->close();
    // }
}
