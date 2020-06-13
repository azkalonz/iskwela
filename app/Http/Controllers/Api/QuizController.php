<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Transformers\QuizBuilderTransformer;

use \App\Gateways\QuizBuilderGateway;

class QuizController extends Controller
{
	public function save(Request $request)
	{
		$quiz_gw = new QuizBuilderGateway();

		//add and attach questions to quiz
		$quiz_gw->setQuizDetails($request->toArray());
		$quiz_gw->save();

		$fractal = fractal()->item($quiz_gw, new QuizBuilderTransformer);

        return response()->json($fractal->toArray());
	}
}
