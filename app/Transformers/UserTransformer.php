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
			'user_name' => $user->username,
			'email' => $user->email,
			'phone_number' => $user->phone_number,
			'phone_number' => $user->phone_number,
			'status' => $user->status,
			'profile_picture' => $user->preference->profile_picture,
			'push_notification' => $user->preference->push_notification,
			'email_subscription' => $user->preference->email_subscription
		];
	}
	
	public function includeClasses(\App\Models\User $user)
	{
		return $this->collection($user->classes, new \App\Transformers\ClassesTransformer);
	}
}