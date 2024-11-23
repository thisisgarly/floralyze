<div class="d-flex">
    <a href="{{ route('role.edit', Crypt::encrypt($uuid)) }}" class="ml-2 btn btn-warning">
        <span class="fas fa-edit"></span>
    </a>

    <a href="{{ route('role.destroy', Crypt::encrypt($uuid)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
        <span class="fas fa-trash"></span>
    </a>
</div>