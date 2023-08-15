<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\QueryRepositories\DeviceRepository;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function __construct(private DeviceRepository $deviceRepository)
    {
    }

    function getAllDevices(): Collection
    {
        return $this->deviceRepository->getAllDevices();
    }

    function deleteDeviceById(Request $request):Response
    {
        if( $this->deviceRepository->deleteDevicebyId($request->deviceId)){
            return response(['message' => ["Device deletion is successful!"]], Response::HTTP_OK);
        };
        return response(['message' => ["Device don't exist!"]], Response::HTTP_FAILED_DEPENDENCY);
    }

    function createNewDevice(Request $request):Response
    {
        if($this->isDeviceNameValid($request->deviceName)){
            if($this->isDeviceIpValid($request->deviceIp)){
                $this->deviceRepository->createNewDevice(trim($request->name),$request->ip);
                return response(['message' => ["Device created  successfully!"]], Response::HTTP_OK);
            }
            return response(['message' => ["Invalid ip"]], Response::HTTP_FAILED_DEPENDENCY);
        }
        return response(['message' => ["Invalid name"]], Response::HTTP_FAILED_DEPENDENCY);
    }

    function editDeviceById(Request $request):Response
    {
        $deviceToBeChange = $this->deviceRepository->getDeviceById($request->deviceId);
        if($deviceToBeChange){
            if($this->isDeviceNameValid($request->deviceName) &&  $this->isDeviceIpValid($request->deviceIp)){
                if(!$this->isSameDeviceValues($deviceToBeChange,$request->deviceName,$request->deviceIp)){
                    $this->deviceRepository->editDevice($deviceToBeChange,trim($request->deviceName),$request->deviceIp);
                    return response(['message' => ["Device updated  successfully!"]], Response::HTTP_OK);
                }
                return response(['message' => ["Device is the same!"]], Response::HTTP_OK);
            }
            return response(['message' => ["Invalid value!"]], Response::HTTP_FAILED_DEPENDENCY);
        }
        return response(['message' => ["Device don't exist!"]], Response::HTTP_OK);
    }

    private function isDeviceNameValid($name):bool{
        if(is_string($name)){
            if(trim($name) != ''){
                return true;
            }
        }
        return false;
    }

    private function isDeviceIpValid($ip):bool{
        if(is_string($ip)){
            $validator = Validator::make(['ip' => $ip], [
                'ip' => 'ipv4',
            ]);
            return !$validator->fails();
        }
        return false;
    }

    private function isEditAttemptValid($ip,$name,):bool{
        if($this->isDeviceNameValid($name) &&  $this->isDeviceIpValid($ip)){
        }
        return false;
    }

    private function isSameDeviceValues(Device $device,string $name,string $ip):bool{
        if($device->name === $name && $device->ip === $ip){
            return true;
        };
        return false;
    }

}
