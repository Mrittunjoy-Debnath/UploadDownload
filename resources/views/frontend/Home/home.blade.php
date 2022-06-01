@extends('frontend.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-3 mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        <h6>Laravel Ajax File Upload</h6>
                    </div>
                    <div class="card-body p-3">
                        <input id="fileId" class="form-control mt-2" type="file">
                        <div class="d-grid">
                            <button id="uploadBtnId" onclick="onUpload()" class="btn btn-block btn-primary mt-2" type="button">Upload</button>
                            <h5 id="uploadPercentageId"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-5">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Download</td>
                        </tr>
                    </thead>
                    <tbody class="tableData">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        getFileList();
        function getFileList()
        {
            // axios.get('/fileList')
            //     .then(function (response)  {

            axios.get('/fileList')
                .then(response => {
                    var JSONDATA = response.data;

                $.each(JSONDATA,function (i) {
                    $('<tr>').html(
                        "<td>"+JSONDATA[i].id+"</td>"+
                        "<td><a href='/fileDownload/"+JSONDATA[i].file_path+"'  class='btn  btn-primary'>Download</a></td>"
                    ).appendTo('.tableData');
                })
                    // $('.downloadBtn').click(function () {
                    //     let file_path = $(this).data('path');
                    //     alert(file_path);
                    // });
                }).catch(response => {


            })
        }

       function onUpload()
        {
            // let spinner = "<div class='spinner-border text-info spinner-border-sm' role='status'> </div>";

            // $('#uploadBtnId').html(spinner);
           let myFile = document.getElementById('fileId').files[0];
           let myFileName = myFile.name;
           let myFileSize = myFile.size;
           let myFileFormat = myFileName.split('.').pop();

           let fileData = new FormData();
           fileData.append('fileKey',myFile);
           let config = {
               headers:{'content-type' : 'multipart/form-data'},
               onUploadProgress:function (progressEvent) {
                    let uploadPercentage = Math.round((progressEvent.loaded*100)/progressEvent.total);

                    let uploadedMb = (progressEvent.loaded)/(1024*1024);
                    let totalMb = (progressEvent.total)/(1024*1024);
                    let dueMb = totalMb-uploadedMb;


                    $('#uploadPercentageId').html("Uploaded: "+uploadedMb.toFixed(2)+" MB Due : "+dueMb.toFixed(2) +"MB Total "+ totalMb.toFixed(2)+" MB");
               }
           };

           axios.post('/fileUp',fileData,config)
            .then(response => {
                if(response.status==200)
                {
                    $('#uploadPercentageId').html('Upload Success');

                        setTimeout(function () {
                            $('#uploadPercentageId').html('Upload ');
                        },3000);
                }
                else{
                     $('#uploadPercentageId').html('Upload Failed');
                    setTimeout(function () {
                        $('#uploadPercentageId').html('Upload');
                    },3000);
                }

                // if(response.status==200)
                // {
                //     $('#uploadBtnId').html('Upload Success');
                //     // alert(response.data);
                //     setTimeout(function () {
                //         $('#uploadBtnId').html('Upload ');
                //     },3000);
                // }else
                // {
                //     $('#uploadBtnId').html('Upload Failed');
                //     setTimeout(function () {
                //         $('#uploadBtnId').html('Upload ');
                //     },3000);
                // }
            }).catch(response => {

               $('#uploadPercentageId').html('Upload Failed');
               setTimeout(function () {
                   $('#uploadPercentageId').html('Upload');
               },3000);


               //  $('#uploadBtnId').html('Upload Failed');
               // setTimeout(function () {
               //     $('#uploadBtnId').html('Upload ');
               // },3000);
            })
        }

    </script>
@endsection
