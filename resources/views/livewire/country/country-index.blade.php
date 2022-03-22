<div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Country</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('Country_message'))
                    <div class="alert alert-success">
                        {{ session('Country_message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form method="GET" action="{{ route('country.index') }}">
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#countryModal">
                        New Country
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
                            <th scope="col">Code</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Country as $countr)
                            <tr>
                                <th scope="row">{{ $countr->id }}</th>
                                <td>{{ $countr->country_code }}</td>
                                <td>{{ $countr->name }}</td>
                                <td>
                                    <a wire:click="edit({{ $countr->id }})" href="#" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    <a wire:click="delete({{ $countr->id }})" href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                           <tr> <th>NO Results </th></tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    {{ $Country->links('pagination::bootstrap-4') }}
                    {{-- {{ $Country->links() }} --}}

                </div>
            </div>
        </div>
     <!-- Modal -->
     <div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="countryModalLabel">Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="country_code"
                                class="col-md-4 col-form-label text-md-right">{{ __('country_code') }}</label>

                            <div class="col-md-6">
                                <input id="country_code" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    wire:model.defer="country_code">

                                @error('country_code')
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
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    <div wire:loading.remove>
                    @if ($editMode)
                        <button  type="button" class="btn btn-primary" wire:click="update">Update Country</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="storeCountry">Store Country</button>
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
