<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Configuration::truncate();
      factory(App\Configuration::class)->create(['name' => 'HELP_USER_PANEL','value' => 'Ajuda para Painel do Usuário']);
      factory(App\Configuration::class)->create(['name' => 'HELP_PROFILE','value' => 'Ajuda para Perfil e Configurações']);
      factory(App\Configuration::class)->create(['name' => 'HELP_INDICATOR','value' => 'Ajuda para Indicadores']);
      factory(App\Configuration::class)->create(['name' => 'HELP_STRATEGY','value' => 'Ajuda para Estratégias']);
      factory(App\Configuration::class)->create(['name' => 'HELP_OPERATION','value' => 'Ajuda para Operações']);
      factory(App\Configuration::class)->create(['name' => 'OPERATION_RULES','value' => 'Regras para Registro de Operações']);
      factory(App\Configuration::class)->create(['name' => 'STRATEGY_RULES','value' => 'Regras para Definição de Estratégias']);
      factory(App\Configuration::class)->create(['name' => 'MAX_HOURLY_COMMENTS','value' => '60']);
      factory(App\Configuration::class)->create(['name' => 'MAX_DAILY_COMMENTS','value' => '1000']);
      factory(App\Configuration::class)->create(['name' => 'MAX_OPEN_REPORTS','value' => '10']);
      factory(App\Configuration::class)->create(['name' => 'MAX_REPORTS_SENT','value' => '50']);
      factory(App\Configuration::class)->create(['name' => 'STOCKS_RENTAL_RATE','value' => '20.00']);
      factory(App\Configuration::class)->create(['name' => 'BROKERAGE_FEE','value' => '10.00']);
      factory(App\Configuration::class, 15)->create();
    }
}
