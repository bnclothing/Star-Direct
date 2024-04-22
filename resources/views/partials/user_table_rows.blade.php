@foreach ($AllUsers as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>
            @if ($user->type == 1)
                Responsable
            @elseif($user->type == 2)
                Vendeur
            @elseif($user->type == 3)
                Client
            @elseif($user->type == 4)
                Fournisseur
            @endif
        </td>
        <td style="width: 150px;">
            <button type="button" class="btn btn-success editUserBtn" data-bs-toggle="modal"
                data-bs-target="#editUserModal" data-user-id="{{ $user->user_id }}" data-user-type="{{ $user->type }}">
                <i class="las la-edit"></i>
            </button>
            <button type="button" class="btn btn-danger deleteUserBtn"
                 data-user-id="{{ $user->user_id }}" data-user-type="{{ $user->type }}">
                <i class="las la-times"></i>
            </button>

        </td>
    </tr>
@endforeach