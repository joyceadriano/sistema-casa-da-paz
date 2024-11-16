@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Nova Imagem</h1>


    <ul class="nav nav-tabs" id="createTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" data-type="home">Home</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="galeria-tab" data-bs-toggle="tab" data-bs-target="#galeria" type="button" role="tab" aria-controls="galeria" aria-selected="false" data-type="galeria">Galeria</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="quem_somos-tab" data-bs-toggle="tab" data-bs-target="#quem_somos" type="button" role="tab" aria-controls="quem_somos" aria-selected="false" data-type="quem_somos">Quem Somos</button>
        </li>
    </ul>

    <div class="tab-content" id="createTabsContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data" class="mt-4" id="imageForm">
                @csrf
                <input type="hidden" name="type" id="imageType" value="home">
                <div class="form-group">
                    <label for="image">Selecione a Imagem:</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Adicionar Imagem</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('click', function () {
            const type = this.getAttribute('data-type');
            const container = document.querySelector('.container');
            const form = document.getElementById('imageForm');
            
  
            document.getElementById('imageType').value = type;

            switch (type) {
                case 'home':
                    container.style.backgroundColor = '#f8f9fa';
                    container.style.color = '#000';
                    break;
                case 'galeria':
                    container.style.backgroundColor = '#d1e7dd';
                    container.style.color = '#084c41'; 
                    break;
                case 'quem_somos':
                    container.style.backgroundColor = '#fde2e2';
                    container.style.color = '#b02a37'; 
   
                    break;
            }
        });
    });
</script>
@endsection
