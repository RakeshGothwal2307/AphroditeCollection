@extends('admin/index')
@section('title','Edit Page')
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Privacy Policy</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">All Pages</a></li>
          {{-- <li class="breadcrumb-item active">Edit Page</li>           --}}
        </ol>
      </div>
    </div>
  </div>
  <hr>
<div class="container-fluid">  
    <div class="row">
        <div class="col">    
            <form action="" method="post">
                @csrf
                <input type="hidden" name="title" id="" value="privacy_policy">
                <div class="form-group">
                    @foreach ($data as $key => $value)
                   <label for="exampleFormControlTextarea1"></label>
                    <textarea class="form-control" name="content">{!!$value->content!!}</textarea>
                    @endforeach
                </div>
                <input type="submit" name="submit" id="" class="btn btn-primary">
            </form>
        </div>    
    </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
   CKEDITOR.replace( 'content' );
</script>
@endsection