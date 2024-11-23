<div class="d-flex">
    <a href="{{ route('user.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
        <span class="fas fa-edit"></span>
    </a>

    <a href="{{ route('user.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
        <span class="fas fa-trash"></span>
    </a>
</div>