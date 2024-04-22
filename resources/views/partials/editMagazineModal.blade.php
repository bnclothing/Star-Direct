<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editUserModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editUser') }}" method="POST">
                    @csrf
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id_magazine" name="id_magazine">
                    </div>
                    <div class="mb-3">
                        <label for="code_magazine" class="col-form-label">Code:</label>
                        <input type="text" class="form-control" id="code_magazine" name="code_magazine">
                    </div>
                    <div class="mb-3">
                        <label for="magazine_name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="magazine_name" name="magazine_name">
                    </div>
                    <div class="mb-3">
                        <label for="magazine_adresse" class="col-form-label">Adresse:</label>
                        <input type="text" class="form-control" id="magazine_adresse" name="magazine_adresse">
                    </div>
                    <div class="mb-3">
                        <label for="magazine_type" class="col-form-label">type:</label>
                        <input disabled type="text" class="form-control" id="magazine_type" name="magazine_type">
                    </div>
                    <div class="mb-3">
                        <label for="responsable" class="col-form-label">type:</label>
                        <select class="form-control" name="responsable" id="responsable">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="col-form-label">Status:</label>
                        <select class="form-control" name="is_active" id="is_active">
                        </select>
                    </div>

                    {{-- Primary Magazine Case --}}
                    <div class="mb-3" id="CurrentSecondaryMagazinesDIV" style="display: none;">
                        <label for="CurrentSecondaryMagazines" class="col-form-label">Magazine:</label>
                        <select multiple disabled type="text" class="form-control" id="CurrentSecondaryMagazines" name="CurrentSecondaryMagazines[]">

                        </select>
                    </div>

                    <div class="mb-3" id="NewSecondaryMagazinesDIV" style="display: none;">
                        <label for="NewSecondaryMagazines" class="col-form-label">Magazine:</label>
                        <select multiple disabled type="text" class="form-control" id="NewSecondaryMagazines" name="NewSecondaryMagazines[]">

                        </select>
                    </div>

                    {{-- Secondary Magazine Case --}}
                    <div class="mb-3" id="PrimaryMagazinDIV" style="display: none;">
                        <label for="PrimaryMagazine" class="col-form-label">Magazine:</label>
                        <input disabled type="text" class="form-control" id="PrimaryMagazine" name="PrimaryMagazine">
                    </div>

                    {{-- Vendeur Case --}}
                    <div class="mb-3" id="CurrentMagazines_SellerDIV" style="display: none;">
                        <label for="CurrentMagazin_Seller" class="col-form-label">Old Magazines:</label>
                        <select multiple disabled class="form-control" name="CurrentMagazin_SellerSelect[]" id="CurrentMagazin_SellerSelect">

                        </select>
                    </div>

                    <div class="mb-3" id="NewMagazines_SellerDIV" style="display: none;">
                        <label for="NewMagazin_Seller" class="col-form-label">New Magazines:</label>
                        <select multiple class="form-control" name="NewMagazin_SellerSelect[]" id="NewMagazin_SellerSelect">

                        </select>
                    </div>

                    {{-- Client Case --}}
                    <div class="mb-3" id="CurrentMagazines_ClientDIV" style="display: none;">
                        <label for="CurrentMagazin_Client" class="col-form-label">Current Magazines:</label>
                        <select multiple disabled class="form-control" name="CurrentMagazin_ClientSelect[]" id="CurrentMagazin_ClientSelect">

                        </select>
                    </div>

                    <div class="mb-3" id="NewMagazines_ClientDIV" style="display: none;">
                        <label for="NewMagazin_Client" class="col-form-label">New Magazines:</label>
                        <select multiple class="form-control" name="NewMagazin_ClientSelect[]" id="NewMagazin_ClientSelect">

                        </select>
                    </div>

                    {{-- Fournisseur Case --}}
                    <div class="mb-3" id="CurrentMagazines_SupplierDIV" style="display: none;">
                        <label for="CurrentMagazines_Supplier" class="col-form-label">Old Magazines:</label>
                        <select multiple disabled class="form-control" name="CurrentMagazines_SupplierSelect[]" id="CurrentMagazines_SupplierSelect">
                        </select>
                    </div>

                    <div class="mb-3" id="NewMagazines_SupplierDIV" style="display: none;">
                        <label for="NewMagazines_Supplier" class="col-form-label">New Magazines:</label>
                        <select multiple class="form-control" name="NewMagazines_SupplierSelect[]" id="NewMagazines_SupplierSelect">
                        </select>
                    </div>

                    <div class="mb-3" id="Currency_SupplierDIV" style="display: none;">
                        <label for="Currency_Supplier" class="col-form-label">Currency:</label>
                        <select class="form-control" name="Currency_SupplierSelect" id="Currency_SupplierSelect">
                        </select>
                    </div>

                    <div class="mb-3" id="Nationality_SupplierDIV" style="display: none;">
                        <label for="Nationality_Supplier" class="col-form-label">Nationality:</label>
                        <select class="form-control" name="Nationality_SupplierSelect" id="Nationality_SupplierSelect">
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
