

## Document

[**Chinese Document**](https://doc.swoft.org)  
[**English Document**](https://doc.swoft.org) Not yet, please help us write it.

QQ Group: 548173319

## Environmental Requirements

1. PHP 7.0 +
2. [Swoole 2.1.3](https://github.com/swoole/swoole-src/releases) +, *coroutine* and *async redis client* options are required
3. [Hiredis](https://github.com/redis/hiredis/releases)
4. [Composer](https://getcomposer.org/)

## Install

### Manual Installation

* Clone project
* Install requires `composer install`

### Install by Composer

* `composer create-project swoft/swoft swoft`

### Install by Docker

* `docker run -p 80:80 swoft/swoft`

### Install by Docker-Compose

* `cd swoft`
* `docker-compose up`

## Configuration

If automatically copied `.env` file fails when `composer install` was executed, the `.env.example` that in root directory can be manually copied and named `.env`. Note that `composer update` will not trigger related copy operations.

```
# Server
PFILE=/tmp/swoft.pid
PNAME=php-swoft
TCPABLE=true
CRONABLE=false
AUTO_RELOAD=true

# HTTP
HTTP_HOST=0.0.0.0
HTTP_PORT=80

# WebSocket
WS_ENABLE_HTTP=true

# TCP
TCP_HOST=0.0.0.0
TCP_PORT=8099
TCP_PACKAGE_MAX_LENGTH=2048
TCP_OPEN_EOF_CHECK=false

# Crontab
CRONTAB_TASK_COUNT=1024
CRONTAB_TASK_QUEUE=2048

# Settings
WORKER_NUM=1
MAX_REQUEST=10000
DAEMONIZE=0
DISPATCH_MODE=2
LOG_FILE=@runtime/swoole.log
TASK_WORKER_NUM=1
```

## Management

### Help command

```text
[root@swoft]# php bin/swoft -h
 ____                __ _
/ ___|_      _____  / _| |_
\___ \ \ /\ / / _ \| |_| __|
 ___) \ V  V / (_) |  _| |_
|____/ \_/\_/ \___/|_|  \__|

Usage:
  php bin/swoft {command} [arguments ...] [options ...]

Commands:
  entity  The group command list of database entity
  gen     Generate some common application template classes
  rpc     The group command list of rpc server
  server  The group command list of http-server
  ws      There some commands for manage the webSocket server

Options:
  -v, --version  show version
  -h, --help     show help
```

### Start HTTP Server

```bash
// Start HTTP Server
php bin/swoft start

// Start Daemonize HTTP Server
php bin/swoft start -d

// Restart HTTP server
php bin/swoft restart

// Reload HTTP server
php bin/swoft reload

// Stop HTTP server
php bin/swoft stop
```

### Start WebSocket Server

Start WebSocket Server, optional whether to support HTTP processing.

```bash
// Star WebSocket Server
php bin/swoft ws:start

// Start Daemonize WebSocket Server
php bin/swoft ws:start -d

// Restart WebSocket server
php bin/swoft ws:restart

// Reload WebSocket server
php bin/swoft ws:reload

// Stop WebSocket server
php bin/swoft ws:stop
```

### Start RPC Server

Start an independent RPC Server.

```bash
// Start RPC Server
php bin/swoft rpc:start

// Start Daemonize RPC Server
php bin/swoft rpc:start -d

// Restart RPC Server
php bin/swoft rpc:restart

// Reload RPC Server
php bin/swoft rpc:reload

// Stop RPC Server
php bin/swoft rpc:stop
```

## Changelog

[Changelog](changelog.md)

## License

Swoft is an open-source software licensed under the [LICENSE](LICENSE)
