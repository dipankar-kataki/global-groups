@extends('layout.layout')
@section('title', 'Create Projects')
@section('custom-css')
    <style>
         .selectImgDiv{
            border-radius:5px 5px 0px 0px;
            height:250px;
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
            height:200px;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 300px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header"><h4>Add New Project</h4></div>
            <div class="card-body">
                <form id="addOngoingProjectForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="projectName" class="form-label">Enter Project Name  <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span></label>
                        <input type="text" class="form-control" id="projectName" placeholder="e.g Dream Building" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectImage" class="form-label">Select Project Image  <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span></label>
                        <div class="selectImgDiv">
                            <img src="{{asset('assets/img/placeholder.png')}}" alt="Project Image" id="selectProjectImage">
                        </div>
                        <input class="form-control" type="file" name="projectImage" id="projectImage" accept=".png, .jpg, .jpeg" placeholder="Select Image" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectDescription" class="form-label">Enter Project Description  <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span></label>
                        <div id="projectDescriptionEditor"></div>
                    </div>
                    <div class="mb-3">
                        <label for="projectBrochure" class="form-label">Select Project Brochure</label>
                        <input class="form-control" type="file" name="projectBrochure" id="projectBrochure" accept=".pdf" placeholder="Select Brochure PDF">
                    </div>
                    <div class="mb-3">
                        <label for="projectLocation" class="form-label">Enter Project Location  <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span></label>
                        <input class="form-control" type="text" name="projectLocation" id="projectLocation" placeholder="e.g India, Noida" required>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="projectLocation" class="form-label">Enter Project Latitude</label>
                                <input class="form-control" type="text" name="projectLatitude" id="projectLatitude" placeholder="e.g 97.0.10.12">
                            </div>
                            <div class="col-md-6">
                                <label for="projectLocation" class="form-label">Enter Project Longitude</label>
                                <input class="form-control" type="text" name="projectLongitude" id="projectLongitude" placeholder="e.g 196.2.245">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="projectStatus" class="form-label">Enter Project Status  
                            <span class="text-danger" style="font-weight:bold;font-size:14px;">*</span>
                        </label>
                        <select name="projectStatus" id="projectStatus" class="form-control">
                            <option selected disabled>- Select -</option>
                            <option value="ongoing">ONGOING</option>
                            <option value="completed">COMPLETED</option>
                        </select>
                    </div>
                    <div class="mt-4 d-flex flex-row justify-content-center">
                        <button class="btn btn-primary btn-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
@endsection
@section('custom-scripts')
    <script>
        let myProjectDescriptionEditor;
        $(document).ready( function () {
            $('#ongoingProjectsTable').DataTable();

            ClassicEditor
            .create( document.querySelector( '#projectDescriptionEditor' ),{
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockQuote',
                    'undo',
                    'redo'
                ]
            }).then( editor => {
                myProjectDescriptionEditor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
        });

        $('#projectImage').on('change', function(){
            let file = this.files[0];

            if(file){
                let reader = new FileReader();
                reader.onload = function(event){
                    $('#selectProjectImage').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    {{-- <script>
        $('.changeStatus').on('click', function(){
        
            const id = $(this).data('id');
            const status = $(this).data('status')


            $.ajax({
                url:"{{route('admin.blog.change.status')}}",
                type:"POST",
                data:{
                    id: id,
                    status: status,
                    '_token': "{{csrf_token()}}"
                },
                success:function(data){

                    if(data.status === 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Great!',
                            text: data.message,
                            confirmButtonText: 'Okay',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true)
                            }
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: data.message,
                        })
                    }
                    
                }, error:function(error){
                    Swal.fire({
                        icon: 'error',
                        text: 'Oops! Something Went Wrong.',
                    })
                }
            })
        })
    </script> --}}
@endsection