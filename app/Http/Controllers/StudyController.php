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

    public function get()
    {
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

    public function delete(Request $request)
    {
        $study = Study::where('id', (int)$request->id)->delete();

        if($study) {
            return response()->json([
                'success' => true,
                'message' => 'Запись успешно удалена',
                'code'    => 200,
            ]);
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'Данные не найдены',
                'code'    => 400,
            ]);
    }

    public function update(Request $request)
    {
        $study = Study::where('id', (int)$request->id)->update([
            'amt' => $request->amt,
            'school name' => $request->school_name,
            'region' => $request->region,
        ]);

        if($study) {
            return response()->json([
                'success' => true,
                'message' => 'Запись успешно обновлена',
                'code'    => 200,
            ]);
        }
        else
            return response()->json([
                'success' => false,
                'message' => 'Данные не найдены',
                'code'    => 400,
            ]);
    }

    public function create(Request $request)
    {

    }

    public function search(Request $request)
    {
        $first_char = mb_substr($request->name, 0, 1, 'utf8');
        $then = mb_substr($request->name, 1, null, 'utf8');
        $name = 'г.' . mb_strtoupper($first_char, 'utf8') . $then;

        $study = Study::where('region', $name)->get()->toArray();

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
}
