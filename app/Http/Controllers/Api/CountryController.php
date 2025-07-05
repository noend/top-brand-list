<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateTopListRequest;
use App\Http\Resources\Api\TopListResource;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function getTopList(Country $country)
    {
        return TopListResource::fromCountryTopList($country->topList);
    }

    public function updateTopList(UpdateTopListRequest $request, Country $country): JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['list'])) {
            $country->topList()->delete();

            return response()->json([
                'message' => 'Toplist cleared for the country.'
            ]);
        }

        $country->topList()->delete();

        $country->topList()->createMany($validated['list']);

        return response()->json([
             $country->topList
        ]);

    }

    public function destroyTopList(Country $country): JsonResponse
    {
        $country->topList()->delete();

        return response()->json([
            'message' => 'Toplist deleted for the country.'
        ]);
    }
}
