@extends('layout.layout')
@section('title', 'Add New Banner')
@section('custom-css')
    <style>
         .selectImgDiv{
            border-radius:5px 5px 0px 0px;
            height:300px;
            width:100%;
            border:1px solid #d9dee3;
            background-color: #f8f8f8;
            margin-bottom:10px;
            overflow: hidden;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .selectImgDiv img{
            height:250px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header"><h4>Add New Banner</h4></div>
            <div class="card-body">
                <form id="addNewBannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Select Banner Image  <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span></label>
                        <div class="selectImgDiv">
                            <img src="{{asset('assets/img/placeholder.png')}}" alt="Project Image" id="selectBannerImage">
                        </div>
                        <input class="form-control" type="file" name="bannerImage" id="bannerImage" accept=".png, .jpg, .jpeg" placeholder="Select Image" required>
                    </div>
                    <div class="mt-4 d-flex flex-row justify-content-center">
                        <button class="btn btn-primary btn-md" id="bannerSubmitBtn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
@endsection
@section('custom-scripts')
    <script>

        $('#bannerImage').on('change', function(){
            let file = this.files[0];

            if(file){
                let reader = new FileReader();
                reader.onload = function(event){
                    $('#selectBannerImage').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        $('#addNewBannerForm').on('submit', function(e){

            e.preventDefault();

            $('#bannerSubmitBtn').attr('disabled', true);
            $('#bannerSubmitBtn').text('Please Wait....');

            let formData = new FormData(this);
            let bannerImage = $('#bannerImage').prop('files')[0];
            formData.append('bannerImage', bannerImage);

            $.ajax({
                url:"{{route('admin.add.new.banner')}}",
                type:"POST",
                data:formData,
                contentType:false,
                processData:false,
                success:function(data){

                    if(data.status === 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Great!',
                            text: data.message,
                            confirmButtonText: 'Okay',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#selectBannerImage').attr('src', "{{asset('assets/img/placeholder.png')}}");
                                $('#addNewBannerForm').trigger("reset");
                            }
                        })

                        $('#bannerSubmitBtn').attr('disabled', false);
                        $('#bannerSubmitBtn').text('Submit');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message,
                        })

                        $('#bannerSubmitBtn').attr('disabled', false);
                        $('#bannerSubmitBtn').text('Submit');
                    }
                    
                }, error:function(error){
                    Swal.fire({
                        icon: 'error',
                        text: 'Oops! Something Went Wrong.',
                    })

                    $('#bannerSubmitBtn').attr('disabled', false);
                    $('#bannerSubmitBtn').text('Submit');
                }
            })
        })
    </script>
@endsection