<?php

namespace App\Http\Controllers;

use App\Benefit;
use Illuminate\Http\Request;
use \App\Http\Controllers\Traits\HasError;
class BenefitController extends Controller
{
    use HasError;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index() {
        $data['benefit_details'] =  Benefit::orderBy('created_at','desc')->get();
        return $data;
    }

    public function create(Request $request) {
        $input = $request->all();
        $rules = ([
            'title' => 'required|unique:benefits',
            'description' => 'required',
            'icon' => 'required'
            
        ]);
        $error = static::getErrorMessage($input, $rules);
        if ($error) {
            return $error;
        }
        Benefit::create($input);

        return [
            'status' => 'success',
            'message' => 'Benefit added successfully'
        ];
    }

    public function edit(Request $request) {

        return static::toUpdate($request);
    }

    public static function toUpdate(Request $request) {

        $input = $request->all();

        $faq = Benefit::findOrFail($request->id);
        $faq->update($input);
        return [
            'status' => 'success',
            'message' => 'Benefit Updated successfully'
        ];
    }

    public function delete(Request $request) {
        $id = $request->id;

        $faq = Benefit::find($id);


        if ($faq->delete()) {
            return [
                'status' => 'success',
                'message' => 'Benefit Deleted successfully'
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Benefit Deleting Failed'
            ];
        }
    }

}
