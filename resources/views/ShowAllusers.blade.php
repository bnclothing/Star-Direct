<x-master title="Users">

    <x-slot name="styles">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet"
            href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </x-slot>

    <x-slot name="alert"></x-slot>

    <x-slot name="header"></x-slot>

    <x-slot name="main">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-JWz5RqOoX1uwIFoW5iZro0LfTefFJwlRkNp0idmD0Gq5gI/SP6WHJNlgWbqGDOeD" crossorigin="anonymous"></script>

        
    </x-slot>
</x-master>
