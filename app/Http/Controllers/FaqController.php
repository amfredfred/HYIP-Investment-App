<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;

class FaqController extends Controller {

    use HasError;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
        $data['Faq_details'] =  Faq::orderBy('created_at','asc')->get();
        return $data;
    }

    public function create(Request $request) {
        $input = $request->all();
        $rules = ([
            'title' => 'required|unique:faqs',
            'description' => 'required',
            'status' => 'required'
            
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        Faq::create($input);

        return [
            'status' => 'success',
            'message' => 'Faq added successfully'
        ];
    }

    public function edit(Request $request) {

        return static::toUpdate($request);
    }

    public static function toUpdate(Request $request) {

        $input = $request->all();

        $faq = Faq::findOrFail($request->id);
        $faq->update($input);
        return [
            'status' => 'success',
            'message' => 'Faq Updated successfully'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $faq = Faq::find($id);


        if ($faq->delete()) {
            return [
                'status' => 'success',
                'message' => 'Faq Deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Faq Deleting Failed'
            ];
        }
    }

}
