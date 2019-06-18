<?php


namespace Chat\AbstractInterface;


interface ServerInterface
{
    /**
     * 启动
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function start();

    /**
     * 停止服务
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function stop(): bool;

    /**
     * 重启
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function reload($onlyTask = false);

    /**
     * Is server running ?
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function isRunning(): bool;

    /**
     * 设置守护进程
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function setDaemonize();

    /**
     * Server启动在主进程的主线程回调此函数
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onStart(\swoole_server $server);

    /**
     * 此事件在Server正常结束时发生
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onShutdown(\swoole_server $server);

    /**
     * 当管理进程启动时调用它，函数原型
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onManagerStart(\swoole_server $server);

    /**
     * 当管理进程结束时调用它，函数原型
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onManagerStop(\swoole_server $server);

    /**
     * 此事件在Worker进程/Task进程启动时发生。这里创建的对象可以在进程生命周期内使用
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onWorkerStart(\swoole_server $server, int $worker_id);

    /**
     * 此事件在worker进程终止时发生。在此函数中可以回收worker进程申请的各类资源
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onWorkerStop(\swoole_server $server, int $worker_id);

    /**
     * 当Worker/Task进程发生异常后会在Manager进程内回调
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onWorkerError(\swoole_server $server, int $worker_id, int $worker_pid, int $exit_code, int $signal);


    /**
     * 当工作进程收到由 sendMessage 发送的管道消息时会触发onPipeMessage事件。worker/task进程都可能会触发onPipeMessage事件
     * @return mixed
     * @copyright Copyright (c)
     * @author wong ([842687571@qq.com])
     */
    public function onPipeMessage(\swoole_server $server, int $src_worker_id, $message);
}