@extends('admin/index')
@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="a">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Question</label>
            <input type="text" class="form-control" id="question">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Answer</label>
            <textarea class="form-control" id="answer"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_faq">Submit</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="a">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Question</label>
              <input type="text" class="form-control" id="question">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Answer</label>
              <textarea class="form-control" id="answer"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn_faq">Submit</button>
        </div>
      </div>
    </div>
  </div>







    <section class="content-header">
        <div class="card">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1>Frequently Asked Questions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">All Pages</a></li>
                        {{-- <li class="breadcrumb-item active">Edit Page</li>           --}}
                    </ol>
                </div>
            </div>
            <div class="col-sm-6 mb-4">
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Add New</button>
            </div>
        </div>
    
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <button type="button" class="btn text-primary" data-toggle="modal" data-target="#editModal">Edit</button>
                                <a href="{{ route('faq_delete',['id'=>$faq->id]) }}" class="text-danger">Delete</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    </section>

{{-- --------------------- start insert FAQ ----------------- --}}
    <script>
        $(document).ready(function(){
            $("#btn_faq").on('click',function(){
                var question = $("#question").val();
                var answer = $("#answer").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('faq.store') }}",
                    type: "post",
                    data: {question:question,answer:answer},
                    success: function(data){
                        $("#form")[0].reset();
                        $("#exampleModal").modal('hide');
                        location.reload();
                    },
                    error: function(data){
                    }
                })
            });
        });
    </script>
{{-- --------------------- End insert FAQ ----------------- --}}


@endsection



