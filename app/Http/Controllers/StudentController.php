<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Menampilkan list student 
     * @param Request $request request dari frontend
     * 
     * @return json 
     */
    public function index(Request $request) {
        $paginate = $request->get('perpage', 15);
        $search = $request->get('search');
        $models = Student::orderBy('name');
        if ($search) {
            $models = $models->where(function ($query) use ($search) {
                $query->where(DB::raw('LOWER(name)'), 'LIKE', "%$search%")
                      ->orWhere('nim', 'LIKE', "%$search%");
            });
        }

        $models = $models->paginate($paginate);

        return $this->responseJson($models);
    }

    /**
     * Menampilkan dropdown list student
     * @param Request $request request dari frontend
     * 
     * @return json 
     */
    public function dropdownList(Request $request) {
        $search = $request->get('search');
        $models = Student::query();
        if ($search) {
            $models = $models->where(function ($query) use ($search) {
                $query->where(DB::raw('LOWER(name)'), 'LIKE', "%$search%")
                      ->orWhere('nim', 'LIKE', "%$search%");
            });
        }

        $models = $models->select('id', DB::raw("CONCAT(nim, ' - ', name) AS name"))
            ->orderBy('name')
            ->get();

        return $this->responseJson($models);
    }

    /**
     * Menampilkan detail student
     * @param int $id id student
     * 
     * @return json 
     */
    public function show($id) {
        $model = Student::find($id);
        if (!$model) return $this->responseNotFound();

        return $this->responseJson($model);
    }

    /**
     * Membuat student
     * @param Request $request request dari frontend
     * 
     * @return json 
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'nim' => [
                'required',
                Rule::unique('students', 'nim'),
            ],
            'name' => 'required',
            'email' => [
                'nullable',
                Rule::unique('students', 'email'),
            ],
            'address' => 'nullable',
            'major_id' => 'nullable',
            'academic_year_id' => 'nullable',
            'phone_number' => 'nullable',
            'actived' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseValidator($validator);
        }

        DB::beginTransaction();
        try {
            $model = new Student();
            $model->fill($request->all());
            $model->save();

            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            return $this->responseError($err->getMessage());
        }

        return $this->responseJson($model, 200, 'Student berhasil ditambahkan');
    }

    /**
     * Mengubah student dari student yang dipilih
     * @param int $id id student
     * @param Request $request request dari frontend
     * 
     * @return json 
     */
    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'nim' => [
                'required',
                Rule::unique('students', 'nim')->ignore($id),
            ],
            'name' => 'required',
            'email' => [
                'nullable',
                Rule::unique('students', 'email')->ignore($id),
            ],
            'address' => 'nullable',
            'major_id' => 'nullable',
            'academic_year_id' => 'nullable',
            'phone_number' => 'nullable',
            'actived' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseValidator($validator);
        }

        DB::beginTransaction();
        try {
            $model = Student::find($id);
            if (!$model) return $this->responseNotFound();

            $model->fill($request->all());
            $model->save();

            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            return $this->responseError($err->getMessage());
        }

        return $this->responseJson($model, 200, 'Student berhasil diubah');
    }

    /**
     * Menghapus student secara soft deletes
     * @param string $id id administrator
     * 
     * @return json 
     */
    public function destroy(string $id)
    {
        $model = Student::find($id);
        if (!$model) return $this->responseNotFound();

        DB::beginTransaction();
        try {
            $model->delete();
            
            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            return $this->responseError($err->getMessage());
        }

        return $this->responseSuccess('Student berhasil dihapus');
    }
}
