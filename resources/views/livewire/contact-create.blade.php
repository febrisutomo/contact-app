<div>
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addContact">
        Add Contact
    </button>

    <div wire:ignore.self class="modal fade" id="addContact" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactLabel">Add Contact</h5>
                    <button wire:click="resetInput()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        <img width="150px" height="150px" src="@if ($image) {{ $image->temporaryUrl() }} @else {{ asset('storage/profile/default-profile.png') }} @endif" alt="" class="rounded-circle d-block mx-auto mb-2"
                            style="object-fit:cover">
                        <label for="image" class="d-flex justify-content-center mb-3">
                            <div class="btn btn-sm btn-success">Add Photo</div>
                        </label>
                        <input wire:model="image" type="file" name="" id="image" class=" d-none" accept="image/*">

                        <div class="form-group">
                            <input wire:model="name" type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input wire:model="phone" type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="Phone">
                            @error('phone')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetInput()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
