<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        try {
            $email = $req->input("email", null);
            $password = $req->input("password", null);

            !$email || !$password ? throw new Exception("") : "Email ou senha estão vazios";
            $user = new User();
            $response = $user->selectUser($email);

            if (empty($response)) {
                throw new Exception("Email não cadastrado", 1);
            }
            if (!password_verify($password, $response[0]->password)) {
                throw new Exception("A senha está incorreta", 1);
            }
            return redirect()->route("dashboard")->with("user", $response);
        } catch (Exception $exp) {
            return redirect()->route("home")->with("login", $exp->getMessage());
        }
    }
    public function register(Request $req)
    {
        try {
            $email = $req->input("email", null);
            $name = $req->input("username", null);
            $password = $req->input("password", null);;
            !$email || !$password || !$name ? throw new Exception("Email, senha ou username estão vazios") : "";

            $this->validityPassword($password);

            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $user = new User();
            $user->insertUser($name, $password_hash, $email);
            return redirect()->route("home")->with("login", "Registro completo");
        } catch (Exception $exp) {
            return redirect()->route("home")->with("register", $exp->getMessage());
        }
    }

    private function validityPassword($password)
    {
        // Verifica se a senha tem pelo menos 8 caracteres
        if (strlen($password) < 8) {
            throw new Exception("É necessário digitar pelo menos 8 caracteres na senha");
        }

        // Verifica se a senha contém pelo menos uma letra maiúscula
        if (!preg_match('/[A-Z]/', $password)) {
            throw new Exception("A senha deve conter pelo menos uma letra maiúscula");
        }

        // Verifica se a senha contém pelo menos uma letra minúscula
        if (!preg_match('/[a-z]/', $password)) {
            throw new Exception("A senha deve conter pelo menos uma letra minúscula");
        }

        // Verifica se a senha contém pelo menos um número
        if (!preg_match('/\d/', $password)) {
            throw new Exception("A senha deve conter pelo menos um número");
        }

        // Verifica se a senha contém pelo menos um caractere especial
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            throw new Exception("A senha deve conter pelo menos um caractere especial");
        }

        // Se todas as verificações passarem
        return true;
    }
}
