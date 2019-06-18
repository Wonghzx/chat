<?php

namespace Chat\Server;

use Chat\Component\CreateServer;
use Chat\Component\TigerBalm;
use Chat\Server\WebSocket\WebSocketEventTrait;
use Swoole\WebSocket\Server as SwooleServer;
use Swoole\Http\Request AS Req;
use Swoole\Http\Response AS Res;
use Swoole\Http\Server as httpServer;

class Server extends CreateServer
{
    use TigerBalm, WebSocketEventTrait;

    public function start()
    {
        $this->swooleServer = new SwooleServer($this->host, $this->port, $this->mode, $this->type);

        $this->swooleServer->set($this->setting);

        $this->swooleServer->on(SwooleEvent::ON_HAND_SHAKE, [$this, 'onHandshake']);
        $this->swooleServer->on(SwooleEvent::ON_MESSAGE, [$this, 'onMessage']);
        $this->swooleServer->on(SwooleEvent::ON_CLOSE, [$this, 'onClose']);

        $this->bindBaseEvent();
        $this->bindTaskEvent();

        if ($this->setting['enable_http']) {
            $this->bindHttpEvent();
        }

        $this->swooleServer->start();
    }

    public function onRequest(Req $request, Res $response)
    {
       print_r($request);
    }

    public function onTask(\swoole_server $server, int $task_id, int $src_worker_id, $data)
    {

    }

    public function onFinish(\swoole_server $server, int $task_id, string $data)
    {

    }

    protected function bindHttpEvent()
    {
        $this->swooleServer->on(SwooleEvent::ON_REQUEST, [$this, 'onRequest']);
    }

    /**
     * 绑定基本事件
     * @author  Wong <[842687571@qq.com]>
     * @created on 2018/12/6 4:17 PM
     * @copyright Copyright (c)
     */
    protected function bindBaseEvent()
    {
        $this->swooleServer->on(SwooleEvent::ON_START, [$this, 'onStart']);
        $this->swooleServer->on(SwooleEvent::ON_SHUTDOWN, [$this, 'onShutdown']);
        $this->swooleServer->on(SwooleEvent::ON_MANAGER_START, [$this, 'onManagerStart']);
        $this->swooleServer->on(SwooleEvent::ON_MANAGER_STOP, [$this, 'onManagerStop']);
        $this->swooleServer->on(SwooleEvent::ON_WORKER_START, [$this, 'onWorkerStart']);
        $this->swooleServer->on(SwooleEvent::ON_WORKER_STOP, [$this, 'onWorkerStop']);
        $this->swooleServer->on(SwooleEvent::ON_WORKER_ERROR, [$this, 'onWorkerError']);
        $this->swooleServer->on(SwooleEvent::ON_PIPE_MESSAGE, [$this, 'onPipeMessage']);
    }

    /**
     * 绑定 Task 事件
     * @author  Wong <[842687571@qq.com]>
     * @created on 2018/12/7 3:19 PM
     * @copyright Copyright (c)
     */
    protected function bindTaskEvent()
    {
        $this->swooleServer->on(SwooleEvent::ON_TASK, [$this, 'onTask']);
        $this->swooleServer->on(SwooleEvent::ON_FINISH, [$this, 'onFinish']);
//        if (!empty(config('server.setting.task_worker_num'))) {
//        }
    }
}