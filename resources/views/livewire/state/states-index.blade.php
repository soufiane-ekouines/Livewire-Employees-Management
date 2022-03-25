<div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">States</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('States_message'))
                    <div class="alert alert-success">
                        {{ session('States_message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('states.index') }}">
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
                        New States
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
                            <th scope="col">Country</th>
                            <th scope="col">States</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($States as $state)
                            <tr>
                                <th scope="row">{{ $state->id }}</th>
                                <td>{{ $state->country->name }}</td>
                                <td>{{ $state->name }}</td>
                                <td>
                                    <a wire:click="edit({{ $state->id }})" href="#" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <a wire:click="delete({{ $state->id }})" href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                           <tr> <th>NO Results </th></tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    {{-- {{ $States->links('pagination::bootstrap-4') }} --}}
                    {{-- {{ $States->links() }} --}}

                </div>
            </div>
        </div>
     <!-- Modal -->
     <div class="modal fade" id="StatesModal" tabindex="-1" aria-labelledby="StatesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="StatesModalLabel">States</h5>
                    <button type="button" class="close" wire:click="Closemodel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="country_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('country_id') }}</label>

                            <div class="col-md-6">
                                <input id="country_id" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    wire:model.defer="country_id">

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                        <button  type="button" class="btn btn-primary" wire:click="update">Update States</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="storeStates">Store States</button>
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
