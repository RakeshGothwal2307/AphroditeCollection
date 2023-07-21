@extends('admin/index')
@section('content')

    <section class="content-header">
        <div class="card">
            <div class="ml-4 mr-4 mt-4">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h1>Upgrading Price</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">All Pages</a></li>
                            {{-- <li class="breadcrumb-item active">Edit Page</li>           --}}
                        </ol>
                    </div>
                </div>
            </div>
            <hr>

            <div class="container">
                <div class="card">
                    <div class="ml-4 mt-4 mb-4 mr-4">
                        <form method="post" action="{{ route('admin.pricing') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCountry">Country</label>
                                    <select  id="country-dropdown"  class="form-control" name="country">
                                        <option value="">-- Select Country --</option>
                                        @foreach ($country as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="state-dropdown" class="form-control" name="state">
                                        <option>Select State</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">City</label>
                                    <select id="city-dropdown" class="form-control" name="city">
                                        <option>Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Top 10 Placement</label>
                                <input type="text" class="form-control" name="placement_cost" placeholder="Enter Cost">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Featured Ad</label>
                                <input type="text" class="form-control" name="featured_ad_cost" 
                                    placeholder="Enter Cost">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Animated Gif</label>
                                <input type="text" class="form-control" name="animated_gif_cost"
                                    placeholder="Enter Cost">
                            </div>
                            <button type="submit" name="upgrade_price" class="btn btn-primary">Upgrade Price</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <hr>
            

            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">City</th>
                                    <th scope="col">Top 10 Placement</th>
                                    <th scope="col">Featured Ad</th>
                                    <th scope="col">Animated Gif</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_price as $all_prices)
                                @dd($all_prices['states'])
                                <tr>
                                    <td scope="col"> test</td>
                                    <td scope="col"> {{ $all_prices->placement_cost }} </td>
                                    <td scope="col"> {{ $all_prices->featured_ad_cost }} </td>
                                    <td scope="col"> {{ $all_prices->animated_gif_cost }} </td>
                                    <td scope="col">Action</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script>
        $(document).ready(function () {
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
  
            $('#state-dropdown').on('change', function () {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
  
        });
    </script>


    {{-- ********************************* start insert FAQ ********************************* --}}
    <script>
        $(document).ready(function() {
            $("#btn_faq").on('click', function() {
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
                    data: {
                        question: question,
                        answer: answer
                    },
                    success: function(data) {
                        $("#form")[0].reset();
                        $("#exampleModal").modal('hide');
                        location.reload();
                    },
                    error: function(data) {}
                })
            });
        });
    </script>
    {{-- ********************************* End insert FAQ ********************************* --}}

    {{-- ********************************* Start Edit Fatch data FAQ ********************************* --}}
    <script>
        $(document).ready(function() {
            $(".fatchFaq").on('click', function() {
                var id = $(this).attr('data_id');
                var question = $(this).attr('data_question');
                var answer = $(this).attr('data_answer');
                $('#edit_id').val(id);
                $('#edit_question').val(question);
                $('#edit_answer').val(answer);
            })
        })
    </script>
    {{-- ********************************* end Edit fatch data FAQ ********************************* --}}

    {{-- ********************************* Start Edit FAQ ********************************* --}}

    <script>
        $(document).ready(function() {
            $("#edit_faq").on('click', function() {
                var id = $("#edit_id").val();
                var question = $("#edit_question").val();
                var answer = $("#edit_answer").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('faq_edit') }}",
                    type: "post",
                    data: {
                        id: id,
                        question: question,
                        answer: answer,
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {}
                })
            })
        })
    </script>
    {{-- ********************************* End Edit FAQ ********************************* --}}
@endsection
