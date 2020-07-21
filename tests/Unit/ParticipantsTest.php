<?php

namespace Tests\Unit;

use App\Http\Middleware\Authenticate;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};

class ParticipantsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $countChildren = 3;

    public function withoutMiddleware($middleware = null)
    {
        if (is_null($middleware)) {
            $this->app->instance('middleware.disable', true);

            return $this;
        }

        foreach ((array) $middleware as $abstract) {
            $this->app->instance($abstract, new class {
                public function handle($request, $next) {
                    return $next($request);
                }
            });
        }

        return $this;
    }

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
    }

    public function testParticipantsIndex()
    {
        $this->withoutMiddleware(Authenticate::class);
        $participant = factory(Participant::class,5)->create();

        $response = $this->json("GET", route('participants.index'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($participant->count(), $key = 'data');
    }

    public function testParticipantsStore()
    {
        $this->withoutMiddleware(Authenticate::class);

        $event = factory(Event::class)->create();

        $name = $this->faker->unique()->company;
        $payload = [
            'name' => $name,
            'surname' => $this->faker->firstNameFemale,
            'email' => $this->faker->unique()->email,
            'event' => $event->id,
        ];


        $response = $this->json("POST", route('participants.store'), $payload);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment([
                'name' => (string) $name
            ]);
    }

    public function testParticipantsUpdate()
    {
        $this->withoutMiddleware(Authenticate::class);

        $event = factory(Event::class)->create();

        $name = $this->faker->name;

        $this->createEntity($name);

        $participant = Participant::where('name', $name)->first();

        $newName = $this->faker->realText(20);

        $payload['name'] = $newName;
        $payload['email'] = $participant->email;
        $payload['event'] = $event->id;

        $response = $this->json("PUT", route('participants.update', $participant), $payload);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'name' => (string) $newName
            ]);
    }

    public function testParticipantsShow()
    {
        $this->withoutMiddleware(Authenticate::class);

        factory(Event::class)
            ->create()
            ->each(function ($event) {
                $event->participant()->save(factory(Participant::class)->create());
            });

        $participant = Participant::first();

        $response = $this->json("GET", route('participants.update', $participant));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'name' => (string) $participant->name
            ]);
    }


    public function testParticipantsDestroy()
    {
        $this->withoutMiddleware(Authenticate::class);

        $this->createEntity();

        $participant = Participant::first();

        $response = $this->json("DELETE", route('participants.destroy', $participant));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'success' => true,
            ]);
    }

    private function createEntity(string $name = null) :void
    {
        factory(Event::class)
            ->create()
            ->each(function ($event) use ($name) {
                if (is_null($name)) {
                    $event
                        ->participant()
                        ->save(factory(Participant::class)
                            ->create());
                } else {

                    $event
                        ->participant()
                        ->save(factory(Participant::class)
                            ->create(['name' => $name]));
                }
            });
    }
}
