<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        factory(App\Meetingseries::class, 3)->create()->each(function($meetingseries) {
            factory(App\Meeting::class, 10)->create(['meetingseries_id' =>$meetingseries->id]);
        });

        factory(App\User::class, 40)->create()->each(function ($user) {
            factory(App\Note::class, 20)->create(['user_id' => $user->id]);
        });

        factory(App\Followup::class, 20)->create();

        factory(App\Agenda::class, 10)->create()->each(function($agenda) {
            factory(App\Discussion::class, 5)->create(['agenda_id' => $agenda->id]);
        });

        $meetings = App\Meeting::all();

        App\User::all()->each(function ($user) use ($meetings) {
            $user->meetings()->attach(
                $meetings->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $agendas = App\Agenda::all();

        App\User::all()->each(function ($user) use ($agendas) {
            $user->agendas()->attach(
                $agendas->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $followups = App\Followup::all();

        App\User::all()->each(function ($user) use ($followups) {
            $user->followups()->attach(
                $followups->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $meetingseries = App\Meetingseries::all();

        App\User::all()->each(function ($user) use ($meetingseries) {
            $user->meetingseries()->attach(
                $meetingseries->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
