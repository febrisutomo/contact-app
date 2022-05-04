<div>
    <div wire:ignore.self class="modal fade" id="editContact" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactLabel">Update Contact</h5>
                    <button wire:click="resetInput()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input wire:model="contactId" type="hidden" name="">
                        <input wire:model="image" type="hidden" name="">

                        <img width="150px" height="150px" src="@if ($imageNew) {{ $imageNew->temporaryUrl() }} @else {{ asset('storage/profile/' . $image) }} @endif" alt="" class="rounded-circle d-block mx-auto mb-2"
                            style="object-fit:cover">
                        <label for="imageNew" class="d-flex justify-content-center mb-3">
                            <div class="btn btn-sm btn-success">Change Photo</div>
                        </label>
                        <input wire:model="imageNew" type="file" name="" id="imageNew" class="d-none" accept="image/*">

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
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
