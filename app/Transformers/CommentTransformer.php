<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\UserPreference;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['replies'];

    public function transform(\App\Models\Comment $comment)
    {
        if(!$comment->user->preference) {
			$comment->user->preference = new UserPreference();
        }

        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'created_at' => Carbon::parse( $comment->created_at )->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse( $comment->updated_at )->format('Y-m-d H:i:s'),
            'added_by' => [
                'id' => $comment->user->id,
                'first_name' => $comment->user->first_name,
                'last_name' => $comment->user->last_name,
                'profile_picture' => $comment->user->preference->profile_picture
            ]
        ];
    }

    public function includeReplies(\App\Models\Comment $comment)
    {
        return $this->collection($comment->replies, new \App\Transformers\CommentTransformer);
    }
}