<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Profile::truncate();

      DB::table('profiles')->insert([
        'user_id' => 1,
        'level' => 0,
        'enabled' => 1,
        'occupation' => 'Militar',
        'birthdate' => '1976-01-16',
        'city' => 'Anápolis',
        'state' => 'GO',
        'country' => 'BR',
        'site' => 'http://www.mabesi.com',
        'facebook' => 'https://www.facebook.com/plinio.mabesi',
        'twitter' => 'https://www.twitter.com/pliniomabesi',
        'description' => 'Esta é a minha descrição dizendo um pouco sobre mim.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida lorem turpis, vitae porta leo congue ut.<br> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean vitae imperdiet tortor. Donec consectetur velit eu lectus sodales pulvinar. Vestibulum at egestas ex, et accumsan quam. Suspendisse convallis diam nibh, convallis sodales eros aliquam id. Cras ut lectus eu nisi tincidunt dignissim sed eget mauris.',
        'status' => 0,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
      DB::table('profiles')->insert([
        'user_id' => 2,
        'level' => 1,
        'enabled' => 1,
        'occupation' => 'Nutricionista',
        'birthdate' => '1983-09-03',
        'city' => 'Belém',
        'state' => 'PA',
        'country' => 'BR',
        'site' => 'http://www.allimenta.com',
        'facebook' => 'https://www.facebook.com/liza.barral',
        'twitter' => 'https://www.twitter.com/lizabarral',
        'description' => 'Esta é a minha descrição dizendo um pouco sobre mim.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida lorem turpis, vitae porta leo congue ut.<br> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean vitae imperdiet tortor. Donec consectetur velit eu lectus sodales pulvinar. Vestibulum at egestas ex, et accumsan quam. Suspendisse convallis diam nibh, convallis sodales eros aliquam id. Cras ut lectus eu nisi tincidunt dignissim sed eget mauris.',
        'status' => 0,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
      DB::table('profiles')->insert([
        'user_id' => 3,
        'level' => 2,
        'enabled' => 1,
        'occupation' => 'Engenheiro Civil',
        'birthdate' => '1984-02-20',
        'city' => 'Goiânia',
        'state' => 'GO',
        'country' => 'BR',
        'site' => 'http://www.engcivil.com',
        'facebook' => 'https://www.facebook.com/eng.civil',
        'twitter' => 'https://www.twitter.com/engcivil',
        'description' => 'Esta é a minha descrição dizendo um pouco sobre mim.<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida lorem turpis, vitae porta leo congue ut.<br> Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean vitae imperdiet tortor. Donec consectetur velit eu lectus sodales pulvinar. Vestibulum at egestas ex, et accumsan quam. Suspendisse convallis diam nibh, convallis sodales eros aliquam id. Cras ut lectus eu nisi tincidunt dignissim sed eget mauris.',
        'status' => 0,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      ]);
    }
}
