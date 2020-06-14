<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\ClassMaterial;

use App\Transformers\ClassMaterialTransformer;

class ClassMaterialController extends Controller
{

    /**
     * Class Material
     *
     * @api {post} HOST/api/class/material/publish/{id} Publish class material
     * @apiVersion 1.0.0
     * @apiName publishClassMaterial
     * @apiDescription Sets class material status to publish
     * @apiGroup Class Materials
     *
     * @apiUse JWTHeader
     * 
     * @apiParam {Number} id the class material ID
     *
     * @apiSuccess {String} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     */


    public function publish(Request $request)
    {
        return $this->setPublishStatus($request->id, 1);
    }

    /**
     * Class Material
     *
     * @api {post} HOST/api/class/material/unpublish/{id} Unpublish class material
     * @apiVersion 1.0.0
     * @apiName unpublishClassMaterial
     * @apiDescription Sets class material status to unpublish
     * @apiGroup Class Materials
     *
     * @apiUse JWTHeader
     * 
     * @apiParam {Number} id the class material ID
     *
     * @apiSuccess {String} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
    */
    public function unpublish(Request $request)
    {
        return $this->setPublishStatus($request->id, 0);
    }

    private function setPublishStatus($material_id, $status)
    {
        $teacher = Auth::user();
        $class_material = ClassMaterial::find($material_id);
        
        if(!$class_material->first()) {
            return response('Unable to publish file', 500);
        }
        
        if($class_material->created_by != $teacher->id) {
            return response('Unauthorized.', 401);
        }

        $class_material->published = $status;
        if($class_material->save())
        {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Class Material - Mark Done
     *
     * @api {POST} HOST/api/class/class-material/mark-done/{id} Class Material Mark Done
     * @apiVersion 1.0.0
     * @apiName ClassMaterialMarkDone
     * @apiDescription Marks Class Material as Done
     * @apiGroup Class Materials
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of class material
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */
    public function markDone(Request $request)
    {
        return $this->setDoneStatus($request->id, 1);   
    }

    /**
     * Class Material - Mark Not Done
     *
     * @api {POST} HOST/api/class/class-material/mark-not-done/{id} Class Material Mark Not Done
     * @apiVersion 1.0.0
     * @apiName ClassMaterialMarkNotDone
     * @apiDescription Marks Class Material as Not Done
     * @apiGroup Class Materials
     *
     * @apiUse JWTHeader
     *
     * @apiParam {Number} id ID of class material
     *
     * @apiSuccess {Boolean} success true/false
     * @apiSuccessExample {json} Sample Response
        {
            "success": true
        }
     *
     * 
     * 
     */
    public function markNotDone(Request $request)
    {
        return $this->setDoneStatus($request->id, 0);   
    }

    private function setDoneStatus($material_id, $status)
    {
        $teacher = Auth::user();
        $class_material = ClassMaterial::find($material_id);
        
        if(!$class_material->first()) {
            return response('Class material not found.', 404);
        }
        
        if($class_material->created_by != $teacher->id) {
            return response('Unauthorized.', 401);
        }

        $class_material->done = $status;
        if($class_material->save())
        {
            return response()->json(['success' => true]);
        }
    }


/**
     * Save Class Material
     *
     * @api {post} HOST/api/class/material/save Save Class Material
     * @apiVersion 1.0.0
     * @apiName SaveClassMaterial
     * @apiDescription Saves a Class Material
     * @apiGroup ClassMaterial
     *
     * @apiParam {Number} id ID of Class Material. if exists, updates the specified class Material ID, otherwise, creates new.
     * @apiParam {Number} class_id Class ID
     * @apiParam {Number} schedule_id Schedule ID
     * @apiParam {String} url Link to class material
     * @apiParam {String} title Title of the Class Material
     * 
     * @apiSuccess {Number} id Class Material ID
     * @apiSuccess {String} title Class Material Title
     * @apiSuccess {String} uploaded_file file uploaded if exits.
     * @apiSuccess {String} resource_link link to class material
     * @apiSuccess {Object} added_by
     * @apiSuccess {Number} added_by.id teacher ID who added the class material
     * @apiSuccess {String} added_by.first_name first name of the teacher
     * @apiSuccess {String} added_by.last_name last name of the teacher  
     * 
     * @apiSuccessExample {json} Sample Response
        {
            "id": 16,
            "title": "Sample Title2",
            "uploaded_file": "",
            "resource_link": "sample-class-material-link2.com",
            "added_by": {
                "id": 8,
                "first_name": "teacher tom",
                "last_name": "cruz"
            }
        }
     *
     * 
     * 
     */
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'integer',
            'url' => 'string',
            'schedule_id' => 'integer|required',
            'class_id' => 'integer|required',
            'schedule_id' => 'integer|required',
			'title' => 'required'
        ]);

        $user =  Auth::user();

		$class_material = ClassMaterial::findOrNew($request->id);

        $class_material->title = $request->title;
		$class_material->link_url = $request->url;
		$class_material->schedule_id = $request->schedule_id;
        $class_material->class_id = $request->class_id;
        $class_material->created_by = $user->id;
		$class_material->save();
        
        $class_material = ClassMaterial::find($class_material->id);

        $fractal = fractal()->item($class_material, new ClassMaterialTransformer);

        return response()->json($fractal->toArray());
    }
    /**
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
    
}
