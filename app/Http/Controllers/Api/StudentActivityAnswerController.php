<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transformers\StudentActivityGatewayTransformer;

use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Gateways\StudentActivityGateway;
use App\Models\StudentActivity;

class StudentActivityAnswerController extends Controller
{
	const QUIZ = 1;
	const PERIODICAL = 2;
	const ASSIGNMENT = 3;

	public function submitQuizAnswer(Request $request)
	{

		return $this->submitAnswer($request, self::QUIZ, 'Quiz');
		
	}

	public function submitAnswer(Request $request, int $activity_type, string $activity_name = 'Activity')
	{
		$activity = StudentActivity::whereId($request->activity_id)->whereActivityType($activity_type)->first();
		if(!$activity) {
			return response("$activity_name not found", 404);
		}

		$sac_gw = new StudentActivityGateway();
		$sac_gw->setActivityAnswers($request);
		$sac_gw->save();

		$fractal = fractal()->item($sac_gw, new StudentActivityGatewayTransformer);

        return response()->json($fractal->toArray());
	}

}
