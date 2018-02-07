@extends('admin.layouts.app')
@section('title-content')
    Danh Sách Sản Phẩm 
@endsection
@section('content')
    <div class="col-md-12 flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->
     <!-- Main content -->
        <section class="content" style="padding-top: 0px">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                                    Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                                    Danh Mục
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                                    Hình Ảnh
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                                    Tác Giả
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">
                                                    Ngày tạo
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($itemProducts as $itemProduct)
                                                    <?php $itemProduct = (array)$itemProduct ;?>
                                                    <tr role="row">
                                                        <td>{{$itemProduct['title']}}</td>
                                                        <td>{{$itemProduct['categories_products_name'] or null}}</td>
                                                        <td>{!! $itemProduct['image'] ? '<img src="/upload/'.$itemProduct['image'].'" width="100">' : '' !!}</td>
                                                        <td>{{$itemProduct['author'] or 'Admin'}}</td>
                                                        <td>{{$itemProduct['created_at']}}</td>
                                                        <td>
                                                            <a href="{{route('show_edit_product', $itemProduct['id'])}}">
                                                                <button class="btn btn-warning btn-sm" data-id="{{$itemProduct['id']}}"><i class="fa fa-trash"></i> Sửa</button>
                                                            </a>
                                                            <a href="{{route('delete_product', $itemProduct['id'])}}">
                                                                <button class="btn btn-danger btn-sm" data-id="{{$itemProduct['id']}}"><i class="fa fa-trash"></i> Xoá</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

@endsection
@section('script')
    <script>
      $(function () {
        $("#example1").DataTable({
          "pageLength": 10,
          "paging": true,
          "info" : false
        });
        $(".alert" ).fadeOut(10000);
//        $('#example2').DataTable({
//          "pageLength": 3,
//          "paging": true,
//          "lengthChange": false,
//          "searching": false,
//          "ordering": true,
//          "info": true,
//          "autoWidth": false
//        });
      });
    </script>
@endsection