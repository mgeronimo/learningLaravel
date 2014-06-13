<?php $user = User::find($id); ?>
<form method="POST" action="{{{ (Confide::checkAction('UserController@edit')) ?: URL::to('/user/edit')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
<input   type="hidden" name="id" id="id" value="{{{ $user->id}}}">
    
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ $user->username}}}">
        </div>
         <div class="form-group">
            <label for="fname">First Name</label>
            <input class="form-control" placeholder="First name" type="text" name="fname" id="fname" value="{{{ $user->fname }}}">
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input class="form-control" placeholder="Last name" type="text" name="lname" id="lname" value="{{{ $user->lname }}}">
        </div>
        <div class="form-group">
            <label for="email">Email <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ $user->email }}}">
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>

        @if ( Session::get('error') )
            <div class="alert alert-error alert-danger">
                @if ( is_array(Session::get('error')) )
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </fieldset>
</form>
