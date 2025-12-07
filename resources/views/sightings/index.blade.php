@extends('templates/main',
    [
        'titulo'=>"AVISTAMENTOS DE AVES",
        'cabecalho' => 'CATALOGAÇÃO DE PASSAROS',
        'rota' => 'sightings.create',
        'relatorio' => 'report.sightings',
        'class' => App\Models\Sighting::class,
    ]
)
@section('conteudo')

    <table class="table align-middle caption-top table-striped">
        <thead>
            <th class="text-secondary">USUÁRIO</th>
            <th class="text-secondary">AVE</th>
            <th class="text-secondary">NOME</th>
            <th class="d-none d-md-table-cell text-secondary">ESPÉCIE</th>
            <th class="d-none d-md-table-cell text-secondary">GÊNERO</th>
            <th class="d-none d-md-table-cell text-secondary">LUGAR ENCONTRADO</th>
            <th class="text-center text-secondary">DESCRIÇÃO</th>
        </thead>
        <tbody>
            @foreach ($sightings->where('life_status', 'vivo') as $bird)
                <tr>

                    {{-- USUÁRIO --}}
                    <td>
                        {{ $bird->user->name ?? 'Usuário não informado' }}
                    </td>

                    {{-- AVE --}}
                    <td>
                        <img src="{{ asset('storage/'.$bird->image
                        
                        ->image_path) }}"
                            alt="foto"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                    </td>

                    {{-- NOME (pré-select: species) --}}
                    <td>{{ $bird->species->common_name }}</td>

                    {{-- ESPÉCIE (pré-select: species) --}}
                    <td class="d-none d-md-table-cell">{{ $bird->species->scientific_name }}</td>

                    {{-- GÊNERO --}}
                    <td class="d-none d-md-table-cell">{{['M' => 'Masculino','F' => 'Feminino','N' => 'Não identificado'
                            ][$bird->gender] ?? 'Não informado'}}</td>

                    {{-- LUGAR ENCONTRADO --}}
                    <td class="d-none d-md-table-cell">{{ $bird->found_location }}</td>
                    
                    {{-- DESCRIÇÃO --}}
                    <td class="d-none d-md-table-cell">{{ $bird->description }}</td>

                    {{-- AÇÕES --}}
                    <td>
                        <a href="{{ asset('storage/'.$bird->image->image_path) }}" target="_blank" class="btn btn-outline-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="#000" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            </svg>
                        </a>

                        @can('update', $bird)
                            <a href="{{route('sightings.edit', $bird->id)}}" class="btn btn-outline-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#5cb85c" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                </svg>
                            </a>
                        @endcan

                        @can('delete', $bird)
                            <a nohref style="cursor:pointer"
                               onclick="showRemoveModal('{{ $bird->id }}', '{{ $bird->species->common_name }} - {{ $bird->species->scientific_name }}')"
                               class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#d9534f" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>

                            <form action="{{route('sightings.destroy', $bird->id)}}" method="POST" id="form_{{$bird->id}}">
                                @csrf
                                @method('delete')
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection