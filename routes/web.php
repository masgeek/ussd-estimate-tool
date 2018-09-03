<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;


Route::group(['middleware' => ['auth:web']], function () {

    #add middleware to check if a user has activated their accounts
    Route::group(['middleware' => ['active']], function () {
        /*
         * -------------------------------------------------------------------------------------------------
         * Handle dashboard redirects
         * -------------------------------------------------------------------------------------------------
         */
        Route::group(['middleware' => ['role:administrator|admin']], function () {

            //dashboard
            Route::get('/dashboard', array('uses' => 'Web\DashboardController@show'))->name('dash.show');

            Route::get('/user', function (Request $request) {
                return $request->user();
            });
        });

        /*
         *-------------------------------------------------------------------------------------------------
         * System admin routes
         *-------------------------------------------------------------------------------------------------
         */

        Route::group(['middleware' => ['auth:web', 'role:administrator']], function () {

            //View events
            Route::get('/event/all', array('uses' => 'Web\EventsController@show'))->name('events.show');

            //Store event
            Route::post('/event/add', array('uses' => 'Web\EventsController@add'))->name('event.add');

            //Show add events page
            Route::get('/event/add', function () {
                return view('pages.events.add');
            })->name('event.create');
            //show students
            Route::get('/students', array('uses' => 'Web\StudentsController@index'))->name('students.show');

            //Show staff
            Route::get('/staff', array('uses' => 'Web\StaffController@index'))->name('staff.show');
            Route::get('/staff/create', array('uses' => 'Web\StaffController@create'))->name('staff.create');
            Route::post('/staff/store', array('uses' => 'Web\StaffController@store'))->name('staff.store');

            //sms routes
            Route::get('/sms', array('uses' => 'Web\SmsController@show'))->name('sms.show');
            //invoices routes
            Route::get('/invoices', array('uses' => 'Web\InvoicesController@show'))->name('invoices.show');
            //invoices routes
            Route::get('/profile/school', array('uses' => 'Web\SchoolsController@show'))->name('profile.school.show');

        });


        /*
         *-------------------------------------------------------------------------------------------------
         * Super admin routes
         * Requires admin role
         * -------------------------------------------------------------------------------------------------
         */

        Route::group(['prefix' => 'admin', 'middleware' => ['auth:web', 'role:admin']], function () {

            #Show dashboard
            Route::get('/dashboard', function () {
                return redirect()->route('clients.show');
            });

            /*
             * -------------------------------------------------------------------------------------------------
             * Clients/School routes
             * -------------------------------------------------------------------------------------------------
             */
            Route::group(['prefix' => 'clients'], function () {

                #show clients page
                Route::get('/', function () {
                    return view('pages.admin.clients.index')->with(["data" => App\School::all()->sortByDesc("id")->toArray()]);
                })->name('clients.show');;

                #show add clients page
                Route::get('/add', function () {
                    return view('pages.admin.clients.add');
                })->name('client.add');

                #store new school
                Route::post('/add', array('uses' => 'Web\SchoolsController@add'))->name('client.store');
            });

            /*
             * -------------------------------------------------------------------------------------------------
             * user routes
             * -------------------------------------------------------------------------------------------------
             */
            Route::group(['prefix' => 'user'], function () {

                Route::get('/add', array('uses' => 'Web\UserController@showAddPage'))->name('user.add');
                Route::post('/add', array('uses' => 'Web\UserController@add'))->name('user.store');

            });


        });

    });

    /*
     *-------------------------------------------------------------------------------------------------
     * Account activation routes routes
     *-------------------------------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'account', 'middleware' => []], function () {

        Route::get('/resend/token', function () {
            return view('auth.activation');
        })->name('account.activation');

        Route::post('/resend/token', 'Auth\ActivationController@resend')->name('activation.account');

    });

});


/*
 * -------------------------------------------------------------------------------------------------
 * General routes
 * -------------------------------------------------------------------------------------------------
 */
Auth::routes();

Route::group(['prefix' => 'account'], function () {

    #account activation given token
    Route::get('/activate/{token}', 'Auth\ActivationController@index')->name('account.activate');

    Route::post('/activate/{token}', 'Auth\ActivationController@activate')->name('activate.account');


});

/*
 * -------------------------------------------------------------------------------------------------
 * Home
 * -------------------------------------------------------------------------------------------------
 */
Route::get('/', function () {
    return redirect('/login');
});




