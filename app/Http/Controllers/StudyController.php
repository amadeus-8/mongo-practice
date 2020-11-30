<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study;

class StudyController extends Controller
{
    public function index()
    {
        return view('study.index');
    }

    public function get() {
        $study = Study::all()->toArray();

        if($study) {
            $studies = array();

            foreach($study as $row) {
                array_push($studies, [
                   'id'          => $row['id'],
                   'amt'         => $row['amt'],
                   'region'      => $row['region'],
                   'school_name' => $row['school name']
                ]);
            }

            return response()->json([
                'success' => true,
                'studies' => $studies
            ]);
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'Данные не найдены',
                'code'    => 400,
            ]);
    }

    public function test() {
        $study = Study::where('region', 'г.Алматы')->first();
    }
}
