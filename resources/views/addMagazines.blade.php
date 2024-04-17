<x-master title="Accueil">

    <x-slot name="main">
        <x-slot name="alert">
        </x-slot>
        <form class="form-inline " method="POST" action="{{ route('StoreMagazine') }}">
            <div class="row mb-2">
                <div class="col">
                    <label class="pr-2">Nom du Magasin: </label> 
                    <input type="text" class="form-control mb-2" name="MagazineName"
                        placeholder="Nom du Magasin" style="margin-right: 10px;">
                </div>
                <div class="col">
                    <label class="pr-2">Code du Magasin: </label> 
                    <input type="text" class="form-control mb-2" name="MagazineCode"
                        placeholder="Code du Magasin" style="margin-right: 10px;">           
                         </div>
                <div class="col">
                    <label class="pr-2">Adresse du Magasin: </label>
                    <div class="input-group mb-2"  style="margin-right: 10px;">
                        <input type="text" class="form-control"placeholder="Adresse du Magasin" name="MagazineAdress">
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
                            @foreach ($magazinesPrincipaux as $magazine)
                                <option value="{{ $magazine->id }}">{{ $magazine->magazine_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div id="chargesSection" style="display: none;">
                        <h5>Charges</h5>
                        <div id="chargesContainer">
                        </div>
                        <button type="button" class="btn btn-success" id="addChargeBtn">+ Ajouter une charge</button>
                    </div>
                   
                </div>
            </div>

            

            <div class="col">
            <br>
            <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
        </div>

        </form>
    </x-slot>

    <x-slot name="javascript">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var magazineTypeSelect = document.getElementById("magazineType");
                var chargesSection = document.getElementById("chargesSection");
                var addChargeBtn = document.getElementById("addChargeBtn");
                var chargesContainer = document.getElementById("chargesContainer");
                var primaryMagazinesSection = document.getElementById("primaryMagazinesSection");


                magazineTypeSelect.addEventListener("change", function () {
                    var selectedType = this.value;
                    if (selectedType === "1") {
                        chargesSection.style.display = "block";
                        primaryMagazinesSection.style.display = "none";
                        clearChargesContainer();

                    } else if (selectedType === "2") {
                        primaryMagazinesSection.style.display = "block";
                        chargesSection.style.display = "none";
                        clearChargesContainer();

                    }else {
                        chargesSection.style.display = "none";
                        chargesContainer.innerHTML = "";
                    }
                });

                var chargeIndex = 1;

                addChargeBtn.addEventListener("click", function () {
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
        });
    </script>
</x-slot>
</x-master>