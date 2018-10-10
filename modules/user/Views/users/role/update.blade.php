<!-- START Header scripts -->
    {{--@include('user::scripts._header')--}}
    {{--@include('admin::scripts.validation')--}}
<!-- END Header scripts -->

<div class="modal-header">
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{$pageTitle}}</h4>
</div>


<div class="modal-body">

        {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['user.update.role', $data->slug], "class"=>"role_form"]) !!}
        @include('user::users.role._form')
        {!! Form::close() !!}
</div>


<!-- START Footer scripts -->
    {{--@include('userscripts._footer')--}}
<!-- END Header scripts -->