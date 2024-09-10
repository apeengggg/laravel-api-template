<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\ResponseUtil;
use App\Models\Users;
use App\Utils\StringUtil;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'min:1|string',
            'roleId' => 'min:1|string',
            'nip' => 'min:1|max:50|string',
            'email' => 'string',
            'orderBy' => 'string|required|in:user_id,role_id,nip,name,email,phone,role_name',
            'dir' => 'min:3|max:3|string|in:asc,desc|required',
            'perPage' => 'numeric|required',
        ],[
            'userId.min' => 'User Id Minimal 1 Character',
            'userId.string' => 'User Id Must Be String',
            'roleId.min' => 'Role Id Minimal 1 Character',
            'roleId.string' => 'Role Id Must Be String',
            'nip.min' => 'NIP Minimal 1 Character',
            'nip.max' => 'NIP Maximal 50 Character',
            'nip.string' => 'NIP Must Be String',
            'email.string' => 'Email Must Be String',
            'orderBy.string' => 'Order By Must Be String',
            'orderBy.in' => 'Order Is Not Valid Column',
            'orderBy.required' => 'Order is Required',
            'dir.min' => 'Dir Minimal 3 Character',
            'dir.max' => 'Dir Maximal 3 Character',
            'dir.string' => 'Dir Must Be String',
            'dir.in' => 'Dir Value Is Not Valid Value',
            'dir.required' => 'Dir is Required',
            'perPage.number' => 'PerPage Must Be Number',
            'perPage.required' => 'PerPage is Required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errorMessages = StringUtil::ErrorMessage($validator);
            return ResponseUtil::BadRequest(null, $errorMessages);
        }

        $results = Users::getUsers($request);
        return ResponseUtil::Ok(null, "Successfully Get Data", $results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
