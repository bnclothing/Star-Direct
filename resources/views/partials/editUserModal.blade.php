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
                        <input type="text" class="form-control" id="user_id" name="user_id">
                    </div>
                    <div class="mb-3">
                        <label for="user_name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="user_name" name="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="user_email" name="user_email">
                    </div>
                    <div class="mb-3">
                        <label for="user_phone" class="col-form-label">Phone:</label>
                        <input type="tel" class="form-control" id="user_phone" name="user_phone">
                    </div>
                    <div class="mb-3">
                        <label for="user_type" class="col-form-label">type:</label>
                        <input disabled type="tel" class="form-control" id="user_type" name="user_type">
                    </div>

                    {{-- Resposable Case --}}
                    <div class="mb-3" id="Magazin_ResponsableDIV" style="display: none;">
                        <label for="Magazin_Responsable" class="col-form-label">Magazine:</label>
                        <input disabled type="text" class="form-control" id="Magazin_Responsable" name="Magazin_Responsable">
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
