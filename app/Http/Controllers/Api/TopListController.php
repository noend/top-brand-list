<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TopList;
use App\Models\Country;
use App\Models\Brand;
use App\Http\Requests\Api\StoreTopListRequest;
use App\Http\Requests\Api\UpdateTopListRequest;
use App\Http\Resources\Api\TopListResource;
use Illuminate\Http\JsonResponse;

class TopListController extends Controller
{
    public function index()
    {
        return TopListResource::collection(
            TopList::with('brand', 'country')->paginate()
        );
    }
    public function show($countryId)
    {
        $toplist = TopList::where('country_id', $countryId)->get();

        return TopListResource::collection($toplist);
    }

    public function store(StoreTopListRequest $request, Country $country): TopListResource
    {
        $validated = $request->validated();

        $toplist = TopList::create([
            'country_id' => $country->id,
            'brand_id' => $validated['brand_id'],
            'position' => $validated['position'],
        ]);

        return new TopListResource($toplist);
    }

    public function update(UpdateTopListRequest $request, string $id): TopListResource
    {
        $validated = $request->validated();

        $toplist = TopList::where('id', $id)
            ->where('country_id', $validated['country_id'])
            ->where('brand_id', $validated['brand_id'])
            ->firstOrFail();

        $toplist->update(['position' => $validated['position']]);

        return new TopListResource($toplist);
    }

    public function destroy(Country $country, Brand $brand): JsonResponse
    {
        $toplist = TopList::where('country_id', $country->id)
            ->where('brand_id', $brand->id)
            ->firstOrFail();

        $toplist->delete();

        return response()->json(['message' => 'Brand removed from toplist']);
    }
}
