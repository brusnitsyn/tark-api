<?php

namespace App\Http\Controllers\API\v1;

use App\Data\OrgData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Org\OrgStoreRequest;
use App\Http\Resources\Org\OrgResource;
use App\Models\Org;
use App\Models\User;
use App\Services\OrgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgs = Org::with(['creator', 'users'])->get();
        return OrgResource::collection($orgs);
    }

    // public function my($id)
    // {
    //     $orgs = Org::with(['users'])->get();
    //     foreach ($orgs as $org) {
    //         foreach ($org->users as $user) {
    //             if ($user->id == $id) return $org;
    //         }
    //     }

    //     return OrgResource::make($org);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Org\OrgStoreRequest  $request
     * @param  \App\Services\OrgService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(OrgStoreRequest $request, OrgService $service)
    {
        $data = OrgData::fromRequest($request);

        $org = $service->store($data);

        return new OrgResource($org);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Org  $org
     * @return \Illuminate\Http\Response
     */
    public function show(Org $org)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Org  $org
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Org $org)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Org  $org
     * @return \Illuminate\Http\Response
     */
    public function destroy(org $org)
    {
        //
    }
}
