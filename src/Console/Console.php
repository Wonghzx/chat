<?php
/**
 * Created by PhpStorm.
 * User: wong
 * Date: 2018/12/4
 * Time: 4:02 PM
 */

namespace Chat\Console;


use Chat\Component\TigerBalm;
use Chat\Console\Input\Input;
use Chat\Console\Style\Style;
use Chat\Server\Server;

class Console
{
    use TigerBalm;

    private static $version = '1.0.0';

    const DEFAULT_CMD = [
        'start', //启动
        'stop',  //停止
        'reload', //重载服务
        'update', //升级系统
        'help', //帮助
    ];

    /**
     * 参数输入
     * @var Input
     */
    private $input = [];

    /**
     * @var $monitor
     */
    private $monitor = [];

    /**
     * 每个命令唯一ID
     * @var ID
     */
    private static $pid;

    public function run()
    {
        try {
            if (phpversion() < 7)
                die('您的PHP版本低于 7  ，该框架需要PHP版本7.0.0 或 > 7.0.0^');

            //命令解析
            $cmd = Input::getInstance()->getCommand();
            $this->input = explode(':', $cmd);
            if (!in_array($this->input[0], self::DEFAULT_CMD)) {
                switch ($this->input[0]) {
                    case 'start':
                        $cmd = $this->input[1];
                        break;
                    default:
                        {
                            $errorCommand = [
                                '               <warning>Warning: Information Panel</warning>     ',
                                '******************************************************************',
                                '<red>-bash:  ' . $this->input[0] . ':  command not found</red>',
                                '<yellow>Usage:</yellow>',
                                '<faintly>   php apiswoole help</faintly>',
                                '<yellow>Commands:</yellow>',
                                '<faintly>   You can input tcp:start to Start the Swoole_server</faintly>',
                                '<faintly>   You can input http:start to Start the HttpServer can start with direct start</faintly>',
                                '<faintly>   You can input socket:start to Start the WebSocket</faintly>',
                                '******************************************************************',
                            ];
                            $this->writeln(implode("\n", $errorCommand), true, true);
                        }
                }
            }
            $this->commandHandler($cmd);
            $this->opCacheClear();
        } catch (\Throwable $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * runCommand  [运行命令]
     * @param string $cmd
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    private function commandHandler(string $cmd)
    {
        $sev = Server::getInstance();
        $sev->setting = ['worker_num'        => function_exists('\swoole_cpu_num') ? \swoole_cpu_num() * 2 : 8,
            'max_request'       => 5000,
            'enable_http'       => 1,
            'daemonize'         => 0,
            'dispatch_mode'     => 2,
            'log_file'          => ROOT .'/runtime/swoole.log',
            'pid_file'          => ROOT .'/runtime/swoole.pid',
            'task_max_request'  => 10,
            'task_worker_num'   => function_exists('\swoole_cpu_num') ? \swoole_cpu_num() * 2 : 8,
            'package_max_length'    => 4 * 1024 * 1024,
            'open_http2_protocol'    => false,];
        // 默认命令处理
        switch ($cmd) {
            case 'start': //启动
                $sev->start();
                break;
            case 'stop': //停止
                $sev->stop();
                break;
            case 'reload': //重载服务
//                $this->_this::getInstance()->reload();
                break;
            case 'update': //升级系统
                break;
            case 'version': //版本号
                echo "";
                break;
            case  'help': //帮助
            default:
                {
                    $this->help();
                }
        }
    }

    /**
     *[writeln void]
     * @param string $messages 信息
     * @param bool $newline 是否换行
     * @param bool $quit 是否退出
     * @return    [type]        [description]
     * @copyright Copyright (c)
     * @author  Wongzx <[842687571@qq.com]>
     */
    public function writeln($messages = '', $newline = true, $quit = false)
    {
        // 文字里面颜色标签翻译
        Style::init();
        $messages = Style::t($messages);
        // 输出文字
        echo $messages;
        if ($newline) {
            echo "\n";
        }
        // 是否退出
        if ($quit) {
            exit();
        }
    }

    /**
     * help  [description]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    private function help()
    {
        $helpString = <<<HELPSTRING
<info> start</info>          启动服务
<info> stop</info>           停止服务
<info> update</info>         升级系统
<info> reload</info>         重装服务
HELPSTRING;
        $this->writeln($helpString);
    }

    /**
     * opCacheClear  [清除APC缓存]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    private function opCacheClear()
    {
        if (function_exists('apc_clear_cache')) {
            apc_clear_cache();
        }
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
    }
}