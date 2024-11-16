@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Administração de Imagens</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.images.create') }}" class="btn btn-primary mb-3">Adicionar Nova Imagem</a>

    <ul class="nav nav-tabs" id="imageTabs" role="tablist">
        @foreach ($imagesByType as $type => $images)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $type }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $type }}" type="button" role="tab" aria-controls="{{ $type }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-type="{{ $type }}">
                    {{ ucfirst($type) }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content" id="imageTabsContent">
        @foreach ($imagesByType as $type => $images)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $type }}" role="tabpanel" aria-labelledby="{{ $type }}-tab">
                <div class="row mt-4 image-gallery">
                    @if (count($images) > 0)
                        @foreach ($images as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="card-img-top" alt="{{ $image->type }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ ucfirst($image->type) }}</h5>
                                        <a href="{{ route('admin.images.edit', $image->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('admin.images.destroy', $image->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta imagem?')">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Nenhuma imagem disponível nesta categoria.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('click', function () {
            const activeTabId = this.getAttribute('data-bs-target').replace('#', '');

            document.querySelectorAll('.image-gallery').forEach(gallery => {
                gallery.parentElement.classList.remove('show', 'active');
            });

            const activeGallery = document.getElementById(activeTabId);
            if (activeGallery) {
                activeGallery.classList.add('show', 'active');
            }
        });
    });
</script>
@endsection
