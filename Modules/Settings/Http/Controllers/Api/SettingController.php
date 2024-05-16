<?php

namespace Modules\Settings\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Setting;
use Modules\Settings\Transformers\ContactSettingResource;
use Modules\Settings\Transformers\SettingResource;
use Modules\Support\Traits\ApiTrait;

class SettingController extends Controller
{
    use ApiTrait;

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = new SettingResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }

//    /**
//     * Display a listing of the resource.
//     * @return JsonResponse
//     */
//    public function privacy(): JsonResponse
//    {
//        $privacy = Page::find(Setting::get('privacy_policy'));
//        if ($privacy) {
//            $data = new PageResource($privacy);
//            return $this->sendResponse($data, 'success');
//        }
//        return $this->sendError('Sorry not found');
//    }
//
//    /**
//     * Display a listing of the resource.
//     * @return JsonResponse
//     */
//    public function terms(): JsonResponse
//    {
//        $terms = Page::find(Setting::get('terms'));
//        if ($terms) {
//            $data = new PageResource($terms);
//            return $this->sendResponse($data, 'success');
//        }
//        return $this->sendError('Sorry not found');
//    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function contacts(): JsonResponse
    {
        $data = new ContactSettingResource(Setting::class);
        return $this->sendResponse($data, 'success');
    }
}
