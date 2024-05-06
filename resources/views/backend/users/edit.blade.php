<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h4>
                Edit User
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="profile-form" id="addUserForm" method="PUT" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @include('backend.users._form') 
            </form>
        </div>
        </div>
    </div>
    </div>