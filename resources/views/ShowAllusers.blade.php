<x-master title="Users">

    <x-slot name="styles">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet"
            href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </x-slot>

    <x-slot name="alert"></x-slot>

    <x-slot name="header"></x-slot>

    <x-slot name="alert">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="danger" text="{{ $error }}" />
            @endforeach
        @elseif(session('error'))
            <x-alert type="danger" text="{{ session('error') }}" />
        @elseif(session('success'))
            <x-alert type="success" text="{{ session('success') }}" />
        @endif

    </x-slot>

    <x-slot name="main">
        @include('partials.editUserModal')

        <div class="d-flex justify-content-center mb-3">
            <p class="h1">All Users</p>
        </div>
        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th><input type="text" name="search-Name" id="search-Name" class="form-control"
                            placeholder="Name"></th>
                    <th><input type="text" name="search-Email" id="search-Email" class="form-control"
                            placeholder="Email"></th>
                    <th><input type="text" name="search-Phone" id="search-Phone" class="form-control"
                            placeholder="Phone"></th>
                    <th>
                        <select class="form-control" name="search-Type" id="search-Type">
                            <option selected value="">Type</option>
                            <option value="1">Responsable</option>
                            <option value="2">Vendeur</option>
                            <option value="3">Client</option>
                            <option value="4">Fournisseur</option>
                        </select>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @include('partials.user_table_rows', ['AllUsers' => $AllUsers])
            </tbody>
        </table>
        {{ $AllUsers->links() }}



    </x-slot>

    <x-slot name="javascript">
        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        {{-- search script --}}
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                function performSearch() {

                    let searchName = $('#search-Name').val();
                    let searchEmail = $('#search-Email').val();
                    let searchType = $('#search-Type').val();
                    let searchPhone = $('#search-Phone').val();

                    // Perform AJAX request with search parameters
                    $.ajax({
                        url: "{{ route('searchUser') }}",
                        method: 'GET',
                        data: {
                            name: searchName,
                            type: searchType,
                            email: searchEmail,
                            phone: searchPhone,
                        },
                        success: function(res) {
                            $('#table tbody').html(res); // Update table body with received data
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });

                }

                // Bind keyup event to text inputs
                $('#search-Name, #search-Email, #search-Phone').on('keyup', performSearch);

                // Bind change event to select input
                $('#search-Type').on('change', performSearch);
            });
        </script>

        {{-- edit user Modal --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to fetch user details and populate the modal
                function fetchUserDetails(userId, userType) {
                    $.ajax({
                        url: "{{ route('getUserDetails') }}",
                        method: 'GET',
                        data: {
                            userId: userId,
                            userType: userType,
                        },
                        success: function(response) {
                            var userData = response.userData;
                            // Populate modal fields with fetched user data
                            $('#user_id').val(userId);
                            $('#user_name').val(userData.name);
                            $('#user_email').val(userData.email);
                            $('#user_phone').val(userData.phone);

                            // Hide all fields by default
                            $('.user-details-field').hide();

                            if (userData.type == 1) {
                                $('#Magazin_Responsable').val(response.magazinName);
                                $('#user_type').val("Responsable");
                                $('#Magazin_ResponsableDIV').show();
                            } else if (userData.type == 2) {
                                $('#CurrentMagazin_SellerSelect').empty();
                                $('#NewMagazin_SellerSelect').empty();
                                response.magazineNames.forEach(function(magazine) {
                                    $('#CurrentMagazin_SellerSelect').append(
                                        '<option selected value="' + magazine.id_magazine +
                                        '">' + magazine.magazine_name + '</option>');
                                });
                                response.AllMagazines.forEach(function(magazine) {
                                    $('#NewMagazin_SellerSelect').append('<option value="' +
                                        magazine.id_magazine + '">' + magazine.magazine_name +
                                        '</option>');
                                });
                                $('#user_type').val("Vendeur");
                                $('#CurrentMagazines_SellerDIV, #NewMagazines_SellerDIV').show();
                            } else if (userData.type == 3) {
                                $('#CurrentMagazin_ClientSelect').empty();
                                $('#NewMagazin_ClientSelect').empty();
                                response.magazineNames.forEach(function(magazine) {
                                    $('#CurrentMagazin_ClientSelect').append(
                                        '<option selected value="' + magazine.id_magazine +
                                        '">' + magazine.magazine_name + '</option>');
                                });
                                response.AllPrimaryMagazines.forEach(function(magazine) {
                                    $('#NewMagazin_ClientSelect').append('<option value="' +
                                        magazine.id_magazine + '">' + magazine.magazine_name +
                                        '</option>');
                                });
                                $('#user_type').val("Client");
                                $('#CurrentMagazines_ClientDIV, #NewMagazines_ClientDIV').show();
                            } else if (userData.type == 4) {
                                $('#CurrentMagazines_SupplierSelect').empty();
                                $('#NewMagazines_SupplierSelect').empty();
                                response.CurrentMagazines.forEach(function(magazine) {
                                    $('#CurrentMagazines_SupplierSelect').append(
                                        '<option value="">' + magazine + '</option>');
                                });
                                response.AllMagazines.forEach(function(magazine) {
                                    $('#NewMagazines_SupplierSelect').append('<option value="' +
                                        magazine.id_magazine + '">' + magazine.magazine_name +
                                        '</option>');
                                });
                                response.AllCurrencies.forEach(function(currency) {
                                    var option = '<option value="' + currency.id_currency + '">' +
                                        currency.currency_name + '</option>';
                                    if (response.selectedCurrency.id_currency == currency
                                        .id_currency) {
                                        option = '<option selected value="' + currency.id_currency +
                                            '">' + currency.currency_name + '</option>';
                                    }
                                    $('#Currency_SupplierSelect').append(option);
                                });
                                var nationalityOptions = '';
                                if (response.IsNational) {
                                    nationalityOptions =
                                        '<option value="0">International</option> <option selected value="1">National</option>';
                                } else {
                                    nationalityOptions =
                                        '<option selected value="0">International</option> <option value="1">National</option>';
                                }
                                $('#Nationality_SupplierSelect').html(nationalityOptions);
                                $('#user_type').val("Fournisseur");
                                $('#CurrentMagazines_SupplierDIV, #NewMagazines_SupplierDIV, #Currency_SupplierDIV, #Nationality_SupplierDIV')
                                    .show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }

                // Bind click event to edit buttons
                $(document).on('click', '.editUserBtn', function() {
                    // Get the user id from the data attribute
                    let userId = $(this).data('user-id');
                    let userType = $(this).data('user-type');
                    // Fetch user details and populate the modal
                    fetchUserDetails(userId, userType);
                });
            });
        </script>


        {{-- delete user --}}
        <script>
            function deleteUser(userId, userType) {
                $.ajax({
                    url: "{{ route('deleteUser') }}",
                    method: 'GET',
                    data: {
                        userId: userId,
                        userType: userType,
                    },
                    success: function(response) {

                        window.location.href = "{{ route('Users.index') }}";
                        var IsUserDeleted = response.IsUserDeleted;
                        if (IsUserDeleted == '1') {
                            alert('User deleted successfully.');
                        } else {
                            alert('Failed to delete user.');
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Bind click event to delete buttons
            $(document).on('click', '.deleteUserBtn', function() {
                // Get the user id from the data attribute
                let userId = $(this).data('user-id');
                let userType = $(this).data('user-id');

                // Ask for confirmation
                let confirmation = confirm("Are you sure you want to delete this user?");

                // If the user confirms, proceed with the deletion
                if (confirmation) {
                    // Call the function to delete the user
                    deleteUser(userId, userType);
                }
            });
        </script>

    </x-slot>
</x-master>
