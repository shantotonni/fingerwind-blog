
<div id="ht-inquiry-contact-container">
    <div class="form-horizontal" role="form">
        <fieldset>
                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('first_name', 'First Name ') !!}<span class="required"> * </span>
                                {!! Form::text('first_name',Input::old('first_name'),['id'=>'first_name','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter First Name']) !!}
                            </div>
                            @if ($errors->has('first_name'))
                                <div class="error" style="color: red">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('last_name', 'Last Name ') !!}<span class="required"> * </span>
                                {!! Form::text('last_name',Input::old('last_name'),['id'=>'last_name','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Last Name']) !!}
                            </div>
                            @if ($errors->has('title'))
                                <div class="error" style="color: red">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('email', 'Email ') !!}<span class="required"> * </span>
                                {!! Form::text('email',Input::old('email'),['id'=>'email','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Email']) !!}
                            </div>
                            @if ($errors->has('email'))
                                <div class="error" style="color: red">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('phone', 'Phone') !!}<span class="required"> * </span>
                                {!! Form::text('phone',Input::old('phone'),['id'=>'phone','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Phone Number']) !!}
                            </div>
                            @if ($errors->has('phone'))
                                <div class="error" style="color: red">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

            <div class="row-fluid">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('address', 'Address ') !!}<span class="required"> * </span>
                            {!! Form::text('address',Input::old('address'),['id'=>'address','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Address']) !!}
                        </div>
                        @if ($errors->has('address'))
                            <div class="error" style="color: red">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            {!! Form::label('phone', 'Phone') !!}<span class="required"> * </span>
                            {!! Form::text('phone',Input::old('phone'),['id'=>'phone','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Phone Number']) !!}
                        </div>
                        @if ($errors->has('phone'))
                            <div class="error" style="color: red">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                </div>

            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')

                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('type', 'Type') !!}<span class="required"> * </span>
                                {!! Form::Select('type',array('admin'=>'Admin','editor'=>'Editor','author'=>'Author'),Input::old('type'),['id'=>'type', 'class'=>'form-control ','required'=> 'required']) !!}
                            </div>
                            @if ($errors->has('type'))
                                <div class="error" style="color: red">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('status', 'Status') !!}<span class="required"> * </span>
                                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['id'=>'status', 'class'=>'form-control ','required'=> 'required']) !!}
                            </div>
                            @if ($errors->has('status'))
                                <div class="error" style="color: red">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>

                </div>

                @endif

        </fieldset>
    </div>
</div>

<div class="pull-right">
    <button type="submit" style="margin-left: 16px" class="btn btn-primary">Submit</button>
    <a href="{!! route('user.profile') !!}" style="margin-left: 16px" class="btn btn-danger">Cancel</a>
</div>

<br>
<br>


<script type="text/javascript">

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    $('#timepicker').timepicker({
        timeFormat: 'H:i:s',

    });

    CKEDITOR.replace( 'description' );

</script>
