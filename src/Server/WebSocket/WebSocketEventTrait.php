<?php


namespace Chat\Server\WebSocket;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

trait WebSocketEventTrait
{
    /**
     * @author  Wong <[842687571@qq.com]>
     * @param Request $request
     * @param Response $response
     * @return bool
     * @created on 2018/12/10 5:36 PM
     * @copyright Copyright (c)
     */
    public function onHandShake(Request $request, Response $response): bool
    {
        $fd = $request->fd;
        $secWSKey = $request->header['sec-websocket-key'];

        //sec-websocket-key 错误
        if (!WebSocket::isInvalidSecWSKey($secWSKey)) {
            $this->log("Handshake: shake hands failed with the #$fd. 'sec-websocket-key' is error!");

            return false;
        }

        $headers = WebSocket::handshakeHeaders($secWSKey); //加密

        // WebSocket connection to 'ws://127.0.0.1:9502/'
        // failed: Error during WebSocket handshake:
        // Response must not include 'Sec-WebSocket-Protocol' header if not present in request: websocket
        if (isset($request->header['sec-websocket-protocol'])) {
            $headers['Sec-WebSocket-Protocol'] = $request->header['sec-websocket-protocol'];
        }

        foreach ($headers as $key => $val) {
            $response->header($key, $val);
        }

        $response->status(101);
        $response->end();
        $this->swooleServer->defer(function () use ($request, $fd) {
            $this->onWsOpen($this->swooleServer, $request, $fd);

        });
        return true;
    }

    /**
     * 当WebSocket客户端与服务器建立连接并完成握手后会回调此函数。
     * @author  Wong <[842687571@qq.com]>
     * @created on 2018/12/10 5:43 PM
     * @copyright Copyright (c)
     */
    public function onWsOpen(Server $server, Request $req, int $fd)
    {
        print_r($fd);
    }

    /**
     * 接收客户端消息
     * @author  Wong <[842687571@qq.com]>
     * @param Server $server
     * @param Frame $frame
     * @created on 2018/12/10 5:21 PM
     * @copyright Copyright (c)
     */
    public function onMessage(Server $server, Frame $frame)
    {
        print_r($frame->data);
    }

    /**
     * close 事件触发时，已经不能给客户端发消息了
     * @author  Wong <[842687571@qq.com]>
     * @param Server $server
     * @param int $fd
     * @created on 2018/12/10 5:21 PM
     * @copyright Copyright (c)
     */
    public function onClose(Server $server, int $fd)
    {

    }
}