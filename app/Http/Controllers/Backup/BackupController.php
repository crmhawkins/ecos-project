<?php

namespace App\Http\Controllers\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index()
    {
        return view('crm.backup.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'frequency' => 'required|in:daily,weekly,monthly',
        ]);

        $labels = ['daily' => 'Diario', 'weekly' => 'Semanal', 'monthly' => 'Mensual'];
        return redirect()->back()->with('success', 'Frecuencia de backup configurada: ' . $labels[$request->frequency]);
    }

    public function download()
    {
        $host     = config('database.connections.mysql.host');
        $port     = config('database.connections.mysql.port', 3306);
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

        $command = sprintf(
            'mysqldump --host=%s --port=%s --user=%s --password=%s %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database)
        );

        return response()->stream(function () use ($command) {
            passthru($command);
        }, 200, [
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
