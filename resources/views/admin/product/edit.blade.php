@extends('admin.layouts.sidebar')
@section('content')


            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('admin.product.update',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
              	@csrf

                <div class="card-body">
                <div class="row">
              	 <div class="col-md-6">

              <div class="form-group">
                <label for="exampleInputEmail1">Product Title</label>
                <input type="text" class="form-control @error('product_title') is-invalid @enderror" value="@if(!empty(old('product_title'))){{ old('product_title')}}@else{{ $product->title }} @endif" name="product_title" placeholder="Enter Product Title">
                                               @error('product_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>
               <div class="form-group">
                  	<label>Product Tags</label>
                  	<select class="form-control tags @error('product_tags') is-invalid @enderror" name="product_tags[]" multiple="multiple">

                  		@foreach($tags as $tag)

                  		  <option  value="{{$tag->product_tags}}" 

                          @foreach($product->tags as $productTag)

                          @if($productTag->id == $tag->id)

                          selected

                          @endif


                          @endforeach



                          >{{ $tag->product_tags}}</option>



                  		@endforeach
                  		
                  	</select>
                  	               @error('product_tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>

		                @if(old('Product_Description') != "")

                 <div class="form-group {{ $errors->has('Product_Description') ? 'has-danger' : '' }}">
                    <label for="exampleInputPassword1">Product Descriprtion</label>
		                <div class="mb-3">
		                <textarea id="editor" class="form-control editor {{ $errors->has('Product_Description') ? 'is-invalid' : '' }}" name="Product_Description"
		                placeholder="Place some text here"
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('Product_Description')}}</textarea>
             			   @if($errors->has('Product_Description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Product_Description') }}</strong>
                                    </span>
                                @endif		                          

		              </div>

             	</div>
@else
       <div class="form-group {{ $errors->has('Product_Description') ? 'has-danger' : '' }}">
        <label for="exampleInputPassword1">Product Descriprtion</label>
            <div class="mb-3">
            <textarea id="editor" class="form-control editor {{ $errors->has('Product_Description') ? 'is-invalid' : '' }}" name="Product_Description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->description }}</textarea>
 			   @if($errors->has('Product_Description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Product_Description') }}</strong>
                        </span>
                    @endif		                          

          </div>

 	</div>

@endif

             					    <div class="form-group">
				      <label for="exampleInputFile">File input</label>
				      <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" onchange="readURL(this);">
				       <img src="{{ asset('/storage/images/'.$product->image) }}" id="image" height="200"
				         width="300">
				                 @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
				   
				    </div>
				    		 <div class="form-group">
						      <label for="exampleSelect1">Layouts</label>
						      <select class="form-control @error('layouts') is-invalid @enderror" name="layouts" >
						        <option value="">Select a Layout</option>
						        @foreach($layouts as $layout)
						        @if($layout->id == old('layouts'))

						          <option value="{{ old('layouts') }}" selected>{{ $layout->layouts_name}}</option>
						        @elseif($layout->id == $product->layout_id)
						          <option value="{{ $product->layout_id }}" selected>{{ $layout->layouts_name}}</option>						        
						        @else

						          <option value="{{ $layout->id }}">{{ $layout->layouts_name}}</option>
						        @endif



						        @endforeach

						       
						      </select>

						         @error('layouts')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
						    </div>

						    <div class="form-group">
						      <label for="exampleSelect1">Theme</label>
						      <select class="form-control @error('theme') is-invalid @enderror" name="theme">
						        <option value="">Select a Theme</option>
						        @foreach($themes as $theme)
					            @if($theme->id == old('theme'))

						          <option value="{{ old('theme') }}" selected>{{ $theme->theme_name}}</option>
						        @elseif($theme->id == $product->theme_id)

						            <option value="{{$product->theme_id}}" selected>{{ $theme->theme_name }}</option>
						        @else
						          <option value="{{ $theme->id }}">{{ $theme->theme_name}}</option>

						        @endif



						        @endforeach
						        
						      </select>
						         @error('theme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
						    </div>


                </div>
                    <div class="col-md-6">

		                @if(old('Shipping_Details') != "")

                 <div class="form-group {{ $errors->has('Shipping_Details') ? 'has-danger' : '' }}">
                    <label for="exampleInputPassword1">Shipping Details</label>
		                <div class="mb-3">
		                <textarea id="editor_2" class="form-control editor {{ $errors->has('Shipping_Details') ? 'is-invalid' : '' }}" name="Shipping_Details"
		                placeholder="Place some text here"
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('Shipping_Details')}}</textarea>
             			   @if($errors->has('Shipping_Details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Shipping_Details') }}</strong>
                                    </span>
                                @endif		                          

		              </div>

             	</div>
@else
       <div class="form-group {{ $errors->has('Shipping_Details') ? 'has-danger' : '' }}">
        <label for="exampleInputPassword1">Shipping Details</label>
            <div class="mb-3">
            <textarea id="editor__1" class="form-control editor {{ $errors->has('Shipping_Details') ? 'is-invalid' : '' }}" name="Shipping_Details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->shipping_details }}</textarea>
 			   @if($errors->has('Shipping_Details'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Shipping_Details') }}</strong>
                        </span>
                    @endif		                          

          </div>

 	</div>

@endif
		                @if(old('Payment_Details') != "")

                 <div class="form-group {{ $errors->has('Payment_Details') ? 'has-danger' : '' }}">
                    <label for="exampleInputPassword1">Shipping Details</label>
		                <div class="mb-3">
		                <textarea id="editor_Payment_Details" class="form-control editor {{ $errors->has('Payment_Details') ? 'is-invalid' : '' }}" name="Payment_Details"
		                placeholder="Place some text here"
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('Payment_Details')}}</textarea>
             			   @if($errors->has('Payment_Details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Payment_Details') }}</strong>
                                    </span>
                                @endif		                          

		              </div>

             	</div>
@else
       <div class="form-group {{ $errors->has('Payment_Details') ? 'has-danger' : '' }}">
        <label for="exampleInputPassword1">Payment Details</label>
            <div class="mb-3">
            <textarea id="editor_Payment_Details_2" class="form-control editor {{ $errors->has('Payment_Details') ? 'is-invalid' : '' }}" name="Payment_Details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->payment_details }}</textarea>
 			   @if($errors->has('Payment_Details'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Payment_Details') }}</strong>
                        </span>
                    @endif		                          

          </div>

 	</div>

@endif						   
		                @if(old('Return_Policy') != "")

                 <div class="form-group {{ $errors->has('Return_Policy') ? 'has-danger' : '' }}">
                    <label for="exampleInputPassword1">Return Policy</label>
		                <div class="mb-3">
		                <textarea id="editor_Return_Policy" class="form-control editor {{ $errors->has('Return_Policy') ? 'is-invalid' : '' }}" name="Return_Policy"
		                placeholder="Place some text here"
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('Return_Policy')}}</textarea>
             			   @if($errors->has('Return_Policy'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Return_Policy') }}</strong>
                                    </span>
                                @endif		                          

		              </div>

             	</div>
@else
       <div class="form-group {{ $errors->has('Return_Policy') ? 'has-danger' : '' }}">
        <label for="exampleInputPassword1">Return Policy</label>
            <div class="mb-3">
            <textarea id="editor_Return_Policy_2" class="form-control editor {{ $errors->has('Return_Policy') ? 'is-invalid' : '' }}" name="Return_Policy" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->return_policy }}</textarea>
 			   @if($errors->has('Return_Policy'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Return_Policy') }}</strong>
                        </span>
                    @endif		                          

          </div>

 	</div>

@endif	
		                @if(old('Additional_Details') != "")

                 <div class="form-group {{ $errors->has('Additional_Details') ? 'has-danger' : '' }}">
                    <label for="exampleInputPassword1">Additional Details</label>
		                <div class="mb-3">
		                <textarea id="editor_Additional_Details" class="form-control editor {{ $errors->has('Additional_Details') ? 'is-invalid' : '' }}" name="Additional_Details"
		                placeholder="Place some text here"
		                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('Additional_Details')}}</textarea>
             			   @if($errors->has('Return_Policy'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Additional_Details') }}</strong>
                                    </span>
                                @endif		                          

		              </div>

             	</div>
@else
       <div class="form-group {{ $errors->has('Additional_Details') ? 'has-danger' : '' }}">
        <label for="exampleInputPassword1">Additional Details</label>
            <div class="mb-3">
            <textarea id="editor_Additional_Details_2" class="form-control editor {{ $errors->has('Additional_Details') ? 'is-invalid' : '' }}" name="Additional_Details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $product->additional_details  }}</textarea>
 			   @if($errors->has('Additional_Details'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Additional_Details') }}</strong>
                        </span>
                    @endif		                          

          </div>

 	</div>

@endif




                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

              </form>
            </div>

@endsection

@section('admin-footer')
<script type="text/javascript">
function readURL(input){
        if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#image').attr('src', e.target.result);

          };
          reader.readAsDataURL(input.files[0]);
        }
      }
</script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
//CKEDITOR.replace( 'editor' );

$( 'textarea.editor').each( function() {

    CKEDITOR.replace( $(this).attr('id'),
    	{
	toolbar: [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    { name: 'others', items: [ '-' ] },
    { name: 'about', items: [ 'About' ] }
]
}

     );

CKEDITOR.config.height = 75;        // 500 pixels.
//CKEDITOR.config.height = '25em';     // CSS length.


});



</script>

<script type="text/javascript">
	$(".tags").select2({
    tags: true,
})
</script>

@endsection