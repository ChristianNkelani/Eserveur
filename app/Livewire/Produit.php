<?php

namespace App\Livewire;

use App\Models\Commande;
use App\Models\Panier;
use App\Models\Produit as ModelsProduit;
use App\Models\ProduitPanier;
use Livewire\Component;

class Produit extends Component
{
    public $produits;
    public $propaData;
    public $table;

    public $messages = ['table.required' => 'Veuillez indiquer la table'];

    public function render()
    {
        $this->produits = ModelsProduit::all();
        return view('livewire.produit');
    }

    public function recupData($propa){
        $this->propaData = $propa;
    }

    public function test(){
        // dd($this->propaData);

        $validate = $this->validate(['table' => 'required']);
        $commande = Commande::create([
            'serveur_id' => 1,
            'etat' => 0,
        ]);

        $panier = Panier::create([
            'order_id' => $commande->id,
            'table' => $this->table
        ]);

        $propa = ProduitPanier::insert([]);
        foreach($this->propaData as $propa){
            $record = ProduitPanier::create([
                'product_id' => $propa['id'],
                'qte' => $propa['qte'],
                'panier_id' => $panier->id
            ]);
        }

        session()->flash('message','Commande enregistrée!');
    }
}
