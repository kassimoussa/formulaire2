<div class="py-3 px-3">

    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">La liste des SIMs </h3>
 
    </div>


    <div class="d-flex justify-content-start mb-5">
        <div class="col-md-6">
            <div class="input-group  ">
                <span class="btn btn-dark">Chercher</span>
                <input type="search" class="form-control " wire:model="search"
                    placeholder="Chercher par nom et numéro " value="{{ $search }}">
            </div>
        </div> 


    </div>

    

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class=" table-dark text-white text-center">
                <th scope="col">#</th> 
                <th scope="col">Numero</th>
                <th scope="col">Nom</th> 
                <th scope="col">Status</th>
                {{-- <th scope="col">Action</th> --}}
            </thead>
            <tbody class="text-center">
                @if ($sims->isNotEmpty())
                    @php
                        $cnt = 1; 
                    @endphp
                    @foreach ($sims as $sim) 
                        <tr>
                            <td>{{ $sim->id }}</td> 
                            <td>{{ $sim->numero }}</td>
                            <td>{{ $sim->nom }}</td>
                            <td>{{ $sim->status }}</td>
                            {{-- <td>{{ optional($sim->user)->name ?? 'Le sim' }}</td>  --}}
                           {{--  <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#updsim"
                                    wire:click="loadid('{{ $sim->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <a data-bs-toggle="modal" data-bs-target="#updPiece"
                                    wire:click="loadid('{{ $sim->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier la pièce d'identité">
                                    <i class="fas fa-images"></i>
                                </a>


                                <a class="btn  " data-bs-toggle="modal" data-bs-target="#delete"
                                    wire:click="loadid('{{ $sim->id }}')">
                                    <i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Supprimer le sim "></i>
                                </a>
                            </td> --}}
                        </tr>
                        @php
                            $cnt = $cnt + 1; 
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">Aucun sim trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center w-100">
            {{ $sims->links() }}
        </div>

        <x-delete-modal delmodal="delete" message="Confirmer la suppression " delf="delete" />

    </div>



</div>
