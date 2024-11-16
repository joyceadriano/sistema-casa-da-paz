@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Imagem</h1>

    <form action="{{ route('admin.images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Tipo da Imagem:</label>
            <select name="type" id="type" class="form-control" required>
                <option value="home" {{ $image->type == 'home' ? 'selected' : '' }}>Home</option>
                <option value="galeria" {{ $image->type == 'galeria' ? 'selected' : '' }}>Galeria</option>
                <option value="quem_somos" {{ $image->type == 'quem_somos' ? 'selected' : '' }}>Quem Somos</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Nova Imagem (deixe em branco se não quiser mudar):</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Imagem</button>
    </form>
</div>
@endsection
