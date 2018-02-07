@extends('admin.layouts.app')
@section('title-content')
    Tạo Sản Phẩm
@endsection
@section('content')
    <div class="col-md-12">
        <form action="{{route('save_register_product')}}" method="post">
            <div class="col-md-8">
                <label>Tên Sản Phẩm:</label>
                <div class="form-group">
                    <input type="text" name="name_prd" class="form-control" placeholder="Nhập tên sản phẩm ...">
                </div>
            </div>
            <div class="col-md-8">
                <label>Danh Mục Sản Phẩm:</label>
                <select class="form-control" id="sel1">
                    <option value=""></option>
                    @foreach($productCategory as $value)
                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12" style="margin-top: 15px">
                <label>Mô tả về sản phẩm:</label>
                <textarea id="editor1" name="content" rows="7" class="form-control ckeditor" placeholder="Write your message.."></textarea>
                <script src="/ckeditor/ckeditor.js"></script>

                <script type="text/javascript">
                  CKEDITOR.replace( 'editor1' );
                </script>
            </div>

            <div class=" col-md-8" style="margin-top: 10px">
                <label>Hình ảnh đại diện:</label>
                <input type="file" name="fileToUpload">
            </div>

            <div class=" col-md-8" style="margin-top: 20px">
                <button type="submit" class="btn btn-primary"> Tạo Sản Phẩm</button>
            </div>
        </form>
    </div>

@endsection