{{-- <form method="POST" action="" class="card-body" id="formRatesAdd" enctype="multipart/form-data">
    @csrf --}}
    <div class="modal fade" id="addCurrency" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Currency</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <label>Code</label>
                                        <input type="text"
                                            class="form-control @error('code') is-invalid @enderror"
                                            placeholder="Insert currency code" name="code">
                                        @error('code')
                                            <label id="code-error" class="text-danger pl-3"
                                                for="code">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Insert currency name" name="name">
                                        @error('name')
                                            <label id="name-error" class="text-danger pl-3"
                                                for="name">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}