<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class cardController extends Controller
{

    public function store(Request $request)
    {
        try {
            Card::create($request->all());


            Alert::success('Entrada/Saída', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Entrada/Saída', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.patient.index"));
    }

    public function update(Request $request, $id)
    {

        try {

            $data = Card::find($id);
            $data = $data->update($request->all());
            Alert::success('Entrada/Saída', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Entrada/Saída', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.patient.index"));
    }

    public function view($id)
    {

        if (empty($id)) {
            return response()->json(['error' => 'ID vazio'], 400);
        }
        try {
            $result = Card::find($id); // Substitua 'buscarDadosPorId' pelo método real que busca os dados com base no ID.

            if (!$result) {
                return response()->json(['error' => 'Não trouxe nenhum resultado'], 404);
            }

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro ao processar a solicitação'], 500);
        }
    }
}
