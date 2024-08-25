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
        $output = [];
          $mac='notfound';
          exec('getmac', $output);
      
          // Search for the MAC address
          foreach ($output as $line) {
            if (preg_match('/([0-9A-F]{2}[-:]){5}([0-9A-F]{2})/i', $line, $matches)) {
                $mac=$matches[0];
            }
            }
        return  $mac;
    }
}
