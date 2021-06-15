<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Api\ApiError;
//use http\Client\Curl\User;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
//
//    public function __construct()
//    {
//        //
//    }

    // Listagem de usuário
    public function index(Request $request)
    {
        try{
            if ($request->method() == 'POST'){

                if (isset($request->nome) && isset($request->cpf)){
                    $response  = Clientes::where('nome', $request->nome)->where('cpf', $request->cpf)->get();
                }else{
                    if(isset($request->nome)){
                        $response  = Clientes::where('nome', $request->nome)->get();
                    }

                    if(isset($request->cpf)){
                        $response  = Clientes::where('cpf', $request->cpf)->get();
                    }
                }

            }else{
                $response  = Clientes::get();
            }

            $response = ['data'=> $response , 'sucesso'=> true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
            return  response()->json($response, 200);
        }catch (\Exception $exception){
            if(config('app.debug')){
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
        }

    }

    // Criação de usuário
    public function store(Request $request)
    {
        try{

            $data = new Clientes();
            $data->nome = $request->nome;
            $data->cpf = $request->cpf;
            $data->data_nascimento = $request->data_nascimento;
            $data->telefone = $request->telefone;
            $data->save();
            $response = ['data'=> $data, 'sucesso'=> true, 'mensagemRetorno'=> 'Operação efetuada com sucesso'];
            return  response()->json($response, 201); //código 201 para produto criado com sucesso
        }catch (\Exception $exception){
            if(config('app.debug')){
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
        }

    }

    // Apagar rgistro da tabela usuário
    public function destroy($id)
    {
        try{
            $data = Clientes::find($id);
            if($data == null){
                $response = ['data'=> [], 'sucesso'=> false, 'mensagemRetorno' => 'Registro não encontrado'];
                return response()->json($response, 400);
            }else{
                $data->delete();
                $response = ['data'=> [], 'sucesso'=> true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
                return response()->json($response, 201);
            }
        }catch (\Exception $exception){
            if(config('app.debug')){
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
        }

    }

    public function getClienteFiltro(Request $request)
    {
        try{
            $response  = Clientes::get();
            $response = ['data'=>$response , 'sucesso'=> true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
            return  response()->json($response, 200);
        }catch (\Exception $exception){
            if(config('app.debug')){
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data'=> $ex['data'], 'sucesso'=> false, 'mensagemRetorno'=> 'Erro interno entre em contato com o seu suporte']);
        }

    }
}
