<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Page;
use \App\Http\Controllers\Traits\HasError;
class PageController extends Controller {

    use HasError;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
        $data['page_details'] =  Page::orderBy('created_at','desc')->get();
        return $data;
    }

    public function create(Request $request) {
        $input = $request->all();
        $rules = ([
            'title' => 'required|unique:pages',
            'description' => 'required',
            'slug' => 'required'
            
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        Page::create($input);

        return [
            'status' => 'success',
            'message' => 'Page added successfully'
        ];
    }

    public function edit(Request $request) {

        return static::toUpdate($request);
    }

    public static function toUpdate(Request $request) {

        $input = $request->all();

        $faq = Page::findOrFail($request->id);
        $faq->update($input);
        return [
            'status' => 'success',
            'message' => 'Page Updated successfully'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $faq = Page::find($id);


        if ($faq->delete()) {
            return [
                'status' => 'success',
                'message' => 'Page Deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Page Deleting Failed'
            ];
        }
    }

}
