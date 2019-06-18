<?php


namespace Chat\Component;


use Chat\AbstractInterface\ServerInterface;

abstract class CreateServer implements ServerInterface
{

    const TYPE_HTTP = 'http';
    const TYPE_RPC = 'rpc';
    const TYPE_TCP = 'tcp';
    const TYPE_WS = 'ws';

    /**
     * server
     */
    protected $swooleServer;

    /**
     * @var string
     */
    protected static $serverType = 'TCP';

    /**
     * @var string
     */
    protected $host = '0.0.0.0';

    /**
     * @var int
     */
    protected $port = 18307;

    /**
     * @var int
     */
    protected $mode = SWOOLE_PROCESS;

    /**
     * Default socket type
     * @var int
     */
    protected $type = SWOOLE_SOCK_TCP;

    /**
     * Pid file
     * @var string
     */
    protected $pidFile = '@runtime/swoft.pid';

    /**
     * Pid name
     * @var string
     */
    protected $pidName = 'chat';

    /**
     * Record started server PIDs and with current workerId
     * @var array
     */
    private $pidMap = [
        'masterPid' => 0,
        'managerPid' => 0,
        // if = 0, current is at master/manager process.
        'workerPid' => 0,
        // if < 0, current is at master/manager process.
        'workerId' => -1,
    ];

    /**
     * @var array 公共配置信息
     */
    public $setting = [];

    public function stop(): bool
    {

    }

    public function reload($onlyTask = false)
    {
        // TODO: Implement reload() method.
    }

    public function isRunning(): bool
    {
        // TODO: Implement isRunning() method.
    }

    public function setDaemonize()
    {
        // TODO: Implement setDaemonize() method.
    }

    public function onStart(\swoole_server $server)
    {
        // TODO: Implement onStart() method.
    }

    public function onShutdown(\swoole_server $server)
    {
        // TODO: Implement onShutdown() method.
    }

    public function onManagerStart(\swoole_server $server)
    {
        // TODO: Implement onManagerStart() method.
    }

    public function onManagerStop(\swoole_server $server)
    {
        // TODO: Implement onManagerStop() method.
    }

    public function onWorkerStart(\swoole_server $server, int $worker_id)
    {
        // TODO: Implement onWorkerStart() method.
    }

    public function onWorkerStop(\swoole_server $server, int $worker_id)
    {
        // TODO: Implement onWorkerStop() method.
    }

    public function onWorkerError(\swoole_server $server, int $worker_id, int $worker_pid, int $exit_code, int $signal)
    {
        // TODO: Implement onWorkerError() method.
    }

    public function onPipeMessage(\swoole_server $server, int $src_worker_id, $message)
    {
        // TODO: Implement onPipeMessage() method.
    }
}