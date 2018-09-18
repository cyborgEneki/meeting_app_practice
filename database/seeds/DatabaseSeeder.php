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

//        factory(App\Media::class, 10)->create();
//
//        factory(App\Venue::class, 10)->create();
//
//        factory(App\Meetingtype::class, 10)->create();
//
//        factory(App\Meetingseries::class, 10)->create();

//        factory(App\Meeting::class, 10)->create()->each(function ($meeting) {
//            $meeting->venue()->create(factory(App\Venue::class)->make());
//            $meeting->media()->create(factory(App\Media::class)->make());
//            $meeting->meetingtype()->create(factory(App\Meetingtype::class)->make());
//            $meeting->meetingseries()->create(factory(App\Meetingseries::class)->make());
//        });
//
//        factory(App\Meeting::class, 10)->create()->each(function ($venue) {
//            factory(App\Venue::class)->create(['venue_id'=> $venue->id]);
//            factory(App\Media::class)->create(['media_id'=> $media->id]);
//            factory(App\Meetingtype::class)->create(['meetingtype_id'=> $meetingtype->id]);
//            factory(App\Meetingseries::class)->create(['meetingseries_id'=> $meetingseries->id]);
//        });
//
//        factory(App\Agenda::class, 10)->create()->each(function ($agenda) {
//            $agenda->meeting()->save(factory(App\Meeting::class)->make());
//            $agenda->users()->saveMany(factory(App\User::class, 5)->make());
//        });
//
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

        factory(App\Meeting::class, 2)->create()->each(function ($meeting) {
            $meeting->users()->saveMany(factory(App\User::class, 2)->make());
        });

        factory(App\User::class, 2)->create()->each(function ($user) {
            $user->meetings()->saveMany(factory(App\Meeting::class, 2)->make());
        });
//
//        factory(App\Discussion::class, 10)->create()->each(function ($discussion) {
//            $discussion->agenda()->save(factory(App\Agenda::class)->make());
//        });
    }
}
