<div class="py-3 px-3"> 
    
    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">La liste des clients </h3>

        {{--  <a data-bs-toggle="modal" data-bs-target="#adduser" class="btn  btn-outline-dark  fw-bold">Nouvelle Utilisateur</a> --}}

    </div>


    <div class="d-flex justify-content-start mb-2">
        <form action="" class="col-md-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Chercher par nom et numéro "
                    value="{{ $search }}">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class=" table-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Type Pièce</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($clients->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                    @endphp
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $client->numero }}</td>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->type_doc }}</td>
                            <td>{{ $client->filename }}</td>
                            <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#showmodal"
                                    wire:click="showImg('{{ $client->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Voir la pièce d'identité">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @php
                            $cnt = $cnt + 1;
                            $editmodal = 'edit' . $cnt;
                            $delmodal = 'delete' . $cnt;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- <div class="d-flex justify-content-center">
            {{ $clients->links() }}
        </div> --}}

        {{-- <x-delete-modal delmodal="delmodal" message="Etes-vous sûr de vouloir supprimer l'user "  delf="delete" /> --}}

        <div class="modal fade" id="showmodal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Pièce d'identité </h3>

                        <button type="button" class="btn btn-danger fw-bold " wire:click="close_img"
                            data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body ">
                        <img alt="Image de la pièce d'identité" hover="Image de la pièce d'identité" src="{{ asset($imgUrl) }}"
                                class="avatar border border-1 " id="avatar" width="100%" height="100%">
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
