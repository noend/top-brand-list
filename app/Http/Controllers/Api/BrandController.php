<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BrandRequest;
use App\Http\Resources\Api\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return BrandResource::collection(Brand::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request): BrandResource
    {
        $validatedData = $request->validated();
        $brand = Brand::create($validatedData);
        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand): BrandResource
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id): BrandResource
    {
        $validatedData = $request->validated();
        $brand = Brand::where('brand_id', $id)->firstOrFail();
        $brand->update($validatedData);
        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return response()->json(['message' => 'Brand deleted successfully'], 204);
    }
}
