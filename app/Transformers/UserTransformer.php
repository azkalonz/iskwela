<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['classes'];
    public function transform(\App\Models\User $user)
    {
		return [
			'id' => $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'school_id' => $user->school_id,
			'user_type' => $user->user_type,
		];
	}
	
	public function includeClasses(\App\Models\User $user)
	{
		return $this->collection($user->classes, new \App\Transformers\ClassesTransformer);
	}
}