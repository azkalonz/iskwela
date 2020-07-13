<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['comments'];

    public function transform(\App\Models\Post $post)
    {
        return [
            'id' => $post->id,
            'body' => $post->body,
            'created_at' => Carbon::parse( $post->created_at )->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse( $post->updated_at )->format('Y-m-d H:i:s'),
            'added_by' => [
                'id' => $post->user->id,
                'first_name' => $post->user->first_name,
                'last_name' => $post->user->last_name,
            ]
        ];
    }

    public function includeComments(\App\Models\Post $post)
    {
        return $this->collection($post->comments, new \App\Transformers\CommentTransformer);
    }
}