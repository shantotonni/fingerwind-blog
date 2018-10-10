
<div id="ht-inquiry-contact-container">
    <div class="form-horizontal" role="form">
        <fieldset>
            <div>
                <div class="row-fluid">

                    <div class="col-xs-12 col-sm-6">
                        {!! Form::label('category_id', 'Category ') !!}<span class="required"> * </span>
                        <select required name="category_id" class="form-control" >
                            <option value="">Select Category</option>
                            @foreach($category as $value)
                                @if($article->category_id == $value->id)
                                <option value="{!! $value->id !!}" selected>{!! $value->name !!}</option>
                                @else
                                    <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('title', 'Title ') !!}<span class="required"> * </span>
                                {!! Form::text('title',Input::old('title'),['id'=>'title','class' => 'form-control','required'=> 'required','Placeholder'=>'Enter Title','onkeyup'=>"convert_to_slug();"]) !!}
                            </div>
                            @if ($errors->has('title'))
                                <div class="error" style="color: red">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>


                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-12">
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('description', 'Description:') !!}<span class="required"> * </span>
                                {!! Form::textarea('description',Input::old('description'),['id'=>'description','class' => 'form-control description','required'=> 'required','Placeholder'=>'Enter Description']) !!}
                            </div>
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
           </div>
        </fieldset>
    </div>
</div>

<div class="pull-right">
    <button type="submit" style="margin-left: 16px" class="btn btn-primary">Submit</button>
    <a href="{!! route('article.index') !!}" style="margin-left: 16px" class="btn btn-danger">Cancel</a>
</div>

<br>
<br>


<script type="text/javascript">
    CKEDITOR.replace('description');

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    $('#timepicker').timepicker({
        timeFormat: 'H:i:s',

    });



</script>
