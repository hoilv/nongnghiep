@extends('admin.layouts.app')
@section('title-content')
    Sửa Sản Phẩm
@endsection
@section('content')
    <div class="col-md-12">
        <form action="{{route('edit_product')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="product_id" value="{{$itemProducts['id']}}">
            <div class="col-md-8">
                <label>Tên Sản Phẩm <span style="color: red">(*)</span></label>
                <div class="form-group">
                    <input type="text" name="title_prd" class="form-control" value="{{$itemProducts['title']}}">
                </div>
                @if ($errors->has('title_prd'))
                    <p class="help-block text-left" style="color: red">{{ $errors->first('title_prd') }}</p>
                @endif
            </div>
            <div class="col-md-8">
                <label>Danh Mục Sản Phẩm:</label>
                <select class="form-control" id="sel1" name="select_cate_prd">
                    <option value=""></option>
                    @foreach($productCategory as $value)
                        <option value="{{$value['id']}}" {{ $value['id']==$itemProducts['category_product_id'] ? 'selected' : ''}}>{{$value['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12" style="margin-top: 15px">
                <label>Mô tả về sản phẩm <span style="color: red">(*)</span></label>
                <textarea id="editor1" name="content" rows="7" class="form-control ckeditor">{{$itemProducts['content']}}</textarea>
                <script src="/ckeditor/ckeditor.js"></script>

                <script type="text/javascript">
                  CKEDITOR.replace( 'editor1' );
                </script>
                @if ($errors->has('content'))
                    <p class="help-block text-left" style="color: red">{{ $errors->first('content') }}</p>
                @endif
            </div>

            <div class=" col-md-8" style="margin-top: 10px">
                <label>Người Viết Bài:</label>
                <div class="form-group">
                    <input type="text" name="author" class="form-control" value="{{$itemProducts['author']}}">
                </div>
                @if ($errors->has('author'))
                    <p class="help-block text-left" style="color: red">{{ $errors->first('author') }}</p>
                @endif
            </div>

            <div class=" col-md-8" style="margin-top: 10px">
                <label>Hình ảnh đại diện <span style="color: red">(*)</span></label>
                <input type="file" name="fileToUpload">
                <img id="image" src="/upload/{{$itemProducts['image']}}" style="width: 150px; margin-top: 10px">
                @if ($errors->has('fileToUpload'))
                    <p class="help-block text-left" style="color: red">{{ $errors->first('fileToUpload') }}</p>
                @endif
            </div>

            <div class=" col-md-8" style="margin-top: 20px">
                <button type="submit" class="btn btn-primary"> Sửa Sản Phẩm</button>
            </div>
        </form>
    </div>

@endsection