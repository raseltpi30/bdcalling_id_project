<form action="{{ route('country.update') }}" method="Post" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" id="name" class="form-control" name="name" required=""
                    placeholder="Country Name" value="{{ $data->name }}">
                <small id="emailHelp" class="form-text text-muted">This is your Country Name</small>
            </div>
            <div class="form-group">
                <label for="image">Country Flag :</label>
                <input type="file" id="image" class="dropify" name="image" placeholder="Country">
                <input type="hidden" name="old_image" value="{{ $data->image }}">
                <div class="preview">
                    <img style="" src="{{ asset('files/country/' . $data->image) }}" alt="{{ $data->name }}">
                </div>
                <small id="emailHelp" class="form-text text-muted">This is your Image</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Edit Country</button>
        </div>
    </div>
</form>
