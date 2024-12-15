<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        // Fetch all logs
        $id = 1; // Replace with an actual ID from your database
        $logs = Log::find($id);   
        echo $logs->table_name;
     
        $oldValue = json_decode($logs->old_value, true);
        $newValue = json_decode($logs->new_value, true);

        // Pass logs to the view
        return view('dashboard.admin-log.index', [
            'page' => 'Halaman LOG',
            'active' => 'admin-log',
            'logs' => $logs,
            'old_value' => $oldValue,
            'new_value' => $newValue
        ]);    }
}
