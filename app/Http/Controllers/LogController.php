<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('log_time', 'desc')->paginate(10);   

     

        // Pass logs to the view
        return view('dashboard.admin-log.index', [
            'page' => 'Halaman LOG',
            'active' => 'admin-log',
            'logs' => $logs,
            // 'old_value' => $oldValue,
            // 'new_value' => $newValue
        ]);    }
}
