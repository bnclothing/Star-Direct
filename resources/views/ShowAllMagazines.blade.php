<x-master title="Magazines">

    <x-slot name="styles">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </x-slot>

    <x-slot name="alert"></x-slot>

    <x-slot name="header"></x-slot>

    <x-slot name="main">
        <div class="d-flex justify-content-center mb-3">
            <p class="h1">All Magazines</p>
        </div>

        <table class="table table-striped" id="table">
            <thead>
                <tr>
                    <th><input type="text" name="search-Code" id="search-Code" class="form-control" placeholder="code"></th>
                    <th><input type="text" name="search-Name" id="search-Name" class="form-control" placeholder="Name"></th>
                    <th><input type="text" name="search-Adresse" id="search-Adresse" class="form-control" placeholder="Adresse"></th>
                    <th>
                        <select class="form-control" name="search-Type" id="search-Type">
                            <option selected value="">Type</option>
                            <option value="1">Primaire</option>
                            <option value="2">Secondaire</option>
                        </select>
                    </th>
                    <th><input type="text" name="search-MagazinePrimaire" id="search-MagazinePrimaire" class="form-control" placeholder="Magazine Primaire"></th>
                    <th>
                        <select class="form-control" name="search-Status" id="search-Status">
                            <option selected value="">Status</option>
                            <option value="1">Active</option>
                            <option value="0">Unactive</option>
                        </select>
                    </th>
                    <th><input type="text" name="search-Responsable" id="search-Responsable" class="form-control" placeholder="Responsable"></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @include('partials.magazine_table_rows', ['AllMagazines' => $AllMagazines])
            </tbody>
        </table>
        {{ $AllMagazines->links() }}
    </x-slot>

    <x-slot name="javascript">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                function performSearch() {
                    let searchCode = $('#search-Code').val();
                    let searchName = $('#search-Name').val();
                    let searchAdresse = $('#search-Adresse').val();
                    let searchType = $('#search-Type').val();
                    let searchStatus = $('#search-Status').val();
                    let searchMagazinePrimaire = $('#search-MagazinePrimaire').val();
                    let searchResponsable = $('#search-Responsable').val();

                    // Perform AJAX request with search parameters
                    $.ajax({
                        url: "{{ route('searchMagazine') }}",
                        method: 'GET',
                        data: {
                            code: searchCode,
                            name: searchName,
                            type: searchType,
                            adresse: searchAdresse,
                            status: searchStatus,
                            magazinePrimaire: searchMagazinePrimaire,
                            responsable: searchResponsable
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
                $('#search-Code, #search-Name, #search-Adresse, #search-MagazinePrimaire, #search-Responsable').on('keyup', performSearch);

                // Bind change event to select input
                $('#search-Status, #search-Type').on('change', performSearch);
            });
        </script>
    </x-slot>
</x-master>
