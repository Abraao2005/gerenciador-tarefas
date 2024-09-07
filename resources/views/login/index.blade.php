@extends('template.main')
@section('conteudo')
    <link rel="stylesheet" href="{{ url('css/login.css') }}">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Login</h4>
                        @if (session()->has('login'))
                            <p class="error-lg">{{ session('login') }}</p>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf


                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Digite seu email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha:</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Digite sua senha" required>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-secondary">Entrar</button>
                            </div>

                            <div class="text-center mt-3">
                                <a href="{{ route('registerForm') }}" class="btn btn-link">Cadastrar-se</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
