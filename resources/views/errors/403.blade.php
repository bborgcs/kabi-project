@extends('templates/main', [
    'titulo' => 'Acesso negado',
    'cabecalho' => 'Permissão insuficiente'
])

@section('conteudo')

<div class="alert alert-danger mt-4">
    <strong>Você não tem permissão para editar este avistamento.</strong><br>
    Apenas o usuário que realizou o cadastro pode realizar alterações.
</div>

<a href="{{ route('sightings.index') }}" class="btn btn-secondary mt-3">
    Voltar
</a>

@endsection
