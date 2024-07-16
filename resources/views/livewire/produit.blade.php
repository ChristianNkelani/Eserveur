@php
    use App\Models\SousMenu;
@endphp
<div class=" align-item-center "  x-data ="{
    // envoyer les donnee dans le composant live wire pour la commande
    envoyerData(){
        $wire.recupData(propas1)
    },
    
    validation (){
        if(this.rue.length > 0){
            if(this.numero.length > 0 && this.numero.match(/^[0-9]+$/)){
                if(this.reference.length > 0){
                    this.process = true
                }
            }
     
        }
    }
}" @click="envoyerData()">
    <div class=" h-80  border border-color-red-600 p-5 m-2 shadow-lg bg-white " >
        <div class="">
            @if (session()->has('message'))
                <div class=" border bg-red-600">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <div class=" p-2 border bg-red-600 text-center ">
            <label for="table" class=" text-2xl text-white font-bold ">Table N°</label>
            <input id="table" type="text" placeholder="" wire:model="table" class="w-14  text-red-400 text-2xl rounded-full h-10 text-center  text-red-600 font-bold border-blue-300">
        </div>
        <div class="text-red-600 text-center">
            @error('table')
                {{$message}}
            @enderror
        </div>
        <div class="grid grid-cols-4 p-1 h-20 overflow-auto border m-4 text-center">
            <template x-for="prod in propas1">
                <div  class=" ">
                {{-- Le produit avec sa description --}}
                        <span class=" font-bold text-sm" x-text="prod.nom.substr(0,5)  + prod.qte"></span>
                </div>
            </template>
            
        </div>
        <div class=" text-center my-10" x-show="open" x-transition.scale.origin.80>
            <button class="md:text-3xl mx-2 font-black  h-10 w-28 bg-green-600 px-3" wire:click="test()">Commander</button>
            <button class="md:text-3xl mx-2 font-black h-10  w-28 bg-yellow-500  px-3" @click="incrementer(prod.products_id)">Annuler</button>
        </div>

        <template x-for="prod in propas" x-transition.scale>

            <div  class="m-5 gap-2 md:gap-4 lg:gap-8  shadow-lg sm:h-28 flex  mb-5"  >
                {{-- Le produit avec sa description --}}
                <div class="flex-1 flex ">
                   
                    <div class=" col-span-2 lg:col-span-2">
                        <img :src="prod.media" alt="" class=" h-20 sm:h-28">
                        
                    </div>
                    <div class="col-span-7 p-5 lg:col-span-8 flex flex-col justify-center">
                        <h1 class="md:text-2xl font-bold text-1em" x-text="prod.nom"></h1>
                        <p class=""x-text="prod.description.substr(0,10)"></p>
                    </div>
                </div>
                <div class=" flex flex-col justify-between items-end  col-span-4">
                    
                    <div class="flex flex-col items-center gap-3 pr-8">
                        <div class="flex items-center gap-1">
                            <button class="md:text-3xl font-black border-red-900 border px-4" @click="decrementer(prod.products_id)">-</button>
                            <span class="font-bold border md:px-3 md:text-3xl" x-text="prod.qte"> </span>
                            <button class="md:text-3xl font-black border border-blue-900 px-3" @click="incrementer(prod.products_id)">+</button>
                        </div>
                        <div class="flex items-center pb-2 justify-between gap-10 text-xs">
                            <button class=" border p-2 bg-red-600 text-white text-" @click="valider(prod)" >valider</button>                            
                        </div>
                    </div>
                  
                </div>
                <button type="button" class="text-white bg-gray-100 text-center py-1 font-black cursor-pointer  md:px-3 hover:bg-red-700" @click="supprimer(prod.products_id)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 hover:text-white h-6 text-black">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>                          
                </button>
            </div>
        </template>


        <div class=" " style="margin-bottom: 12px">
            {{-- <button wire:click="test() ">commader</button> --}}
           
        </div>
        
    </div>
    <div class=" p-5 m-5 h-72 my-20  shadow-sm overflow-auto border-red-600">
        <div class="grid grid-cols-3  lg:grid-cols-3 2xl:grid-cols-4 gap-5 notre-grid" >
            @forelse ($produits as $pro)
                <div class=" bg-gray-102 shadow-lg w-20 h-24  cursor-pointer text-center"    @click="ajouter({{$pro}})">
                    <div>
                        <img class=" b-solid b- w-20 h-20" src="{{$pro->getMedia()[0]['original_url']}}" alt="">
                        
                    </div>
                    <div class=" bg-red-600">
                        <h1 class="" x-text="$pro->nom.substr(0,5)">{{substr($pro->nom,0,6)}}</h1>
                    </div>
                    @php
                        $sous_menu = SousMenu::find($pro->sous_menu_id)->nom;
                    @endphp
                    {{-- <p class="text-sm text-blue-600">{{$sous_menu}}</p> --}}
                </div>
            @empty
                <div class="flex justify-center items-center">
                    <h2>Aucun produit disponible</h2>
                </div>
            @endforelse
        </div>
    </div>

   
</div>