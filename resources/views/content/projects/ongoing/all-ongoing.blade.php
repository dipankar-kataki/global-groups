@extends('layout.layout')
@section('title', 'All Ongoing Projects')
@section('custom-css')
    <style>
        #ongoingProjectsTable{
            border: 1px solid #f0f0f0;
            border-radius: 5px;
        }

        #ongoingProjectsTable{
            margin-right: 5px;
        }
        #ongoingProjectsTable_wrapper{
            padding:5px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-row justify-content-between">
                    <h4>Ongoing Projects</h4>
                    <a href="{{route('admin.add.ongoing.projects')}}" type="button" class="btn btn-primary">
                        <span class="tf-icons bx bx-plus"></span>&nbsp; Add Project
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-wrap">
                    <table id="ongoingProjectsTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Features</th>
                                <th>Brochure PDF</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Uttarayan Shreejoni</td>
                                <td>Kahilipara, Basistha Road Guwahati</td>
                                <td>Good, Better, Best, One, Two</td>
                                <td>Click To view</td>
                                <td>2011-04-25</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="">
                                                <i class="bx bx-show me-1" ></i> View
                                            </a>
                                            <a class="dropdown-item changeStatus" href="javascript:void(0)" data-id="" data-status="0">
                                                <i class="bx bx-hide me-1"></i> Inactive
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection
@section('custom-scripts')
    <script>
        $(document).ready( function () {
            $('#ongoingProjectsTable').DataTable();
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