<div class="row">
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-body">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                <div class="row mb-3">
                    <div class="col">
                        @livewire('contact-create')
                    </div>
                    <div class="col">
                        <select wire:model="pageLength" name="" id="" class="form-control form-control-sm w-auto">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <div class="col">
                        <input wire:model="search" type="text" name="" id="" class="form-control form-control-sm"
                            placeholder="Search">
                    </div>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1 + $pageLength * ($page - 1);
                        @endphp
                        @foreach ($contacts as $contact)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td><img src="{{ asset('storage/profile/' . $contact->image) }}" alt=""
                                        class="rounded-circle" style="object-fit:cover" width="42px" height="42px"></td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>
                                    <button wire:click="edit({{ $contact->id }})" type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editContact">Edit</button>
                                    <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        wire:click="destroy({{ $contact->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>

    @livewire('contact-edit')

</div>

@push('scripts')
    <script>
        window.addEventListener('closeModal', () => {
            $('#addContact').modal('hide');
            $('#editContact').modal('hide');
        });
    </script>
@endpush
