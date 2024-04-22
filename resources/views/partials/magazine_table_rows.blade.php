@foreach ($AllMagazines as $magazine)
    <tr>
        <td>{{ $magazine->code_magazine }}</td>
        <td>{{ $magazine->magazine_name }}</td>
        <td>{{ $magazine->magazine_adresse }}</td>
        <td>{{ $magazine->magazine_type == 1 ? 'Primaire' : 'Secondaire' }}</td>
        <td>
            @if ($magazine->magazine_type == 2)
                @php
                    $PrimaryMagazine = \App\Models\Magazine::where('id_magazine', $magazine->id_primary_magazine)->first();
                @endphp
                @if ($PrimaryMagazine)
                    {{ $PrimaryMagazine->id_magazine }}
                @endif
            @endif
        </td>
        <td>
            @if ($magazine->is_active == 1)
                Active
            @else
                Unactive
            @endif
        </td>
        <td>
            @php
                $responsable = \App\Models\User::where('user_id', $magazine->responsable_id)->first();
            @endphp
            @if ($responsable)
                {{ $responsable->name }}
            @endif
        </td>
        <td style="width: 150px;">
            <button type="button" class="btn btn-success editMagazineBtn" data-bs-toggle="modal"
                data-bs-target="#editMagazineModal" data-magazine-id="{{ $magazine->id_magazine }}" data-magazine-type="{{ $magazine->magazine_type }}">
                <i class="las la-edit"></i>
            </button>
            <button type="button" class="btn btn-danger deleteMagazineBtn"
                 data-magazine-id="{{ $magazine->id_magazine }}" data-magazine-type="{{ $magazine->magazine_type }}">
                <i class="las la-times"></i>
            </button>

        </td>
    </tr>
@endforeach
