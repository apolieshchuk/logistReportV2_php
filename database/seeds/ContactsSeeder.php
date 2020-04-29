<?php

use App\Contacts;
use App\Posts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DRIVERS
        $autos = DB::table('auto_old')->get();
        foreach ($autos as $auto) {
            try {
                Contacts::firstOrCreate( // TODO REMOVE TRY
                    [
                        'surname' => $auto->dr_surn,
                        'name' => $auto->dr_name,
                        'father' => $auto->dr_fath,
                        'post_id' => Posts::where('name','Водій')->first()->id,
                        'tel' => $auto->tel,
                        'license' => $auto->notes,
                    ]
                );
            } catch (Exception $e) {
                continue;
            }
        }

        // MANAGERS
        $managers = DB::table('reptable_old')
            ->select('manager')->distinct()->get();

        foreach ($managers as $manager) {
            Contacts::firstOrCreate(
                [
                    'surname' => $manager->manager,
                    'post_id' => Posts::where('name','Менеджер')->first()->id,
                ]
            );
        }
    }
}
