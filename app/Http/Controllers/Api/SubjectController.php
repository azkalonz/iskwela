<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use \App\Models\Subject;
use \App\Transformers\SubjectTransformer;

class SubjectController extends Controller
{

    public function show(Request $request)
    {
		$this->validate($request, [
            'id' => 'integer'
        ]);

		if($request->id)
		{
            $subject = Subject::whereId($request->id)->get();
        }else
        {
            $subject = Subject::all();
        }

        $fractal = fractal()->collection($subject, new SubjectTransformer);
        return response()->json($fractal->toArray());
    }


    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
}
