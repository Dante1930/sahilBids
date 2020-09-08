<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use Session;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

        public function __construct()
    {
      //  $this->middleware('guest');
    }


    
    public function index()
    {
        $adminlist = Admin::all();
        return view('admin.adminusers.show',compact('adminlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        

        return view('admin.adminusers.createusers');
        
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'plain_password' => $data['password']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        
        $request->session()->put('plainpassword',$request->password);
        $this->validator($request->all())->validate();


        $this->create($request->all());
        Session::flash('success','Admin user is successfully created'); 
         return redirect(route('admin.adminuser'));

    }

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editadminuser = Admin::where('id',$id)->first();
        return view('admin.adminusers.edit',compact('editadminuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
          $request->session()->put('plainpassword',$request->password);
          $this->validatorupdate($request->all())->validate();

                  $this->Adminupdate($request->all(),$id);

                Session::flash('updated','Admin user is successfully updated'); 
         return redirect(route('admin.adminuser'));

        
    }
//User::where('votes', '>', 100)->update(array('status' => 2));
    protected function validatorupdate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function Adminupdate(array $data,$id)
    {
        return Admin::where('id',$id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'plain_password' => $data['password']
        ]);
    }


    public function destroy($id)
    {
        $Admin = Admin::where('id',$id)->firstOrFail();
        $Admin->delete();
        Session::flash('deleted','Admin User is Successfully deleted');
        return redirect()->back();
    }
}
