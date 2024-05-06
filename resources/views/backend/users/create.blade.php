<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h4>
                Add User
            </h4>
            <button type="button" class="btn-close cancel-modal"></button>
        </div>
        <div class="modal-body">
            <form class="profile-form" id="addUserForm" method="POST" action="{{route('admin.users.store')}}">
                @csrf
                @include('backend.users._form') 
            </form>
        </div>
        </div>
    </div>
</div>