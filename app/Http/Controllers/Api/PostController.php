<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Add/Edit a Post
     *
     * @api {POST} HOST/api/post/save Add/Edit Post
     * @apiVersion 1.0.0
     * @apiName savePost
     * @apiDescription Add/Edit a post
     * @apiGroup Post
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of Post. If exists, updates the specified post, otherwise, creates new.
     * @apiParam {Text} body Content of the post.
     * @apiParam {String=class} itemable_type The type of item the post belongs to
     * @apiParam {Number} itemable_id ID of the item the post belongs to. E.g. class ID
     *
     * @apiSuccess {Number} id Post ID
     * @apiSuccess {Text} body content of the post
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
            "id": 11,
            "body": "This is a sample post from Postman. Edited here.",
            "created_at": "2020-07-13 20:29:25",
            "updated_at": "2020-07-13 20:30:20",
            "added_by": {
                "id": 7,
                "first_name": "davy",
                "last_name": "castillo"
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
            'itemable_type'=>'required|in:class',
            'itemable_id'=>'required|integer'
        ]);

        $user =  Auth::user();

        // to update or to create
        $post = Post::findOrNew($request->id);
        $post->created_by = $post->created_by ?: $user->id;
        $post->updated_by = $user->id;
        $post->body = $request->body;
        $post->itemable_type = $request->itemable_type;
        $post->itemable_id = $request->itemable_id;
        $post->save();

        $post = Post::find($post->id);
    
        $fractal = fractal()->item($post, new PostTransformer);

        return response()->json($fractal->toArray());
    }

    /**
     * Get details of a Post
     *
     * @api {GET} HOST/api/post/:id?include=comments Get details of a Post
     * @apiVersion 1.0.0
     * @apiName getPost
     * @apiDescription Get details of a post
     * @apiGroup Post
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of Post
     * @apiParam {String=comments} [include] if specified, includes the comments in response data
     *
     * @apiSuccess {Number} id Post ID
     * @apiSuccess {Text} body content of the post
     * @apiSuccess {Date} created_at
     * @apiSuccess {Date} updated_at
     * @apiSuccess {Array} added_by owner of the post
     * @apiSuccess {Number} added_by.id id of the owner
     * @apiSuccess {String} added_by.first_name first name of the owner
     * @apiSuccess {String} added_by.last_name last name of the owner
     * @apiSuccess {String} added_by.profile_picture avatar of the owner
     * @apiSuccess {Array} comments list of comments of this post
     * @apiSuccess {Number} comments.id Comment ID
     * @apiSuccess {Text} comments.body content of the comment
     * @apiSuccess {Date} comments.created_at
     * @apiSuccess {Date} comments.updated_at
     * @apiSuccess {Array} comments.added_by owner of the post
     * @apiSuccess {Number} comments.added_by.id id of the owner
     * @apiSuccess {String} comments.added_by.first_name first name of the owner
     * @apiSuccess {String} comments.added_by.last_name last name of the owner
     * @apiSuccess {String} comments.added_by.profile_picture avatar of the owner
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 8,
            "body": "I know?' said Alice, 'a great girl like you,' (she might well say this), 'to go on crying in this way! Stop this moment, I tell you!' But she waited for a few yards off. The Cat only grinned when it.",
            "created_at": "1981-10-29 00:30:58",
            "updated_at": "1981-10-29 00:30:58",
            "added_by": {
                "id": 10,
                "first_name": "teacher grace",
                "last_name": "ungui",
                "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
            },
            "comments": [
                {
                    "id": 5,
                    "body": "Dormouse, without considering at all for any lesson-books!' And so she went on, 'if you only walk long enough.' Alice felt that there was the White Rabbit; 'in fact, there's nothing written on the.",
                    "created_at": "1995-06-17 15:33:58",
                    "updated_at": "1995-06-17 15:33:58",
                    "added_by": {
                        "id": 12,
                        "first_name": "teacher davy",
                        "last_name": "castillo",
                        "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                    }
                },
                {
                    "id": 46,
                    "body": "Mock Turtle went on planning to herself 'It's the oldest rule in the middle. Alice kept her eyes anxiously fixed on it, and fortunately was just beginning to write this down on one knee as he shook.",
                    "created_at": "1983-04-30 18:26:19",
                    "updated_at": "1983-04-30 18:26:19",
                    "added_by": {
                        "id": 4,
                        "first_name": "davy",
                        "last_name": "castillo",
                        "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                    }
                }
            ]
        }
     * 
     */
    public function show(Request $request)
    {
        $response = null;
        $post = Post::find($request->id);

        if($post) {
            $fractal = fractal()->item($post, new PostTransformer);
            $response = $fractal->toArray();
        }

        return response()->json($response);
    }

    /**
     * Get detail of Post
     *
     * @api {GET} HOST/api/post/class/:id?include=comments Get posts of a class
     * @apiVersion 1.0.0
     * @apiName getPostsOfClass
     * @apiDescription Get posts of selected class
     * @apiGroup Post
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of class
     * @apiParam {String=comments} [include] if specified, includes the comments in response data
     *
     * @apiSuccess {Array} posts list of Posts
     * @apiSuccess {Number} posts.id Post ID
     * @apiSuccess {Text} posts.body content of the post
     * @apiSuccess {Date} posts.created_at
     * @apiSuccess {Date} posts.updated_at
     * @apiSuccess {Array} posts.added_by owner of the post
     * @apiSuccess {Number} posts.added_by.id id of the owner
     * @apiSuccess {String} posts.added_by.first_name first name of the owner
     * @apiSuccess {String} posts.added_by.last_name last name of the owner
     * @apiSuccess {String} posts.added_by.profile_picture avatar of the owner
     * @apiSuccess {Array} comments list of comments of this post
     * @apiSuccess {Number} comments.id Comment ID
     * @apiSuccess {Text} comments.body content of the comment
     * @apiSuccess {Date} comments.created_at
     * @apiSuccess {Date} comments.updated_at
     * @apiSuccess {Array} comments.added_by owner of the post
     * @apiSuccess {Number} comments.added_by.id id of the owner
     * @apiSuccess {String} comments.added_by.first_name first name of the owner
     * @apiSuccess {String} comments.added_by.last_name last name of the owner
     * @apiSuccess {String} comments.added_by.profile_picture avatar of the owner
     * 
     * @apiSuccessExample {json} Sample Response
        [
            {
                "id": 8,
                "body": "I know?' said Alice, 'a great girl like you,' (she might well say this), 'to go on crying in this way! Stop this moment, I tell you!' But she waited for a few yards off. The Cat only grinned when it.",
                "created_at": "1981-10-29 00:30:58",
                "updated_at": "1981-10-29 00:30:58",
                "added_by": {
                    "id": 10,
                    "first_name": "teacher grace",
                    "last_name": "ungui",
                    "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                },
                "comments": [
                    {
                        "id": 5,
                        "body": "Dormouse, without considering at all for any lesson-books!' And so she went on, 'if you only walk long enough.' Alice felt that there was the White Rabbit; 'in fact, there's nothing written on the.",
                        "created_at": "1995-06-17 15:33:58",
                        "updated_at": "1995-06-17 15:33:58",
                        "added_by": {
                            "id": 12,
                            "first_name": "teacher davy",
                            "last_name": "castillo",
                            "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                        }
                    },
                    {
                        "id": 46,
                        "body": "Mock Turtle went on planning to herself 'It's the oldest rule in the middle. Alice kept her eyes anxiously fixed on it, and fortunately was just beginning to write this down on one knee as he shook.",
                        "created_at": "1983-04-30 18:26:19",
                        "updated_at": "1983-04-30 18:26:19",
                        "added_by": {
                            "id": 4,
                            "first_name": "davy",
                            "last_name": "castillo",
                            "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                        }
                    }
                ]
            },
            {
                "id": 9,
                "body": "Alice. 'Why?' 'IT DOES THE BOOTS AND SHOES.' the Gryphon added 'Come, let's try the patience of an oyster!' 'I wish I hadn't mentioned Dinah!' she said to herself; 'his eyes are so VERY wide, but.",
                "created_at": "1989-09-23 01:49:54",
                "updated_at": "1989-09-23 01:49:54",
                "added_by": {
                    "id": 6,
                    "first_name": "dhame",
                    "last_name": "amaya",
                    "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                },
                "comments": [
                    {
                        "id": 4,
                        "body": "Rabbit's little white kid gloves and a crash of broken glass. 'What a curious feeling!' said Alice; 'living at the March Hare, who had been all the while, and fighting for the hedgehogs; and in.",
                        "created_at": "1982-08-30 21:37:17",
                        "updated_at": "1982-08-30 21:37:17",
                        "added_by": {
                            "id": 11,
                            "first_name": "teacher jen",
                            "last_name": "amaya",
                            "profile_picture": "https://iskwela.net/path/to/profile/pic.jpeg"
                        }
                    }
                ]
            }
        ]
     *
     * 
     * 
     */
    public function getPostsOfItemable(string $itemable_type, int $itemable_id)
    {
        $response = null;
        $posts = Post::where([
            'itemable_type' => $itemable_type,
            'itemable_id' => $itemable_id
        ]);

        if($posts) {
            $fractal = fractal()->collection($posts->get(), new PostTransformer);
            $response = $fractal->toArray();
        }

        return response()->json($response);
    }

    /**
     * Remove Post
     *
     * @api {Delete} HOST/api/post/remove/:id Remove Post
     * @apiVersion 1.0.0
     * @apiName RemovePost
     * @apiDescription Remove Post. IMPORTANT! Only a teacher or the owner of the post can do this action.
     * @apiGroup Post
     *
     * @apiParam {Number} id Post ID.
     *
     * @apiSuccess {String} success returns true if post has been removed. Otherwise, returns error code 403.
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
            $post = Post::findOrFail($request->id);

            if(
                $post &&
                ($user->isTeacher() || $post->created_by == $user->id) // if teacher or is owner
            ) {
                $post->delete();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => 'Unable to remove post.'], 403);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json(['error' => 'Unable to remove post.'], 403);
    }
}
