<?php
return [
    'setting' => [
        'worker_num'        => getenv('WORKER_NUM', function_exists('\swoole_cpu_num') ? \swoole_cpu_num() * 2 : 8),
        'max_request'       => getenv('MAX_REQUEST', 5000),
        'daemonize'         => getenv('DAEMONIZE', 0),
        'dispatch_mode'     => getenv('DISPATCH_MODE', 2),
        'log_file'          => getenv('LOG_FILE', ROOT .'/runtime/swoole.log'),
        'pid_file'          => getenv('PFILE', ROOT .'/runtime/swoole.pid'),
        'task_max_request'  => getenv('TASK_MAX_REQUEST', 10),
        'task_worker_num'   => getenv('TASK_WORKER_NUM', function_exists('\swoole_cpu_num') ? \swoole_cpu_num() * 2 : 8),
        'package_max_length'    => getenv('TCP_PACKAGE_MAX_LENGTH', 4 * 1024 * 1024),
        'open_http2_protocol'    => false,
//        'upload_tmp_dir'    => env('UPLOAD_TMP_DIR', '/Runtime/UploadFiles'),
//        'server_name'    => env('SERVER_NAME', 'http://apiswoole.com/'),
    ]
];