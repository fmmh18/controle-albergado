<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Patient;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class patientController extends Controller
{


    public function index(Request $request)
    {
        $data = patient::orderBy('name');

        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.patient.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.patient.form');
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.patient.create'))
                ->withErrors($validator)
                ->withInput();
        }



        try {
            $data = patient::create($request->all());

            Card::create([
                'patient_id' => $data->id,
                'user_id' => Auth::user()->id,
                'date_initial' => date('Y-m-d')
            ]);

            Alert::success('Paciente', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Paciente', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.patient.index"));
    }


    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = patient::find($id);

        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.patient.form', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.patient.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = patient::find($id);

            $data = $data->update($request->all());
            Alert::success('Paciente', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Paciente', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.patient.index"));
    }

    public function destroy($id)
    {
        try {
            $data = patient::find($id);
            $data = $data->delete();
            Alert::success('Paciente', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Paciente', $e->getMessage());
        }

        return redirect(route("dashboard.patient.index"));
    }
}
