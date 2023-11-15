<div class="py-3 px-3">

    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">Gestion des utiliisateurs </h3>

        <a data-bs-toggle="modal" data-bs-target="#new-user" class="btn  btn-outline-dark  fw-bold">Nouveau utilisateur</a>

    </div>


    <div class="d-flex justify-content-start mb-2">
        <form action="" class="col-md-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search"
                    placeholder="Chercher par nom et numéro " value="{{ $search }}">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class=" table-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($users->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->level }}</td>
                            <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#edit-user"
                                    wire:click="loadid('{{ $user->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier l'user">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <a class="btn  " data-bs-toggle="modal" data-bs-target="#delete"
                                    wire:click="loadid('{{ $user->id }}')">
                                    <i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Supprimer l'user "></i>
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
            {{ $users->links() }}
        </div> --}}

        <x-delete-modal delmodal="delete" message="Confirmer la suppression " delf="delete" />



        <div class="modal fade" id="new-user"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" wire:ignore.self>

            <div class="modal-dialog modal-fullscreen " role="document">
                <div class="modal-content ">
                    <form wire:submit.prevent="store">

                        <div class="modal-header bg-dark text-white d-flex ">
                            <div class="col-6 text-end">
                                <h3 class="fw-bold">Nouveau user</h3>
                            </div>

                            <div class="col-6 text-end pe-3">
                                <div class="row">
                                    <div class="">
                                        <button type="submit" name="submit"
                                            class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                        <button type="reset" wire.click="close_modal"
                                            class="btn btn-danger square fw-bold"
                                            data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body px-2">

                            <div class="mt-1">
                                <x-input-icon iplabel="Nom" ipicon="fa-user" ipname="name" iptype="text" ipid="name" ipplaceholder="Ex: Moussa Hamadou"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Pseudo" ipicon="fa-user" ipname="username" iptype="text" ipid="username" ipplaceholder="Ex: moussaha"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Email" ipicon="fa-at" ipname="email" iptype="email" ipid="email" ipplaceholder="Ex: moussa.hamadou@djibtel.dj"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Mot de passe" ipicon="fa-lock" ipname="password" iptype="text" ipid="password" ipplaceholder=" ******** "  />
                            </div>

                            <div class="mt-1 col ">
                                <label for="level"
                                    class="form-label text-muted fw-italic mb-0">Role
                                    *</label>
                                <div class="input-group">
                                    <span class="input-group-text txt fw-bold  text-white">
                                        <i class="fa-solid fa-user-cog text-dark"></i>
                                    </span>
                                    <select wire:model.defer="level" class="form-select w-25"
                                        id="level" required>
                                        <option value="" selected>Choisir</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Agent</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('level')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="edit-user" tabindex="-1" aria-hidden="true" wire:ignore.self>

            <div class="modal-dialog modal-fullscreen " role="document">
                <div class="modal-content ">
                    <form wire:submit.prevent="update">

                        <div class="modal-header bg-dark text-white d-flex ">
                            <div class="col-6 text-end">
                                <h3 class="fw-bold">Modification </h3>
                            </div>

                            <div class="col-6 text-end pe-3">
                                <div class="row">
                                    <div class="">
                                        <button type="submit" name="submit"
                                            class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                        <button type="reset" wire.click="close_modal"
                                            class="btn btn-danger square fw-bold"
                                            data-bs-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body px-2">

                            <div class="mt-1">
                                <x-input-icon iplabel="Nom" ipicon="fa-user" ipname="name2" iptype="text" ipid="name2" ipplaceholder="Ex: Moussa Hamadou"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Pseudo" ipicon="fa-user" ipname="username2" iptype="text" ipid="username2" ipplaceholder="Ex: moussaha"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Email" ipicon="fa-at" ipname="email2" iptype="email" ipid="email2" ipplaceholder="Ex: moussa.hamadou@djibtel.dj"  />
                            </div>
                            <div class="mt-1">
                                <x-input-icon iplabel="Mot de passe" ipicon="fa-lock" ipname="password2" iptype="text" ipid="password2" ipplaceholder=" ******** "  />
                            </div>

                            <div class="mt-1 col ">
                                <label for="level2"
                                    class="form-label text-muted fw-italic mb-0">Role
                                    *</label>
                                <div class="input-group">
                                    <span class="input-group-text txt fw-bold  text-white">
                                        <i class="fa-solid fa-user-cog text-dark"></i>
                                    </span>
                                    <select wire:model.defer="level2" class="form-select w-25"
                                        id="level2" required>
                                        <option value="" selected>Choisir</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Agent</option>
                                    </select>
                                </div>
                                <span class="text-danger">
                                    @error('level2')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


</div>
