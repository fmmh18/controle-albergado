<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use App\Models\site;
use App\Models\User;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class userController extends Controller
{


    public function index(Request $request)
    {
        $data = User::orderBy('name');

        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->input('email')) {
            $data = $data->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.user.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        $allStatus = User::allStatus();
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.user.form', ['allStatus' => $allStatus]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.user.create'))
                ->withErrors($validator)
                ->withInput();
        }



        try {
            $data = User::create($request->all());


            Alert::success('Usuário', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Usuário', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.user.index"));
    }

    public function showMe()
    {

        $id = Auth::user()->id;
        if (empty($id)) {
            abort(404);
        }

        $data = User::find($id);

        if ($data->status != 1) {

            abort(404);
        }


        return view('dashboard.me.show');
    }

    public function updateMe(Request $request)
    {
        if (!empty($request->file('images'))) {

            $user_name = \Str::slug($request->input('name'), '-');

            $name = time() . '.' . $request->file('images')->getClientOriginalExtension();

            $request->file('images')->storeAs("user/" . $user_name . "/", $name, 'public');

            $request->merge(array(
                'image'     =>  "/storage/user/" . $user_name . "/" . $name
            ));
        }

        try {
            $data = User::find(Auth::user()->id);
            $data->update((!empty($request->input('password'))) ? $request->except([]) : $request->except(["password"]));
            Alert::success('Meus dados', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Meus dados', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.home"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = User::find($id);

        \Config::set('layout.titulo', 'Editar');
        $allStatus = User::allStatus();
        return view('dashboard.user.form', ['data' => $data, 'allStatus' => $allStatus]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.user.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = User::find($id);

            $data = $data->update($request->all());
            Alert::success('Usuário', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Usuário', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.user.index"));
    }

    public function destroy($id)
    {
        try {
            $data = User::find($id);
            $data = $data->delete();
            Alert::success('Usuário', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Usuário', $e->getMessage());
        }

        return redirect(route("dashboard.user.index"));
    }
}
