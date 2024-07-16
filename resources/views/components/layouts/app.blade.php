<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body x-data="{
        init(){
            // panier
            this.propas = JSON.parse(localStorage.getItem('cart')) ?? [];
            this.propas1 = JSON.parse(localStorage.getItem('cart1')) ?? [];
            this.c = this.propas.length;
            this.propas1 = []
            this.propas =  [];
            this.open = true;


        
        },
        c : 0,
        propas : [],
        propas1 : [],
        prodExiste : false,
        saveCart(){
            localStorage.setItem('cart',JSON.stringify(this.propas));
        },
        saveCart1(){
            localStorage.setItem('cart1',JSON.stringify(this.propas1));
        },
        ajouter(prod){
            this.open = false;
            
            if(this.propas.length > 0){
                const index = this.propas.findIndex((objet)=> objet.products_id == prod.id);
                this.propas.splice(index, 1);
                console.log('produit supprimer')
                this.prodExiste = false;
                     
            }

            if(this.prodExiste == false){
                this.propas.push({
                    'products_id':prod.id,
                    'orders_id':null,
                    'qte':1,
                    'nom': prod.nom,
                    'id': prod.id
                });
                console.log('reussi, produit ajoute');
            } else {
                const index = this.propas.findIndex((objet)=> objet.products_id == prod.id);
                this.propas.splice(index, 1);
                console.log('produit supprimer')
                this.prodExiste = false;
            }

            this.saveCart();
            this.c = this.propas.length;
        },

         valider(prod){
            this.open = true;
            this.propas1.push({
                    'products_id':prod.id,
                    'orders_id':null,
                    'qte':prod.qte,
                    'nom': prod.nom,
                    'id': prod.id
            });
            this.saveCart1();
            this.supprimer(prod.id);
        },

        incrementer(id){
            let index = this.propas.findIndex((objet)=>objet.products_id == id);
            this.propas[index].qte ++;
            this.saveCart();

        },
        decrementer(id){
            let index = this.propas.findIndex((objet)=>objet.products_id == id);
            if (this.propas[index].qte > 1) this.propas[index].qte --;
            this.saveCart();
        },
        supprimer(id){
            this.open = true;

            let index = this.propas.findIndex((objet)=>objet.products_id == id);
            this.propas.splice(index, 1);
            this.saveCart();
            this.c --;

            
        },

        supprimer1(id){
            let index = this.propas1.findIndex((objet)=>objet.products_id == id);
            this.propas1.splice(index, 1);
            this.saveCart1();
            this.c --;

            
        },

       
        
        
        nombrefav : 0,
        favExiste : false,
        profas : [],
    }" x-init="init()" class=" bg-gray-200">
        {{ $slot }}
    </body>
</html>
