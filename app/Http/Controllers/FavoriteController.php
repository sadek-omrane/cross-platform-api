<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $searchKey = $request->query('search');
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('service')
            ->when($searchKey, function ($query) use ($searchKey) {
                $query->whereHas('service', function ($q) use ($searchKey) {
                    $q->where('name', 'like', '%' . $searchKey . '%');
                });
            })
            ->get();
        $favorites = $favorites->map(function ($favorite) {
            return $favorite->service;
        });
        
        return $this->sendResponse($favorites, 'Sector retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }
        // add user_id to request
        $request->merge(['user_id' => Auth::id()]);

        $favorite = Favorite::create($request->all());

        return $this->sendResponse($favorite, 'Sector created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        Favorite::where('service_id', $service->id)
            ->where('user_id', Auth::id())
            ->delete();
        return $this->sendResponse(null, 'Sector deleted successfully.');
    }
}
