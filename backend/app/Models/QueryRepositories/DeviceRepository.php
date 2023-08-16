<?php

namespace App\Models\QueryRepositories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;

class DeviceRepository
{

    public function getAllDevices(): Collection
    {
        return Device::all();
    }

    public function getDeviceById(string $deviceId):? Device
    {
        return Device::where('id',$deviceId)->first();
    }


    public function deleteDevicebyId(string $deviceId)
    {
        $device = $this->getDeviceById($deviceId);

        if ($device) {
            $device->delete();
            return true;
        }

        return false;
    }

    public function createNewDevice(string $deviceName,string $deviceIp)
    {
         Device::create([
            'name' => $deviceName,
            'ip' => $deviceIp,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function editDevice(Device $device,string $deviceName,string $deviceIp)
    {
        $device->name = $deviceName;
        $device->ip = $deviceIp;
        $device->save();
    }

}
