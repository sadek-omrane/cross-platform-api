<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchKey = $request->query('search');
        $createdById = $request->query('created_by_id');
        $sectorId = $request->query('sector_id');

        $services = Service::query();
        if ($createdById) {
            $services->where('created_by_id', $createdById);
        } if($searchKey && strlen($searchKey) > 0) {
            $services->where('name', 'like', '%'.$searchKey.'%');
        }
        if($sectorId) {
            $services->where('sector_id', $sectorId);
        }

        $services = $services->get();

        return $this->sendResponse($services, 'Service retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'sector_id' => 'required|exists:sectors,id',
            'service_image_id' => 'nullable|exists:e_files,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $service = Service::create([
            'created_by_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sector_id' => $request->sector_id,
            'service_image_id' => $request->service_image_id,
        ]);

        return $this->sendResponse($service, 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load('sector', 'createdBy');
        return $this->sendResponse($service, 'Success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sector_id' => 'required|exists:sectors,id',
            'service_image_id' => 'nullable|exists:e_files,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sector_id' => $request->sector_id,
            'service_image_id' => $request->service_image_id,
        ]);

        return $this->sendResponse($service, 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return $this->sendResponse(null, 'Service deleted successfully.');
    }
}
