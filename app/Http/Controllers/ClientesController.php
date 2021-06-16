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
        try {
            if ($request->method() == 'POST') {
                if (isset($request->nome) || isset($request->cpf)) {
                    if (!empty($request->nome) && !empty($request->cpf)) {
                        $response = Clientes::where('nome', $request->nome)->where('cpf', $request->cpf)->get();
                    } elseif (empty($request->nome) && !empty($request->cpf)) {
                        $response = Clientes::where('cpf', $request->cpf)->get();
                    } elseif (!empty($request->nome) && empty($request->cpf)) {
                        $response = Clientes::where('nome', $request->nome)->get();
                    }else{
                        $response = Clientes::get();
                    }
                }else{
                    $response = Clientes::get();
                }
            } else {
                $response = Clientes::get();
            }

            $response = ['data' => $response, 'sucesso' => true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            if (config('app.debug')) {
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
        }

    }

    // Criação de usuário
    public function store(Request $request)
    {
        try {
            /*Validando nome do cliente*/
            if (isset($request->nome)) {
                $valor = preg_replace('/( )+/', ' ', $request->nome);//tirando espaço duplicado
                $valor = trim($valor); // tirando espaço no final e no inicio da string
                $numbString = strlen($valor);
                if ($numbString == 0) {
                    $erros[] = 'Nome campo Vázio!';
                } elseif (!!preg_match('/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/', str_replace(" ", "", $valor)) == false) {
                    $erros[] = 'Nome não é permitido caracter especiais e números!';
                }
            } else {
                $erros[] = 'Nome inexistente';
            }

            /*Validando cpf do cliente*/
            if (isset($request->cpf)) {
                $request->cpf = $this->numero($request->cpf);
                $verificaCpf = $this->validaCpf($request->cpf);
                if (!$verificaCpf) {
                    $erros[] = 'CPF inválido';
                } else {
                    $valorTotal = Clientes::select(\DB::raw('count(id) as total'))->where('cpf', $request->cpf)->first();
                    if ($valorTotal->total > 0) {
                        $erros[] = 'CPF já cadastrado no sistema';
                    }
                }
            } else {
                $erros[] = 'CPF inexistente';
            }

            if (isset($request->telefone)) {
                /*Validando telefone do cliente*/
                $request->telefone = $this->numero($request->telefone);
                $verificaTel = $this->validaTel($request->telefone);

                if (!$verificaTel) {
                    $erros[] = 'Telefone inválido';
                } else {
                    $valorTotal = Clientes::select(\DB::raw('count(id) as total'))->where('telefone', $request->telefone)->first();
                    if ($valorTotal->total > 0) {
                        $erros[] = 'Telefone já cadastrado no sistema';
                    }
                }
            } else {
                $erros[] = 'Telefone inexistente';
            }


            //validação data de nascimento do cliente
            if (isset($request->data_nascimento)) {
                $valor = preg_replace('/( )+/', ' ', $request->data_nascimento);//tirando espaço duplicado
                $valor = trim($valor); // tirando espaço no final e no inicio da string
                $numbString = strlen($valor);
                if ($numbString == 0) {
                    $erros[] = 'Data nascimento com campo Vázio!';
                }
            } else {
                $erros[] = 'Data nascimento inexistente';
            }

            /*caso não existe nenhum erro o registro vai ser salvo*/
            if (isset($erros)) {
                return response()->json(['data' => [], 'sucesso' => false, 'mensagemRetorno' => $erros]);
            } else {
                $data = new Clientes();
                $data->nome = $request->nome;
                $data->cpf = $request->cpf;
                $data->data_nascimento = $request->data_nascimento;
                $data->telefone = $request->telefone;
                $data->save();
                $response = ['data' => $data, 'sucesso' => true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
                return response()->json($response, 201); //código 201 para produto criado com sucesso
            }
        } catch (\Exception $exception) {
            if (config('app.debug')) {
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
        }

    }

    // Apagar rgistro da tabela usuário
    public function destroy($id)
    {
        try {
            $data = Clientes::find($id);
            if ($data == null) {
                $response = ['data' => [], 'sucesso' => false, 'mensagemRetorno' => 'Registro não encontrado'];
                return response()->json($response, 400);
            } else {
                $data->delete();
                $response = ['data' => [], 'sucesso' => true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
                return response()->json($response, 201);
            }
        } catch (\Exception $exception) {
            if (config('app.debug')) {
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
        }

    }

    public function getClienteFiltro(Request $request)
    {
        try {
            $response = Clientes::get();
            $response = ['data' => $response, 'sucesso' => true, 'mensagemRetorno' => 'Operação efetuada com sucesso'];
            return response()->json($response, 200);
        } catch (\Exception $exception) {
            if (config('app.debug')) {
                $ex = ApiError::errorMessage($exception->getMessage(), 1010);
                return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
            }
            $ex = ApiError::errorMessage($exception->getMessage(), 1010);
            return response()->json(['data' => $ex['data'], 'sucesso' => false, 'mensagemRetorno' => 'Erro interno entre em contato com o seu suporte']);
        }

    }

    function validacpf($cpf = false)
    {
//        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }


    function validaTel($telefone)
    {
        $telefone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));

        $regexTelefone = "/^[0-9]{11}$/";

        //$regexCel = '/[0-9]{2}[6789][0-9]{3,4}[0-9]{4}/'; // Regex para validar somente celular
        if (preg_match($regexTelefone, $telefone)) {
            return true;
        } else {
            return false;
        }
    }

    private function numero($valor)
    {
        return preg_replace("/[^0-9]/", "", $valor);
    }
}
