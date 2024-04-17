<x-master title="Accueil">

    <x-slot name="main">

        <x-slot name="alert">
        </x-slot>

        <form class="row g-3">
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
                    <option selected>Choose...</option>
                    <option value="1">Responsable</option>
                    <option value="2">Vendeur</option>
                    <option value="3">Client</option>
                    <option value="4">Fournisseur</option>
                </select>
            </div>

            <div id="additionalFields" class="col-md-12" style="display: none;">
                <!-- Additional fields will be dynamically added here -->
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

                // Clear any existing fields
                additionalFieldsContainer.innerHTML = '';

                // Check the selected value and add additional fields accordingly
                if (selectedValue === '1') {
                    // Add fields for Responsable
                    additionalFieldsContainer.innerHTML = `
                <label for="inputResponsableField" class="form-label">Additional Field for Responsable :</label>
                <input type="text" class="form-control" id="inputResponsableField" name="additionalField">
            `;
                } else if (selectedValue === '2') {
                    // Add fields for Vendeur
                    additionalFieldsContainer.innerHTML = `
                <label for="inputVendeurField" class="form-label">Additional Field for Vendeur :</label>
                <input type="text" class="form-control" id="inputVendeurField" name="additionalField">
            `;
                }
                // Add other conditions for other types if needed
                // ...

                // Show or hide the container based on the selected value
                additionalFieldsContainer.style.display = (selectedValue !== '') ? 'block' : 'none';
            });
        </script>
    </x-slot>

</x-master>
