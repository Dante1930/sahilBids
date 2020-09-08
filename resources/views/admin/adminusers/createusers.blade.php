@extends('admin.layouts.sidebar')
@section('content')
<style type="text/css">
    .password-visibility {
        float: right;
        margin-right: 6px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
        color: red;
    }
</style>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Admin Users</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('admin.adminuser.register') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                      <label for="name">{{ __('Name') }}</label>

                      
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="User Name ">

                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      
                  </div>
                  <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                  </div>

                  <div class="form-group password-group">
                            <label for="password">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control password-box @error('password') is-invalid @enderror" name="password" placeholder="password"  value="{{ old('password') }}" autocomplete="new-password">

    <a href="#" class="password-visibility"><i class="fa fa-eye"></i></a>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                  </div>
                  <div class="form-group password-group">
                      <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                          <input id="password-confirm" type="password" class="form-control password-box" name="password_confirmation" placeholder="Confirmation Password" autocomplete="new-password" value="{{ old('password') }}">

    <a href="#" class="password-visibility"><i class="fa fa-eye"></i></a>
                         
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          

@endsection

@section('admin-footer')
<script type="text/javascript">
$(function() {
    $('.password-group').find('.password-box').each(function(index, input) {
        var $input = $(input);
        $input.parent().find('.password-visibility').click(function() {
            var change = "";
            if ($(this).find('i').hasClass('fa-eye')) {
                $(this).find('i').removeClass('fa-eye')
                $(this).find('i').addClass('fa-eye-slash')
                change = "text";
            } else {
                $(this).find('i').removeClass('fa-eye-slash')
                $(this).find('i').addClass('fa-eye')
                change = "password";
            }
            var rep = $("<input type='" + change + "' />")
                .attr('id', $input.attr('id'))
                .attr('name', $input.attr('name'))
                .attr('class', $input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;
        }).insertAfter($input);
    });
});

</script>
@endsection