<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\ArraySerializer;

use App\Models\ClassMaterial;

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
     * @apiDefine JWTHeader
     * @apiHeader {String} Authorization A JWT Token, e.g. "Bearer {token}"
     */
    
}
