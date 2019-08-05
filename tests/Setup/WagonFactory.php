<?php

namespace Tests\Setup;


use App\User;
use App\Wagon;

class WagonFactory
{
    protected $creator = null;

    public function createdBy($creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Wagon
     */
    public function create()
    {
        return factory(Wagon::class)->create([
            'creator_id' => $this->creator ?? factory(User::class)
        ]);
    }
}