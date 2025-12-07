@extends('templates/main',
    [
        'titulo'=>"Sistema GEAS",
        'cabecalho' => 'Alterar Avistamento',
        'rota' => '',
        'relatorio' => '',
    ]
)
@section('conteudo')

    <form action="{{route('sightings.update', $sighting->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-secondary text-white">Foto</span>
                    <input class="form-control text-secondary" type="file" name="foto"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="common_name"
                        id="common_name"
                        placeholder="Nome"
                        value="{{ $sighting->species->common_name }}"
                    />
                    <label for="common_name">Nome popular</label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-10">
                <div class="form-floating mb-3">
                    <select class="form-select" name="species_id" id="species_id">
                        <option value="">Selecione uma espécie</option>

                        @foreach($species as $sp)
                            <option value="{{ $sp->id }}"
                                @if($sp->id == $sighting->species_id) selected @endif>
                                {{ $sp->scientific_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="species_id">Espécie</label>
                </div>
            </div>

            <div class="col-2 d-flex align-items-center">
                <button 
                        type="button"
                        class="btn text-light w-100"
                        style="background-color: #F2B36D; hover: #D98B45;"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNovaEspecie">
                        +
                </button>
            </div>
        </div>

        <script>
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formNovaEspecie");
    if (!form) {
        console.error("Formulário da modal NÃO foi encontrado.");
        return;
    }

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("{{ route('species.modalStore') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                const select = document.getElementById("species_id");
                const option = document.createElement("option");

                option.value = data.species.id;
                option.textContent = data.species.scientific_name;
                option.selected = true;

                select.appendChild(option);

                document.getElementById("common_name").value = data.species.common_name;

                const modal = bootstrap.Modal.getInstance(document.getElementById("modalNovaEspecie"));
                modal.hide();

                form.reset();
            } else {
                alert("Erro ao salvar espécie.");
            }
        })
        .catch(err => alert("Erro na requisição: " + err));
    });

});
</script>


        <script>
            const speciesData = @json($species);

            document.getElementById("species_id").addEventListener("change", function () {
                const selectedId = this.value;
                const selectedSpecies = speciesData.find(sp => sp.id == selectedId);

                if (selectedSpecies) {
                    document.getElementById("common_name").value = selectedSpecies.common_name;
                } else {
                    document.getElementById("common_name").value = "";
                }
            });
        </script>


        <div class="row">
            <div class="col">
                <label class="form-label d-block mb-2">Gênero</label>

                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="gender" 
                        id="gender_f" 
                        value="F"
                        {{ $sighting->gender == 'F' ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="gender_f">Feminino</label>
                </div>

                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="gender" 
                        id="gender_m" 
                        value="M"
                        {{ $sighting->gender == 'M' ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="gender_m">Masculino</label>
                </div>

                <div class="form-check form-check-inline">
                    <input 
                        class="form-check-input" 
                        type="radio" 
                        name="gender" 
                        id="gender_n" 
                        value="N"
                        {{ $sighting->gender == 'N' ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="gender_n">Não identificado</label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="found_location"
                        placeholder="Lugar encontrado"
                        value="{{ $sighting->found_location }}"
                    />
                    <label for="found_location">Lugar encontrado</label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="description"
                        placeholder="Descrição"
                        value="{{ $sighting->description }}"
                    />
                    <label for="description">Descrição</label>
                </div>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col">
                <a href="{{route('sightings.index')}}" class="btn btn-secondary btn-block align-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                    </svg>
                    &nbsp; Voltar
                </a>

                <button type="submit" class="btn btn-secondary btn-block align-content-center">
                    Confirmar &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>


    <div class="modal fade" id="modalNovaEspecie" tabindex="-1">
        <div class="modal-dialog">
            <form id="formNovaEspecie">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar espécie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-3" type="text" name="common_name" placeholder="Nome popular">
                    <input class="form-control" type="text" name="scientific_name" placeholder="Nome científico">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
