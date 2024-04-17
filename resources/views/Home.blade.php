<x-master title="Accueil">

    <x-slot name="styles" >

    </x-slot>


    <x-slot name="header" >
        
    </x-slot>
    <x-slot name="main">
        <x-slot name="alert">
        </x-slot>
        
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <a href="{{ route('AddMagazines') }}" class="btn btn-primary d-block">Ajouter Magazine</a>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('AddUser') }}" class="btn btn-secondary d-block">Ajouter Utilisateur</a>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="javascript">
        <script>
        </script>
    </x-slot>


</x-master>
