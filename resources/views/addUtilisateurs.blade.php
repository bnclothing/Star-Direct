<x-master title="Accueil">

    <x-slot name="main">
        <x-slot name="styles">

        </x-slot>

        <x-slot name="header">

        </x-slot>

        <x-slot name="alert">
        </x-slot>

        <form class="row g-3" method="POST" action="{{ route('StoreUser') }}">
            @csrf
            <div class="col-md-4">
                <label for="inputLastName" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="inputLastName" name="LastName" placeholder="Hilali">
            </div>
            <div class="col-md-4">
                <label for="inputFirstName" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="inputFirstName" name="FirstName" placeholder="Mohamed">
            </div>
            <div class="col-md-4">
                <label for="inputEmail" class="form-label">Email :</label>
                <input type="email" class="form-control" id="inputEmail" name="email"
                    placeholder="example@example.com">
            </div>
            <div class="col-md-4">
                <label for="inputPhone" class="form-label">Téléphone :</label>
                <input type="tel" class="form-control" id="inputPhone" name="phone" placeholder="+212 6XXX-XXX">
            </div>
            <div class="col-md-4">
                <label for="inputType" class="form-label">Type :</label>
                <select class="form-select" id="inputType" name="type">
                    <option selected disabled>Choose...</option>
                    <option value="1">Responsable</option>
                    <option value="2">Vendeur</option>
                    <option value="3">Client</option>
                    <option value="4">Fournisseur</option>
                </select>
            </div>

            <div id="additionalFields" class="col-md-12" style="display: none;">
                <!-- Additional fields will be dynamically added here -->
            </div>

            <div id="nationalityDIV" class="col-md-12" style="display: none;">
                <label for="nationality" class="form-label">Nationality :</label>
                <select class="form-select" id="nationalitySelect" name="nationality">
                    <option selected disabled>Choose...</option>
                    <option value="1">National</option>
                    <option value="2">International</option>
                </select>
            </div>

            <div id="PrimaryMagazinesDIV" class="col-md-12" style="display: none;">
                <label for="PrimaryMagazines" class="form-label">Primary Magazines :</label>
                <select class="form-select" id="PrimaryMagazinesSelect" name="PrimaryMagazines">
                </select>
            </div>

            <div id="SecondaryMagazinesDIV" class="col-md-12" style="display: none;">
                <label for="SecondaryMagazines" class="form-label">Secondary Magazines :</label>
                <select disabled multiple class="form-select" id="SecondaryMagazinesSelect" name="SecondaryMagazines">
                </select>
            </div>


            <div id="currencyDIV" class="col-md-12" style="display: none;">
                <label for="currency" class="form-label">Currency :</label>
                <select class="form-select" id="currencySelect" name="currency">

                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </form>


    </x-slot>

    <x-slot name="javascript">
        <script>
            document.getElementById('inputType').addEventListener('change', function() {
                // Get the selected option value
                var selectedValue = this.value;

                // Get the container for additional fields
                var additionalFieldsContainer = document.getElementById('additionalFields');
                var nationalityDIV = document.getElementById('nationalityDIV');
                var PrimaryMagazinesDIV = document.getElementById('PrimaryMagazinesDIV');
                var SecondaryMagazinesDIV = document.getElementById('SecondaryMagazinesDIV');
                var currencyDIV = document.getElementById('currencyDIV');
                var nationalitySelect = document.getElementById('nationalitySelect');
                var currencySelect = document.getElementById('currencySelect');

                // Clear any existing fields
                additionalFieldsContainer.innerHTML = '';
                nationalityDIV.style.display = 'none';
                PrimaryMagazinesDIV.style.display = 'none';
                SecondaryMagazinesDIV.style.display = 'none';
                currencyDIV.style.display = 'none';


                // Check the selected value and add additional fields accordingly
                if (selectedValue === '1') {
                    var MagazineWithoutResponsable = @json($MagazineWithoutResponsable);

                    // Initialize an empty string to store the options
                    var options = '<option selected disabled>Choose The Magazine for this user</option>';

                    // Iterate through the MagazineWithoutResponsable array and build the options
                    MagazineWithoutResponsable.forEach(function(magazine) {
                        options += `<option value="${magazine.id_magazine}">${magazine.magazine_name}</option>`;
                    });

                    // Add fields for Responsable
                    additionalFieldsContainer.innerHTML = `
                        <label for="MagazineResponsable" class="form-label">Magazine :</label>
                        <select class="form-select" id="MagazineResponsable" name="magazineResponsable">
                            ${options}
                        </select>
                    `;
                } else if (selectedValue === '2') {
                    var AllMagazines = @json($AllMagazines);

                    // Initialize an empty string to store the options
                    var options = '<option selected disabled>Choose One or multiple Magazines</option>';

                    // Iterate through the AllMagazines array and build the options
                    AllMagazines.forEach(function(magazine) {
                        options += `<option value="${magazine.id_magazine}">${magazine.magazine_name}</option>`;
                    });

                    // Add fields for Vendeur
                    additionalFieldsContainer.innerHTML = `
                        <label for="MagazinesVendeurs" class="form-label">Magazines :</label>
                        <select multiple class="form-select" id="MagazinesVendeurs" name="magazinesVendeurs[]">
                            ${options}
                        </select>
                    `;
                } else if (selectedValue === '3') {
                    var PrimaryMagazines = @json($PrimaryMagazines);

                    // Show the PrimaryMagazinesDIV
                    PrimaryMagazinesDIV.style.display = 'block';

                    // Initialize an empty string to store the options
                    var primaryOptions = '';

                    // Iterate through the PrimaryMagazines array and build the options
                    PrimaryMagazines.forEach(function(magazine) {
                        primaryOptions +=
                            `<option value="${magazine.id_magazine}">${magazine.magazine_name}</option>`;
                    });

                    // Add primary magazines options
                    document.getElementById('PrimaryMagazinesSelect').innerHTML = primaryOptions;

                    // Show the SecondaryMagazinesDIV
                    SecondaryMagazinesDIV.style.display = 'block';

                    // Add event listener to Primary Select for updating Secondary Select
                    document.getElementById('PrimaryMagazinesSelect').addEventListener('change', function() {
                        var primary_id = this.value;
                        var SecondaryMagazines = @json($SecondaryMagazines);
                        var secondaryOptions = '';

                        // Iterate through SecondaryMagazines array and build the options
                        SecondaryMagazines.forEach(function(magazine) {
                            if (primary_id == magazine.id_primary_magazine) {
                                secondaryOptions +=
                                    `<option selected value="${magazine.id_magazine}">${magazine.magazine_name}</option>`;
                            }
                        });

                        // Update Secondary Select with options
                        document.getElementById('SecondaryMagazinesSelect').innerHTML = secondaryOptions;
                    });

                } else if (selectedValue === '4') {
                    var AllMagazines = @json($AllMagazines);
                    var AllCurrencies = @json($AllCurrencies);

                    // Initialize an empty string to store the options
                    var MagazinesOptions = '<option selected disabled>Choose One or multiple Magazines</option>';

                    // Iterate through the AllMagazines array and build the options
                    AllMagazines.forEach(function(magazine) {
                        MagazinesOptions +=
                            `<option value="${magazine.id_magazine}">${magazine.magazine_name}</option>`;
                    });

                    // Add fields for Fournisseur
                    additionalFieldsContainer.innerHTML = `
                        <label for="MagazinesFournisseur" class="form-label">Magazines :</label>
                        <select multiple class="form-select" id="MagazinesFournisseur" name="magazinesFournisseur">
                            ${MagazinesOptions}
                        </select>
                    `;

                    // Initialize an empty string to store the options for currencies
                    var currencyOptions = '';

                    // Fill the currency options
                    AllCurrencies.forEach(function(currency) {

                        currencyOptions +=
                            `<option value="${currency.id_currency}">${currency.currency_name}</option>`;
                    });

                    // Set the currency options
                    currencySelect.innerHTML = currencyOptions;

                    // Show the currencyDIV and nationalityDIV
                    currencyDIV.style.display = 'block';
                    nationalityDIV.style.display = 'block';

                    // Check if nationality is set to 'National' and disable currency select
                    nationalitySelect.addEventListener('change', function() {
                        is_national = (nationalitySelect.value === '1') ? true : false;

                        if (is_national) {
                            currencySelect.innerHTML =`<option selected value="MAD">Moroccan Dirham</option>`;
                            currencySelect.disabled = true;
                        } else {
                            // Enable currency select if nationality is set to 'International'
                            currencySelect.disabled = false;
                        }

                    });
                }



                // Show or hide the container based on the selected value
                if (selectedValue !== '3') {
                    PrimaryMagazinesDIV.style.display = 'none';
                    SecondaryMagazinesDIV.style.display = 'none';
                }

                additionalFieldsContainer.style.display = (selectedValue !== '') ? 'block' : 'none';
            });
        </script>


    </x-slot>

</x-master>
