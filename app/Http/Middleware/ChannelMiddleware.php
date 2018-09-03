<?php

namespace App\Http\Middleware;

use App\Channel;
use Closure;
use Illuminate\Validation\Rule;

class ChannelMiddleware
{
    protected $org;

    /**
     * Handle an incoming request.
     *
     * Validate whether:
     *  1. The channel uuid is provided
     *  2. A channel with the set uuid exists
     *  3. The channel belongs to the current organization
     *  3. The authenticated user belongs to the channel
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #get the organization
        $this->org = $request->get('organization');
        #request validation rules
        $rules = [
            'uuid' => [
                'required',
                Rule::exists('channels')->where(function ($query) {
                    $query->where('organization_id', $this->org->id);
                }),
            ]
        ];

        #validate the request
        $request->validate($rules);

        #get the channel
        $channel = Channel::whereUuid($request->get('uuid'))->first();

        #check if the user belongs to the channel
        if (\Auth::user()->channels()->where('id', $channel->id)->count() > 0) {
            $request->merge(['channel' => $channel]);
            return $next($request);
        }

        #return forbidden if the user is not a member of the channel
        return response(transformErrors('You are not a member of this channel'), 403);
    }
}
