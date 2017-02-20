<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Input;
use SplFileObject;
use App\Models\User;
use App\Models\Action;
use Request;
use App\Models\UserHistory;
class SystemController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 系统编辑
     */


    public function loginHistory()
    {
        // todo 搜索功能
        $keyword = Input::get('keyword');

        $history = UserHistory::orderBy('id', 'desc')->paginate(20);

        return view('system.login-history', [
            'keyword' => $keyword,
            'history' => $history
        ]);
    }

    public function action()
    {
        $action = Action::orderBy('id', 'desc')->paginate(10);
        return view('system.action')->withAction($action)->withKeyword('');
    }

    public function logs()
    {
        $logPath = storage_path('logs');

        // 全部 当前目录
        $path = Input::get('path');
        $allPaths = File::directories($logPath);
        array_unshift($allPaths, $logPath.'/.');
        $curPath = in_array($logPath.'/'.$path, $allPaths) ? $logPath.'/'.$path : $logPath;

        // 全部 当前日志文件
        $log = Input::get('log');
        $allLogs = File::Files($curPath);
        $curLog = in_array($curPath.'/'.$log, $allLogs) ? $curPath.'/'.$log : end($allLogs);

        // 最后500行 不支持 windows
        $file_lines = exec("wc -l  ".$curLog."|awk '{print $1}'");
        $start_line = $file_lines < 500 ? 1 : $file_lines - 500;

        $spl = new SplFileObject($curLog);
        $spl->seek($start_line-1);

        $logs = array();
        for ($i = $start_line; $i <= $file_lines; $i++) {
            $logs[$i] = $spl->current();
            $spl->next();
        }

        krsort($logs);
        krsort($allLogs);

        return view('system.logs', array(
            'allPaths' => $allPaths,
            'path' => $path,
            'log' => $log ? $log : basename($curLog),
            'logs'  => $logs,
            'allLogs' => $allLogs,
            'breadcrumb' => array(
                '系统日志' => '',
            ),
        ));
    }
}
