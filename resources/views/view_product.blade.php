<div>
   
            <div>
                <h3 style="font-size:1em;">Produits de la table numéro {{$record->panier->table}}</h1>
            </div>
    
    <div style=" display:flex; justify-content:center; align-items:center">

        <style>
            table{
                border-collapse: collapse;
                width: 100%;
            }
            .l,.m{
                border: 1px solid black;
                padding: 10px;
            }
            .l{
                background-color: gray;
            }
        </style>
        
        
            <table style="">
                <thead>
                    <tr>
                        <th class="l">Nom</th>
                        <th class="l">Quantité</th>
                    </tr>
        
                    <tbody>
                        @foreach ($record->panier->propas as $propa)
                     
                            <tr>
                                <td class="m">{{$propa->produit->nom}}</td>
                                <td class="m">{{$propa->qte}}</td>
                           
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>


    </div>
</div>