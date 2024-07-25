<?php

namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;

use App\Models\Log;
class logService
{
    public function logAction($userId, $employeeId, $action, $macAddress)
    {
        Log::create([
            'action' => $action,
            'id_nin' => $employeeId,
            'id' => $userId,
            'adresse_mac' => $macAddress,
            'date_action' => now(),
        ]);
    }


   
    public function getMacAddress()
    {
        return exec('getmac');
    }
}
