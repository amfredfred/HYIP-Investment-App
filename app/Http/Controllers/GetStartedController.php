<?php

namespace App\Http\Controllers;

use App\GetStarted;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
class GetStartedController extends Controller
{
       use HasError;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
        $data['getstart_details'] =  GetStarted::orderBy('created_at','desc')->get();
        return $data;
    }

    public function create(Request $request) {
        $input = $request->all();
        $rules = ([
            'title' => 'required|unique:get_starteds',
            'description' => 'required',
            'icon' => 'required'
            
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        GetStarted::create($input);

        return [
            'status' => 'success',
            'message' => 'GetStarted added successfully'
        ];
    }

    public function edit(Request $request) {

        return static::toUpdate($request);
    }

    public static function toUpdate(Request $request) {

        $input = $request->all();

        $faq = GetStarted::findOrFail($request->id);
        $faq->update($input);
        return [
            'status' => 'success',
            'message' => 'GetStarted Updated successfully'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $faq = GetStarted::find($id);


        if ($faq->delete()) {
            return [
                'status' => 'success',
                'message' => 'GetStarted Deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'GetStarted Deleting Failed'
            ];
        }
    }

}
