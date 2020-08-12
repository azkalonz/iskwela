<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transformers\YearTransformer;
use Auth;
use App\Models\Year;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

class YearController extends Controller
{
	
    public function show(Request $request)
    {
        $year = Year::all();
        $fractal = fractal()->collection($year, new YearTransformer);
        return response()->json($fractal->toArray());

    }

    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
