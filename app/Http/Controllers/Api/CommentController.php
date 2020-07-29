<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Add/Edit a Comment
     *
     * @api {POST} HOST/api/comment/save Add/Edit a Comment
     * @apiVersion 1.0.0
     * @apiName saveComment
     * @apiDescription Add/Edit a comment
     * @apiGroup Post
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of Comment. If exists, updates the specified comment, otherwise, creates new.
     * @apiParam {Text} body Content of the comment.
     * @apiParam {Number} post_id ID of the post.
     *
     * @apiSuccess {Number} id Comment ID
     * @apiSuccess {Text} body content of the comment
     * @apiSuccess {Date} created_at
     * @apiSuccess {Date} updated_at
     * @apiSuccess {Array} added_by owner of the comment
     * @apiSuccess {Number} added_by.id id of the owner
     * @apiSuccess {String} added_by.first_name first name of the owner
     * @apiSuccess {String} added_by.last_name last name of the owner
     * @apiSuccess {String} added_by.profile_picture avatar of the owner
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 51,
            "body": "This is a sample comment from Postman. Edited here.",
            "created_at": "2020-07-13 21:04:57",
            "updated_at": "2020-07-13 21:10:37",
            "added_by": {
                "id": 7,
                "first_name": "davy",
                "last_name": "castillo",
                "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
            }
        }
     * 
     */
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'integer',
            'body'=>'required',
            'post_id'=>'required|exists:posts,id'
        ]);

        $user =  Auth::user();

        // to update or to create
        $comment = Comment::findOrNew($request->id);
        $comment->created_by = $comment->created_by ?: $user->id;
        $comment->updated_by = $user->id;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->save();

        $comment = Comment::find($comment->id);
    
        $fractal = fractal()->item($comment, new CommentTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Get details of a Comment
     *
     * @api {GET} HOST/api/comment/:id Get details of a Comment
     * @apiVersion 1.0.0
     * @apiName getComment
     * @apiDescription Get detail of a comment
     * @apiGroup Post
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of Comment
     *
     * @apiSuccess {Number} id Comment ID
     * @apiSuccess {Text} body content of the comment
     * @apiSuccess {Date} created_at
     * @apiSuccess {Date} updated_at
     * @apiSuccess {Array} added_by owner of the post
     * @apiSuccess {Number} added_by.id id of the owner
     * @apiSuccess {String} added_by.first_name first name of the owner
     * @apiSuccess {String} added_by.last_name last name of the owner
     * @apiSuccess {String} added_by.profile_picture avatar of the owner
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 51,
            "body": "This is a sample comment from Postman. Edited here.",
            "created_at": "2020-07-13 21:04:57",
            "updated_at": "2020-07-13 21:10:37",
            "added_by": {
                "id": 7,
                "first_name": "davy",
                "last_name": "castillo",
                "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
            }
        }
     * 
     */
    public function show(Request $request)
    {
        $response = null;
        $comment = Comment::whereId($request->id)->first();

        if($comment) {
            $fractal = fractal()->item($comment, new CommentTransformer);
            $response = $fractal->toArray();
        }
        
       return response()->json($response);
    }

    /**
     * Remove Comment
     *
     * @api {Delete} HOST/api/comment/remove/:id Remove Comment
     * @apiVersion 1.0.0
     * @apiName RemoveComment
     * @apiDescription Remove Comment. IMPORTANT! Only the teacher or owner of the comment can do this action.
     * @apiGroup Post
     *
     * @apiParam {Number} id Comment ID.
     *
     * @apiSuccess {String} success returns true if coomment has been removed. Otherwise, returns error code 403.
     *
     *
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     *
     *
     */
    public function remove(Request $request)
    {
        try {
            $user =  Auth::user();
            $comment = Comment::findOrFail($request->id);

            if(
                $comment &&
                ($user->isTeacher() || $comment->created_by == $user->id) // if teacher or is owner
            ) {
                $comment->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Unable to remove comment.'], 403);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json(['error' => 'Unable to remove comment.'], 403);
    }
}
