<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Session;
use App\Product_Tags;
use App\Product;
use App\Tag;
use App\Layout;
use App\Theme;
// use Carbon\Carbon;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


          $current_user_id = Auth::guard('admin')->user();


        $products = Product::where('user_id',$current_user_id->id)->get();
        

        return view('admin.product.show',compact('products'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                $tags =  Tag::all();
                $layouts = Layout::all();
                $themes = Theme::all();
      return view('admin.product.product',compact('layouts','themes','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tagscal = DB::table('tags')->select('product_tags')->get()->toArray();

        $data1 = [];

          foreach($tagscal as $tags){

            $data1[] = $tags->product_tags;

          }


          $current_user_id = Auth::guard('admin')->user();





              $this->validate($request, [
            'product_title'    =>  'required',
            'product_tags'     =>  'required',
            'Product_Description'=>'required',
            'image' =>'required',
            'layouts' =>'required',
            'theme' => 'required',
            'Shipping_Details' => 'required',
            'Payment_Details' => 'required',
            'Return_Policy' => 'required',
            'Additional_Details' => 'required'
        ]);

    $notCommonData = []; $CommonData = [];
         foreach($request->product_tags as $tag){

                if(!in_array($tag,$data1)){

                 $notCommonData[] = $tag;


                }
                if(in_array($tag,$data1)){
                    $CommonData[] = $tag;

                }



         }




              $product = new Product();

              if( $request->hasFile('image')){
                
              $imageName = time().$request->image->
              getClientOriginalName(); 
              $request->image->storeAs('images',$imageName,'public');
              $product->image = $imageName;

                

              }

             
               
             $product->title    =  $request->get('product_title');
//             $product->tags     =  $request->get('product_tags');
             $product->description = $request->get('Product_Description');
             $product->layout_id = $request->get('layouts');
             $product->theme_id = $request->get('theme');
             $product->shipping_details = $request->get('Shipping_Details');
             $product->payment_details = $request->get('Payment_Details');
             $product->return_policy = $request->get('Return_Policy');
             $product->additional_details = $request->get('Additional_Details');
             $product->user_id = $current_user_id->id;



        
                 $product->save();
                  $lastproductid = $product->id;
                  $lastdata = [];
            if($request->has('product_tags')){
                foreach ($notCommonData as $tag) {

                    $add = new Tag;
                    $add->product_tags = $tag;
                    //$add->product_id = $lastproductid;
                    $add->save();
                    $lastdata[] = $add->id;

                   

                    
                }
            }


            $newdata = DB::table('tags')
                                ->whereIn('product_tags', $CommonData)
                                ->get()->toArray();
                               
            foreach ($newdata as $value) {
                  $lastdata[] = $value->id;
            }




            
                    $attachtags = Tag::find($lastdata);
        $product->tags()->sync($attachtags);
                 Session::flash('success','Product is Successfully added');
                 return redirect()->route('admin.product');

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
        $tags = Tag::all();
        $product = Product::with('tags')->where('id',$id)->first();
        
                $layouts = Layout::all();
                $themes = Theme::all();

        return view('admin.product.edit',compact('product','layouts','themes','tags'));


        
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

//         $query = DB::connection()->getPdo()->query("select product_tags from tags");
            
// $data = $query->fetchAll(\PDO::FETCH_ASSOC);
                
// dd($data);

        $current_user_id = Auth::guard('admin')->user();;

        $tagscal = DB::table('tags')->select('product_tags')->get()->toArray();
       // $tagscal = Tag::select(['product_tags'])->get()->toArray();

       //   dd($tagscal);

          foreach($tagscal as $tags){

            $data1[] = $tags->product_tags;

          }



        
// dd($data1);
         //dd($notCommonData);  //which data is not in db only that insert  
        
        //return dd($request->all());
                $product = Product::find($id);

                //return dd($product->image);
                $layouts = Layout::all();
                $themes = Theme::all();

            $this->validate($request, [
            'product_title'    =>  'required',
            'product_tags'     =>  'required',
            'Product_Description'=>'required',
            
            'layouts' =>'required',
            'theme' => 'required',
            'Shipping_Details' => 'required',
            'Payment_Details' => 'required',
            'Return_Policy' => 'required',
            'Additional_Details' => 'required'
        ]);


         $notCommonData = [];$CommonData = [];
       
         foreach($request->product_tags as $tag){

                if(!in_array($tag,$data1)){

                 $notCommonData[] = $tag;


                }
                if(in_array($tag,$data1)){
                    $CommonData[] = $tag;

                }



         }
              if( $request->hasFile('image')){
              $imageName = time().$request->file('image')->
              getClientOriginalName();

                 if(!empty($product->image)){

                    Storage::delete('/public/images/'.$product->image);

                 }


              $request->image->storeAs('images',$imageName,'public');
              $product->image = $imageName;

                

              }


               
             
             $product->title    =  $request->get('product_title');
             //$product->tags     =  $request->get('product_tags');
             $product->description = $request->get('Product_Description');
             $product->layout_id = $request->get('layouts');
             $product->theme_id = $request->get('theme');
             $product->shipping_details = $request->get('Shipping_Details');
             $product->payment_details = $request->get('Payment_Details');
             $product->return_policy = $request->get('Return_Policy');
             $product->additional_details = $request->get('Additional_Details');
             $product->user_id = $current_user_id->id;
        
                 $product->save();
                $lastproductid = $product->id;
        

                    $lastdata =[];
            if($request->has('product_tags')){
              // return   dd($request->product_tags);
                
                foreach ($notCommonData as $tag) {

                    $add = new Tag;
                    $add->product_tags = $tag;
                    $add->save();
                    $lastdata[] = $add->id;                   

                    
                }
              }

             $newdata = DB::table('tags')
                                ->whereIn('product_tags', $CommonData)
                                ->get()->toArray();
                               
            foreach ($newdata as $value) {
                  $lastdata[] = $value->id;
            }

        $attachtags = Tag::find($lastdata);
       $product->tags()->sync($attachtags);
                Session::flash('updated','Product is Successfully updated');
                return redirect()->route('admin.product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::where('id',$id)->firstOrFail();
        Storage::delete('/public/images/'.$product->image);
        $product->tags()->detach();
        $product->delete();
        Session::flash('deleted','Product is Successfully deleted');
        return redirect()->back();
    }
}
