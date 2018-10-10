@extends('layouts.master')

@section('title')
    Category | FingerWind
@endsection

@section('content')

    <div id="pjax_options" class="padding-top">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{!! route('home') !!}">Dashboard
                    <li><a href="{!! route('category.index') !!}">Category</a></li>
                </ul>

                <ul class="breadcrumb pull-right" style="padding-right: 0px">
                    <li>
                        <a href="{{ route('category.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-square"
                                                                                                   aria-hidden="true">
                            </i>
                            <span style="margin-left: 10px">Add Category</span>
                        </a>
                    </li>
                </ul>

                <br>
                <br>

                @if(session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif
                @if(session()->has('delete'))
                    <div class="alert alert-danger">
                        {{ session()->get('delete') }}
                    </div>
                @endif

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading"
                             style="background-color: #bdf0fb;font-size: 18px;text-transform: uppercase">All Categories
                        </div>
                        <div class="panel-body">
                            <table class="projects-table data_table" id="table">
                                <thead style="background-color: #064685;color: white">
                                <tr>
                                    <th class="table-project-cell">
                                      <span>
                                        Serial No
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Category Name
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Category Title
                                      </span>
                                    </th>
                                    <th class="table-project-cell">
                                      <span>
                                        Created At
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                        Updated At
                                      </span>
                                    </th>

                                    <th class="table-project-cell">
                                      <span>
                                         Action
                                      </span>
                                    </th>
                                </tr>
                                </thead>
                                <?php
                                $i = 1;
                                ?>

                                <tbody class="customers">

                                @if(count($category)>0)
                                    @foreach($category as $value)
                                        <tr class="item{{$value->id}}">
                                            <td>{!! $i++ !!}</td>
                                            <td>{!! $value->name !!}</td>
                                            <td>{!! $value->title !!}</td>
                                            <td>{!! $value->created_at !!}</td>
                                            <td>{!! $value->updated_at !!}</td>
                                            <td class="jq-dropdown-container">
                                                <a href="{{ route('category.edit',$value->id) }}" class="btn btn-success"> <i class="fa fa-edit"></i> </a>
                                                <a href="{{ route('category.show',$value->id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i></a>
                                                <a href="" id="delete_modal" class="btn btn-danger"
                                                   data-id="{{ $value->id }}" data-name="{{ $value->name }}"> <i
                                                            class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/main.js') }}"></script>
    </div>


    <!--Delete Modal -->
    <div aria-hidden="true" aria-labelledby="deleteModal" class="modal fade" id="deleteModal" role="dialog"
         tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #39569a">
                    <h5 class="modal-title">
                        <span style="color: white">Delete Category</span>
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">
                                ×
                            </span>
                    </button>
                </div>

                <form action="" method="" enctype="">
                    <div class="modal-body">
                        <input type="hidden" id="deleteid">
                        <h3 class="text-center">Are You Sure?</h3>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            No
                        </button>
                        <button class="btn btn-primary" type="button" id="delete">
                            Yes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        <!--Delete data-->
        $(document).on('click', '#delete_modal', function (e) {
            e.preventDefault();
            $('#deleteid').val($(this).data('id'));
            $('#deleteModal').modal('show');
        });

        $('.modal-footer').on('click', '#delete', function() {

            var id = $('#deleteid').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('category.delete') }}',
                data: {id:id},
                success: function(data) {
                    $('#deleteModal').modal('hide');
                    toastr.error('Successfully Deleted Category!', 'Error Alert', {timeOut: 5000});
                    $.pjax.reload('#pjax_options');
                    $('.item' + data.id).remove();
                }
            });
        });

        <!--End Delete -->

    </script>


@endsection
