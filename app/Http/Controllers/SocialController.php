<?php

namespace App\Http\Controllers;

use App\social;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;

class SocialController extends Controller {

    use HasError;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['social_details'] = social::orderBy('created_at', 'desc')->get();
        return $data;
    }

    public function create(Request $request) {
        $input = $request->all();
        $rules = ([
            'name' => 'required|unique:socials',
            'link' => 'required|url',
            'icon' => 'required',
            'status' => 'required'
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        social::create($input);

        return [
            'status' => 'success',
            'message' => 'social added successfully'
        ];
    }

    public function edit(Request $request) {

        return static::toUpdate($request);
    }

    public static function toUpdate(Request $request) {

        $input = $request->all();

        $faq = social::findOrFail($request->id);
        $faq->update($input);
        return [
            'status' => 'success',
            'message' => 'social Updated successfully'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $faq = social::find($id);


        if ($faq->delete()) {
            return [
                'status' => 'success',
                'message' => 'social Deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'social Deleting Failed'
            ];
        }
    }

}
