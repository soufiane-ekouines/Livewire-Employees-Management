<div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Departements</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('Departements_message'))
                    <div class="alert alert-success">
                        {{ session('Departements_message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('Departments.index') }}">
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <input type="search" wire:model="search" class="form-control mb-2" id="inlineFormInput"
                                        placeholder="Jane Doe">
                                </div>
                                <div class="col" wire:loading>
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden"></span>
                                      </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <!-- Button trigger modal Create -->
                    <button type="button" class="btn btn-primary" wire:click="Openmodel">
                        New Departements
                    </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <table class="table" wire:loading.remove> --}}
                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Departements</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Departements as $Departement)
                            <tr>
                                <th scope="row">{{ $Departement->id }}</th>
                                <td>{{ $Departement->name }}</td>
                                <td>
                                    <a wire:click="edit({{ $Departement->id }})" href="#" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <a wire:click="delete({{ $Departement->id }})" href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                           <tr> <th>NO Results </th></tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    {{-- {{ $Departements->links('pagination::bootstrap-4') }} --}}
                    {{-- {{ $Departements->links() }} --}}

                </div>
            </div>
        </div>
     <!-- Modal -->
     <div class="modal fade" id="DepartementsModal" tabindex="-1" aria-labelledby="DepartementsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DepartementsModalLabel">Departements</h5>
                    <button type="button" class="close" wire:click="Closemodel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                            <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    wire:model.defer="name">
                                    {{-- @error('name') <span class="error">{{ $message }}</span> @enderror
                                     --}}
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="Closemodel">Close</button>
                    <div wire:loading.remove>
                    @if ($editMode)
                        <button  type="button" class="btn btn-primary" wire:click="update">Update Departements</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="storeDepartements">Store Departements</button>
                    @endif
                </div>
                    <div class="col" wire:loading>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden"></span>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
