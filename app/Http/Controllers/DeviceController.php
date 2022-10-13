<?php

namespace App\Http\Controllers;

use App\Http\Requests\Device\CreateDeviceRequest;
use App\Http\Requests\Device\UpdateDeviceRequest;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{

    public function index()
    {
        $devices = Device::get();
        $title = 'Data Device';

        return view('device.index', compact('title', 'devices'));
    }

    public function create()
    {
        $device = new Device();
        $title = 'Tambah Device';
        $action = route('device.store');
        $method = 'POST';

        return view('device.form', compact('device', 'title', 'action', 'method'));
    }

    public function store(CreateDeviceRequest $createDeviceRequest)
    {
        try {
            DB::beginTransaction();

            Device::create($createDeviceRequest->all());

            DB::commit();

            return redirect()->route('device.index')->with('success', 'Device berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Device $device)
    {
        if (request('mode') == 'SCAN') {
            $device->update(['mode' => 'ADD']);
        } else {
            $device->update(['mode' => 'SCAN']);
        }

        return response()->json([
            'status' => 'success',
            'message' => back()->with('success', 'Mode berhasil diubah')
        ]);
    }

    public function edit(Device $device)
    {
        $title = 'Edit Device';
        $action = route('device.update', $device->id);
        $method = 'PUT';

        return view('device.form', compact('device', 'title', 'action', 'method'));
    }

    public function update(UpdateDeviceRequest $updateDeviceRequest, Device $device)
    {
        try {
            DB::beginTransaction();

            $device->update($updateDeviceRequest->all());

            DB::commit();

            return redirect()->route('device.index')->with('success', 'Device berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Device $device)
    {
        try {
            DB::beginTransaction();

            foreach ($device->histories as $history) {
                $history->delete();
            }

            $device->delete();

            DB::commit();

            return redirect()->route('device.index')->with('success', 'Device berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
