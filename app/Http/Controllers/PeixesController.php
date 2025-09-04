<?php

namespace App\Http\Controllers;

use App\Models\Peixes;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PeixesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperando todos os registros do banco de dados
        $registros = Peixes::all();

        // Contando o número de registros
        $contador = $registros->count();

        // Verificando se há registros
        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Peixes encontrados com sucesso',
                'data' => $registros,
                'total' => $contador
            ], 200);
        }

        // Caso não haja registros, retornar 404
        return response()->json([
            'success' => false,
            'message' => 'Nenhum peixe encontrado',
        ], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required|numeric',
            'caracteristica' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        // Criando um registro no banco de dados
        $registro = Peixes::create($request->all());

        if ($registro) {
            return response()->json([
                'success' => true,
                'message'=> 'Peixe cadastrado com sucesso!',
                'data' => $registro
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar o peixe'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscando um peixe pelo ID
        $registro = Peixes::find($id);

        // Verificando se o peixe foi encontrado
        if ($registro) {
            return response()->json([
                'success' => true,
                'message' => 'Peixe localizado com sucesso!',
                'data' => $registro
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Peixe não localizado.',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'especie' => 'required',
            'preco' => 'required|numeric',
            'caracteristica' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        // Encontrando o registro no banco
        $registroBanco = Peixes::find($id);

        if (!$registroBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        // Atualizando os dados
        $registroBanco->nome = $request->nome;
        $registroBanco->marca = $request->marca;
        $registroBanco->preco = $request->preco;
        $registroBanco->caracteristica = $request->caracteristica;

        // Salvando as alterações
        if ($registroBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Peixe atualizado com sucesso!',
                'data' => $registroBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar o produto'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrando um peixe no banco
        $registro = Peixes::find($id);

        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'Peixe não encontrado'
            ], 404);
        }

        // Deletando o peixe
        if ($registro->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Peixe deletado com sucesso'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar o peixe'
        ], 500);
    }
}