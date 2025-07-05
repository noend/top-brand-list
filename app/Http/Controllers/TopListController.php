<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class TopListController extends Controller
{
    public function list(Request $request)
    {
       $countryCode = $request->header('CF-IPCountry') ?? 'XX';

       $country = Country::where('code', $countryCode)->first();

       $topList = $country->toplist()->with('brand')->orderBy('position')->get();

       return response()->json([
           'country' => $country->code,
           'toplist' => $topList
       ]);
    }
}
