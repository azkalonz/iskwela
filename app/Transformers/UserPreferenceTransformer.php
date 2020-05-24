<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserPreferenceTransformer extends TransformerAbstract
{
    public function transform(\App\Models\UserPreference $user_preference)
    {
		return [
			'profile_picture' => $user_preference->profile_picture,
			'push_notification' => $user_preference->push_notification,
			'email_subscription' => $user_preference->email_subscription
		];
	}
}