<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // CATEGORIAS
        DB::table('categories')->insert([
            ['name' => 'Decoração'],
            ['name' => 'Utilitários domésticos'],
            ['name' => 'Acessórios pessoais'],
            ['name' => 'Vestuário'],
            ['name' => 'Papelaria artesanal'],
            ['name' => 'Brinquedos e itens infantis'],
            ['name' => 'Arte e peças decorativas'],
            ['name' => 'Itens religiosos/espirituais'],
            ['name' => 'Sustentáveis/reciclados'],
            ['name' => 'Personalizados'],
        ]);

        // TÉCNICAS
        DB::table('techniques')->insert([
            ['name' => 'Crochê'],
            ['name' => 'Tricô'],
            ['name' => 'Bordado'],
            ['name' => 'Costura artesanal'],
            ['name' => 'Patchwork'],
            ['name' => 'Macramê'],
            ['name' => 'Tecelagem (tear manual)'],
            ['name' => 'Pintura à mão'],
            ['name' => 'Pintura em tecido'],
            ['name' => 'Pintura em madeira'],
            ['name' => 'Escultura manual'],
            ['name' => 'Modelagem em argila'],
            ['name' => 'Cerâmica artesanal'],
            ['name' => 'Marcenaria artesanal'],
            ['name' => 'Entalhe em madeira'],
            ['name' => 'Trabalho com couro'],
            ['name' => 'Bijuteria artesanal'],
            ['name' => 'Joalheria artesanal'],
            ['name' => 'Trabalhos com resina'],
            ['name' => 'Trabalhos com vidro'],
            ['name' => 'Reciclagem artesanal'],
            ['name' => 'Colagem artesanal'],
        ]);

        // MATERIAIS
        DB::table('materials')->insert([
            ['name' => 'Algodão'],
            ['name' => 'Lã'],
            ['name' => 'Linho'],
            ['name' => 'Jeans'],
            ['name' => 'Tecido sintético'],
            ['name' => 'Madeira'],
            ['name' => 'MDF'],
            ['name' => 'Argila'],
            ['name' => 'Cerâmica'],
            ['name' => 'Vidro'],
            ['name' => 'Resina'],
            ['name' => 'Papel'],
            ['name' => 'Papel reciclado'],
            ['name' => 'Papelão'],
            ['name' => 'Couro'],
            ['name' => 'Metal'],
            ['name' => 'Alumínio'],
            ['name' => 'Ferro'],
            ['name' => 'Fios sintéticos'],
            ['name' => 'Barbante'],
            ['name' => 'Pedras naturais'],
            ['name' => 'Miçangas'],
            ['name' => 'Plástico reciclado'],
            ['name' => 'Garrafa PET'],
        ]);
    }
}
