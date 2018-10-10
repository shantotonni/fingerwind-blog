
<div id="ht-inquiry-contact-container">
    <div class="form-horizontal" role="form">
        <fieldset>
            <div>
                <div class="row-fluid">
                    <div class="col-lg-offset-0 col-md-6">
                        <div class="form-group">
                            {!! Form::label('parent_category', 'Parent Category') !!}

                            {!! Form::Select('parent_category', $parent_options ,Input::old('parent_category'),['id'=>'parent_category', 'class'=>'form-control ']) !!}


                        </div>
                        <span class="text-danger">{!! $errors->first('status') !!}</span>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('name', 'Title ') !!}<span class="required"> * </span>
                                {!! Form::text('name',Input::old('name'),['id'=>'name','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Title','onkeyup'=>"convert_to_slug();"]) !!}
                            </div>
                            @if ($errors->has('title'))
                                <div class="error" style="color: red">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group">
                            <div class="col-xs-6">
                                {!! Form::label('image', 'Image:') !!}<span class="required"> * </span>
                                <input type="file" name="image" required>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </fieldset>
    </div>
</div>

<div class="pull-right">
    <button type="submit" style="margin-left: 16px" class="btn btn-primary">Submit</button>
    <a href="{!! route('category.index') !!}" style="margin-left: 16px" class="btn btn-danger">Cancel</a>
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
