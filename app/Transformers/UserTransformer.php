<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['classes', 'preferences'];
    public function transform(\App\Models\User $user)
    {
		return [
			'id' => $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'school_id' => $user->school_id,
			'user_type' => $user->user_type,
			'user_name' => $user->username,
			'email' => $user->email,
			'phone_number' => $user->phone_number,
			'phone_number' => $user->phone_number,
			'status' => $user->status
		];
	}
	
	public function includeClasses(\App\Models\User $user)
	{
		return $this->collection($user->classes, new \App\Transformers\ClassesTransformer);
	}
	
	public function includePreferences(\App\Models\User $user)
	{
		return $this->collection($user->preference, new \App\Transformers\UserPreferenceTransformer);
	}
}