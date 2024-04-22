<x-master title="Accueil">

    <x-slot name="main">
        <x-slot name="styles">

        </x-slot>

        <x-slot name="header">

        </x-slot>
        
        <x-slot name="alert">
            @if (session('code_exists'))
                <x-alert type="danger" text="{{ session('code_exists') }}" />
            @elseif ($errors->any())
                <x-alert type="danger" text="Fill all the fields." />
            @elseif(session('error'))
                <x-alert type="danger" text="{{ session('error') }}" />
            @endif
        </x-slot>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="form-inline " method="POST" action="{{ route('StoreMagazine') }}">
            <div class="row mb-2">
                <div class="col">
                    <label class="pr-2">Nom du Magasin: </label>
                    <input type="text" class="form-control mb-2" name="MagazineName" placeholder="Nom du Magasin"
                        style="margin-right: 10px;" value="{{ old('MagazineName') }}">
                </div>
                <div class="col">
                    <label class="pr-2">Code du Magasin: </label>
                    <input type="text" class="form-control mb-2" name="MagazineCode"
                        value="{{ old('MagazineCode') }}" placeholder="Code du Magasin" style="margin-right: 10px;">
                </div>
                <div class="col">
                    <label class="pr-2">Adresse du Magasin: </label>
                    <div class="input-group mb-2" style="margin-right: 10px;">
                        <input type="text" class="form-control"placeholder="Adresse du Magasin"
                            value="{{ old('MagazineAdress') }}" name="MagazineAdress">
                    </div>
                </div>
            </div>
            @csrf

            <div class="row mb-2">
                <div class="col">
                    <label class="pr-2">Type: </label><br>
                    <div class="form-group mb-2">
                        <select class="form-control" name="MagazineType" id="magazineType">
                            <option value="" disabled selected>Type</option>
                            <option value="1">Principale</option>
                            <option value="2">Secondaire</option>
                        </select>
                    </div>
                </div>
                <div class="col" id="primaryMagazinesSection" style="display: none;">
                    <label class="pr-2">Magasins Principaux: </label><br>
                    <div class="form-group mb-2">
                        <select class="form-control" name="PrimaryMagazine" id="primaryMagazineSelect">
                            <option value="" disabled selected></option>
                            @foreach ($magazinesPrincipaux as $magazine)
                                <option value="{{ $magazine->id_magazine }}">{{ $magazine->magazine_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div id="chargesSection" style="display: none;">
                        <h5>Charges</h5>
                        <div id="chargesContainer"></div>
                        <button type="button" class="btn btn-success" id="addChargeBtn">+ Ajouter une charge</button>
                    </div>
                </div>
            </div>

            <div class="row mb-2">

                <div class="col">
                    <div id="selectedPrimaryMagazineCharges" style="display: none;">
                        <h5> Charges du Magasin Principal: </h5>

                        <div id="primaryMagazineChargesList"></div>
                        <input type="hidden" name="selectedCharges" id="selectedChargesInput">

                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="coffreType">
                        <h5>Type de coffre:</h5>
                    </label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="coffreType" id="radioEspece"
                            value="espèce">
                        <label class="form-check-label" for="radioEspece">Espèce</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="coffreType" id="radioCheck" value="check">
                        <label class="form-check-label" for="radioCheck">Chèque</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="coffreType" id="radioBoth" value="both">
                        <label class="form-check-label" for="radioBoth">Espèce et Chèque</label>
                    </div>
                </div>
                <div class="col">
                    <div id="espèceInput" style="display: none;">
                        <label for="montantEspèce">Montant en espèce:</label>
                        <input type="number" name="montantEspèce" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div id="checkInput" style="display: none;">
                        <div id="checkFields">
                            <div class="form-group">
                                <label for="numeroChecks">Numéro de chèque:</label>
                                <input type="number" name="numeroChecks" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nomUtilisateur">Nom de l'utilisateur:</label>
                                <input type="text" name="nomUtilisateur" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="montantCheck">Montant du chèque:</label>
                                <input type="number" name="montantCheck" class="form-control">
                            </div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-success mt-2" id="addCheckBtn">Ajouter un
                            chèque</button>
                    </div>
                </div>
            </div>


            <div class="col">
                <br>
                <button type="submit" id="ajouterButton" class="btn btn-primary mb-2">Ajouter</button>
            </div>

        </form>

    </x-slot>

    <x-slot name="javascript">
        <script>
            @if (session('error'))
                var errorAlert = document.createElement("div");
                errorAlert.className = "alert alert-danger";
                errorAlert.textContent = "{{ session('error') }}";
                document.body.appendChild(errorAlert);
            @endif
            document.addEventListener("DOMContentLoaded", function() {
                var errorAlertAdded = document.querySelector(".alert.alert-danger");

                // If the error alert is not already added, add it
                if (!errorAlertAdded && "{{ session('error') }}") {
                    var errorAlert = document.createElement("div");
                    errorAlert.className = "alert alert-danger";
                    errorAlert.textContent = "{{ session('error') }}";
                    document.body.appendChild(errorAlert);
                }
                var magazineTypeSelect = document.getElementById("magazineType");
                var chargesSection = document.getElementById("chargesSection");
                var addChargeBtn = document.getElementById("addChargeBtn");
                var chargesContainer = document.getElementById("chargesContainer");

                var primaryMagazinesSection = document.getElementById("primaryMagazinesSection");
                var selectedPrimaryMagazineCharges = document.getElementById("selectedPrimaryMagazineCharges");
                var primaryMagazineChargesList = document.getElementById("primaryMagazineChargesList");
                var primaryMagazineSelect = document.getElementById("primaryMagazineSelect");
                var ajouterButton = document.getElementById("ajouterButton");

                var primaryMagazineSelectListener = function(event) {
                    console.log("Primary magazine selected"); // Debugging
                    event.preventDefault(); // Prevent form submission

                    var selectedOption = primaryMagazineSelect.options[primaryMagazineSelect.selectedIndex];
                    var primaryMagazineId = selectedOption.value;
                    console.log("Selected primary magazine ID:", primaryMagazineId);
                    if (primaryMagazineId) {
                        // Fetch charges for the selected principal magazine
                        fetch('/AddMagazines/getCharges/' + primaryMagazineId)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log("Charges data:", data); // Check the received data in the console

                                // Clear previous charges
                                primaryMagazineChargesList.innerHTML = "";

                                // Iterate over the received charges and create checkboxes
                                data.forEach(charge => {
                                    var chargeCheckbox = document.createElement("input");
                                    chargeCheckbox.type = "checkbox";
                                    chargeCheckbox.className = "form-check-input";

                                    chargeCheckbox.name = "selectedCharges[]";
                                    chargeCheckbox.value = charge.id;

                                    var chargeLabel = document.createElement("label");
                                    chargeLabel.className = "form-check-label";
                                    chargeLabel.textContent = charge.charge_name + " - " + charge
                                        .charge_amount + " DH";

                                    // Append checkbox and label to the charges list
                                    primaryMagazineChargesList.appendChild(chargeCheckbox);
                                    primaryMagazineChargesList.appendChild(chargeLabel);
                                    primaryMagazineChargesList.appendChild(document.createElement(
                                        "br"));
                                });

                                // Display the charges section
                                selectedPrimaryMagazineCharges.style.display = "block";
                            })
                            .catch(error => {
                                console.error('Error fetching charges:', error);
                            });
                    } else {
                        selectedPrimaryMagazineCharges.style.display = "none";
                        clearChargesContainer();
                    }
                };

                var chargeSelectListener = function() {
                    var selectedType = magazineTypeSelect.value;
                    if (selectedType === "1") {
                        chargesSection.style.display = "block";
                        primaryMagazinesSection.style.display = "none";
                        clearChargesContainer();
                        primaryMagazineSelect.removeEventListener("change", primaryMagazineSelectListener);
                        selectedPrimaryMagazineCharges.style.display = "none"; // Hide the charges section
                    } else if (selectedType === "2") {
                        primaryMagazinesSection.style.display = "block";
                        chargesSection.style.display = "none";
                        clearChargesContainer();
                        primaryMagazineSelect.addEventListener("change", primaryMagazineSelectListener);
                    } else {
                        chargesSection.style.display = "none";
                        chargesContainer.innerHTML = "";
                        primaryMagazineSelect.removeEventListener("change", primaryMagazineSelectListener);
                        selectedPrimaryMagazineCharges.style.display = "none"; // Hide the charges section
                    }
                };

                magazineTypeSelect.addEventListener("change", chargeSelectListener);

                var chargeIndex = 1;

                addChargeBtn.addEventListener("click", function() {
                    var chargeRow = document.createElement("div");
                    chargeRow.className = "row mb-2";

                    var col1 = document.createElement("div");
                    col1.className = "col";
                    var input1 = document.createElement("input");
                    input1.type = "text";
                    input1.className = "form-control";
                    input1.name = `charges[${chargeIndex}][charge_name]`;
                    input1.placeholder = "Nom de la charge";
                    col1.appendChild(input1);

                    var col2 = document.createElement("div");
                    col2.className = "col";
                    var input2 = document.createElement("input");
                    input2.type = "number";
                    input2.className = "form-control";
                    input2.name = `charges[${chargeIndex}][charge_amount]`;
                    input2.placeholder = "Montant de la charge";
                    col2.appendChild(input2);

                    chargeRow.appendChild(col1);
                    chargeRow.appendChild(col2);

                    chargesContainer.appendChild(chargeRow);
                    chargeIndex++;
                });

                function clearChargesContainer() {
                    chargesContainer.innerHTML = "";
                }

                // Coffre input functionality
                var coffreTypeInputs = document.querySelectorAll('input[name="coffreType"]');
                var espèceInput = document.getElementById("espèceInput");
                var checkInput = document.getElementById("checkInput");
                var checkFieldsDiv = document.getElementById("checkFields");

                coffreTypeInputs.forEach(function(input) {
                    input.addEventListener("change", function() {
                        if (this.value === "espèce") {
                            espèceInput.style.display = "block";
                            checkInput.style.display = "none";
                            clearChargesContainer();
                            // Remove all child elements from checkFieldsDiv
                            while (checkFieldsDiv.firstChild) {
                                checkFieldsDiv.removeChild(checkFieldsDiv.firstChild);
                            }
                        } else if (this.value === "check") {
                            espèceInput.style.display = "none";
                            checkInput.style.display = "block";
                            // Remove all child elements from checkFieldsDiv
                            while (checkFieldsDiv.firstChild) {
                                checkFieldsDiv.removeChild(checkFieldsDiv.firstChild);
                            }
                        } else if (this.value === "both") {
                            espèceInput.style.display = "block";
                            checkInput.style.display = "block";
                            clearChargesContainer();
                            // Remove all child elements from checkFieldsDiv
                            while (checkFieldsDiv.firstChild) {
                                checkFieldsDiv.removeChild(checkFieldsDiv.firstChild);
                            }
                        }
                    });
                });

                document.getElementById("addCheckBtn").addEventListener("click", function() {
                    var checkFieldsDiv = document.getElementById("checkFields");

                    var checkFieldsGroup = document.createElement("div");
                    checkFieldsGroup.className = "check-fields-group";

                    var numeroChecksInput = document.createElement("input");
                    numeroChecksInput.type = "number";
                    numeroChecksInput.name = "numeroChecks[]";
                    numeroChecksInput.placeholder = "Numéro de chèques";
                    numeroChecksInput.className = "form-control mb-2";

                    var numeroChecksLabel = document.createElement("label");
                    numeroChecksLabel.textContent = "Numéro de chèques:";

                    var nomUtilisateurInput = document.createElement("input");
                    nomUtilisateurInput.type = "text";
                    nomUtilisateurInput.name = "nomUtilisateur[]";
                    nomUtilisateurInput.placeholder = "Nom de l'utilisateur";
                    nomUtilisateurInput.className = "form-control mb-2";

                    var nomUtilisateurLabel = document.createElement("label");
                    nomUtilisateurLabel.textContent = "Nom de l'utilisateur:";

                    var montantCheckInput = document.createElement("input");
                    montantCheckInput.type = "number";
                    montantCheckInput.name = "montantCheck[]";
                    montantCheckInput.placeholder = "Montant du chèque";
                    montantCheckInput.className = "form-control mb-2";

                    var montantCheckLabel = document.createElement("label");
                    montantCheckLabel.textContent = "Montant du chèque:";

                    checkFieldsGroup.appendChild(numeroChecksLabel);
                    checkFieldsGroup.appendChild(numeroChecksInput);
                    checkFieldsGroup.appendChild(nomUtilisateurLabel);
                    checkFieldsGroup.appendChild(nomUtilisateurInput);
                    checkFieldsGroup.appendChild(montantCheckLabel);
                    checkFieldsGroup.appendChild(montantCheckInput);

                    checkFieldsDiv.appendChild(checkFieldsGroup);
                });

                ajouterButton.addEventListener("click", function() {
                    // Collect selected charges
                    var selectedCharges = [];
                    var selectedChargeCheckboxes = document.querySelectorAll(
                        "input[name='selectedCharges[]']:checked");
                    selectedChargeCheckboxes.forEach(function(checkbox) {
                        selectedCharges.push(checkbox.value);
                    });

                    // Add the selected charges to a hidden input field in the form
                    var selectedChargesInput = document.createElement("input");
                    selectedChargesInput.type = "hidden";
                    selectedChargesInput.name = "selectedCharges";
                    selectedChargesInput.value = JSON.stringify(selectedCharges);
                    document.querySelector("form").appendChild(selectedChargesInput);
                });
            });
        </script>
    </x-slot>
</x-master>
