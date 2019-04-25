<?php

namespace Tests\Utilities;


use Illuminate\Support\Facades\DB;

class OAuthUtilities
{
    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getOAuthClient(string $name): object
    {

        return DB::table('oauth_clients')
                ->where('name', $name)
                ->first();
    }

}