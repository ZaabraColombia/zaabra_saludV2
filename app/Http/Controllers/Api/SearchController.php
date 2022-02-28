<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CIE10;
use App\Models\Cums;
use App\Models\Cups;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function cie10(Request $request)
    {
        if (isset($request->term))
        {
            $CIE10 = CIE10::query()
                ->select('description as text','id',  'code')
                ->where('code', 'like', "%$request->term%")
                ->orWhere('description', 'like', "%$request->term%")
                ->limit(10)
                ->get();
            $CIE10 = $CIE10->toArray();
            //dd($CIE10);
        }else{
            $CIE10 = array();
        }

        return response([
            'data' => $CIE10
        ]);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function cups(Request $request)
    {
        if (isset($request->term))
        {
            $cups = Cups::query()
                //->select('description as text','id',  'code')
                ->select('description as text', 'id', 'code')
                ->where('code', 'like', "%$request->term%")
                ->orWhere('description', 'like', "%$request->term%")
                ->limit(10)
                ->get();
            $cups = $cups->toArray();
        }else{
            $cups = array();
        }

        return response([
            'data' => $cups
        ]);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function cums(Request $request)
    {
        if (isset($request->term))
        {
            $cups = Cums::query()
                //->select('description as text','id',  'code')
                ->select('id', 'active_principle as text', 'record as code')
                ->selectRaw('concat(active_principle, " | ", commercial_description, " | ", via_administration, " | ", amount, reference_unit, " | ", pharmaceutical_form) as description')
                ->where('record', 'like', "%$request->term%")
                ->orWhere('active_principle', 'like', "%$request->term%")
                ->limit(10)
                ->get();
            $cups = $cups->toArray();
        }else{
            $cups = array();
        }

        return response([
            'data' => $cups
        ]);
    }

}
