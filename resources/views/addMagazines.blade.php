<x-master title="Accueil">

    <x-slot name="styles" >

    </x-slot>


    <x-slot name="header" >
        
    </x-slot>

    <x-slot name="main">
        <x-slot name="alert">
        </x-slot>
        <form class="form-inline d-flex align-items-center" method="POST" action="{{ route('StoreMagazine') }}">
            @csrf
            <label class="pr-2">Nom du Magasin: </label> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" class="form-control mb-2" name="MagazineName"
                style="width: 160px "placeholder="Nom du Magasin" style="margin-right: 10px;">&nbsp;&nbsp;

            <label class="pr-2">Code du Magasin: </label> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" class="form-control mb-2" name="MagazineCode"
                style="width: 160px "placeholder="Code du Magasin" style="margin-right: 10px;">&nbsp;&nbsp;


            <label class="pr-2">Adresse du Magasin: </label>&nbsp;&nbsp;&nbsp;
            <div class="input-group mb-2" style="width: 180px" style="margin-right: 10px;">
                <input type="text" class="form-control"placeholder="Adresse du Magasin" name="MagazineAdress">
            </div>

            &nbsp;&nbsp;&nbsp;&nbsp;
            <labelclass="pr-2">Type: </label>&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-group mb-2">
                &nbsp;&nbsp; &nbsp;&nbsp;
                <select class="form-control mb-4 pr-4" name="MagazineType">
                    <option value="" disabled selected>Type</option>
                    <option value="1">Principale</option>
                    <option value="2">Secondaire</option>
                </select>
            </div>
            &nbsp;&nbsp; &nbsp;&nbsp;

            <label class="pr-2">Responsable: </label>&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-group mb-2">
                &nbsp;&nbsp; &nbsp;&nbsp;
                <select class="form-control mb-4 pr-4" name="MagazineResponsable">
                    <option value="" disabled selected>Responsable</option>
                    @foreach ($usersNotResponsables as $responsable)
                        <option value="{{ $responsable->user_id }}">{{ $responsable->name }}</option>
                    @endforeach
                </select>
            </div>
            &nbsp;&nbsp; &nbsp;&nbsp;

            <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
        </form>



        {{-- <ul>
        @foreach ($magazinesPrincipaux as $magazinePrincipal)
            <li>{{ $magazinePrincipal->nom }}</li>
            <ul>
                @foreach ($magazinesSecondaires->where('principal_id', $magazinePrincipal->id) as $magazineSecondaire)
                    <li>{{ $magazineSecondaire->nom }}</li>
                @endforeach
            </ul>
        @endforeach
    </ul>
     --}}
    </x-slot>

    <x-slot name="javascript">
        <script></script>
    </x-slot>


</x-master>
