<?php

namespace App\Http\Controllers\Apps\Service;

use App\Http\Controllers\Controller;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\GetServiceService;
use App\Services\Service\StoreServiceService;
use App\Services\Service\UpdateServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(GetServiceService $getServiceService)
    {
        $result = $getServiceService->execute();

        return view('admin.service.index', [
            'services' => $result->data
        ]);
    }

    public function get(
        Request $request,
        GetServiceService $getServiceService
    ) {
        $result = $getServiceService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function create() {
        return view('admin.service.create', [
            'edit_mode' => false
        ]);
    }

    public function store(
        Request $request,
        StoreServiceService $storeServiceService
    ) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $image = null;
        if($request->has('image')) {
            $image = Storage::disk('uploads')->put('service', $request->image);
        }

        $storeServiceService->execute([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.service.index');
    }

    public function edit(
        GetServiceService $getServiceService,
        $serviceId
    ) {
        $service = $getServiceService->execute([
            'service_id' => $serviceId
        ])->data;

        return view('admin.service.create', [
            'edit_mode' => true,
            'service' => $service
        ]);
    }

    public function update(
        Request $request,
        UpdateServiceService $updateServiceService
    ) {
        $image = null;
        if($request->has('image')) {
            $image = Storage::disk('uploads')->put('service', $request->image);
        }

        $updateServiceService->execute([
            'service_id' => $request->service_id,
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.service.index');
    }

    public function delete(
        Request $request,
        DeleteServiceService $deleteServiceService
    ) {
        $result = $deleteServiceService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }
}
