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
        $users = factory(App\User::class, 10)->create();

        $users->each(function ($user) {
            factory(App\Note::class, 2)->create(['user_id' => $user->id]);
        });

        $agendas = factory(App\Agenda::class, 3)->create();

        $agendas->each(function ($agenda) {
            factory(App\Discussion::class, 2)->create(['agenda_id' => $agenda->id]);
            factory(App\Followup::class, 2)->create(['agenda_id' => $agenda->id]);
        });

        factory(App\Followup::class, 2)->create()->each(function ($followup) {
            $followup->users()->saveMany(factory(App\User::class, 2)->make());
        });

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->followups()->saveMany(factory(App\Followup::class, 2)->make());
        });

        factory(App\Agenda::class, 2)->create()->each(function ($agenda) {
            $agenda->users()->saveMany(factory(App\User::class, 2)->make());
        });

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->agendas()->saveMany(factory(App\Agenda::class, 2)->make());
        });

        factory(App\Meetingseries::class, 2)->create()->each(function ($meetingseries) {
            $meetingseries->users()->saveMany(factory(App\User::class, 2)->make());
        });

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->meetingseries()->saveMany(factory(App\Meetingseries::class, 2)->make());
        });

        factory(App\Meeting::class, 2)->create();

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->meetings()->saveMany(factory(App\Meeting::class, 2)->make());
        });
    }
}
