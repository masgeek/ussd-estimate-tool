<?php

namespace App\Http\Middleware;

use App\Organization;
use Closure;

class CheckOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $isMember
     * @return mixed
     */
    public function handle($request, Closure $next, $isMember)
    {
        #get the header
        $org = $request->headers->get('Organization');
        #verify that the header was set
        if ($org) {

            #Find the corresponding organization
            $organization = Organization::where('uuid', $org)->first();

            #verify that an organization exists
            if ($organization) {

                #make organization available via the request
                $request->merge(['organization'=>$organization]);

                if($isMember === 'member')
                    return $next($request);

                #check that the authenticated user belongs to that organization
                if ($organization->users()->find(\Auth::user()->id)) {

                    #proceed with the request
                    return $next($request);

                } else {

                    #error response if the user does not belong to the organisation
                    return response(transformErrors('The user is not registered to this organization.'), 417);
                }
            }

            #error response if the organization does not exist
            return response(transformErrors('The organization does not exist.'), 417);

        } else {

            #error response if the header is not set
            return response(transformErrors('The required organization header is missing.'), 417);
        }

    }
}
