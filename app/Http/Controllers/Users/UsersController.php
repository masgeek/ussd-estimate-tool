<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Organization;
use App\Repository\OrganizationRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userRepository;
    private $org;

    /**
     * @param UserRepository $userRepository
     * @internal Organization $org
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $header = \request()->headers->get('Organization');
        if ($header != null)
            $this->org = Organization::whereUuid($header)->first();
    }

    public function index()
    {
        if (\Auth::check()) {
            $res = transformSuccess(null, \Auth::user()->toArray());
            return response($res, 200);
        } else {
            return response(transformErrors('Unauthenticated'), 401);
        }
    }

    public function user()
    {
        $locations = \Auth::user()->locations;
        $location = \Auth::user()->toArray();
        if (sizeof($locations) > 0) {
            $location['locations'] = $locations[0]->ward;
        } else {
            $location['locations'] = ['name' => null];
        }
        return response(transformSuccess(null, $location));
    }


    public function store(Request $request)
    {
        if ($this->userRepository->create($request->all())) {
            #store user
            $user = $this->userRepository->user;

            #Add the user to organization
            $org = $request->get('organization');
            $repo = new OrganizationRepository($org, $user->email);
            $repo->joinOrganization();

            #add the user to default channels
            $this->userRepository->inviteToDefaultChannels($org, $user->email);

            return response(transformSuccess('User added successfully', $user->toArray()), 200);
        } else {
            return response(transformErrors('Validation errors', $this->userRepository->errors), 422);
        }
    }


    public function channels()
    {
        #get a user's channels for the current organization
        return response(
            transformSuccess(null,
                \Auth::user()->channels()->where('organization_id', $this->org->id)->get()),
            200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
