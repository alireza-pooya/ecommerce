@extends('home.dashboard')
@section('body')
    <div class="container mt-5 ">
        <div class="col-12 text-center"><h3><b>Edit Profile</b></h3></div>
        <form action="{{ route('profile.update',['user'=>$user->id]) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="row  shadow form-bg mt-3 p-4">
                @include('layouts.messages')
                @include('layouts.errors')
                <div class="col-12 col-md-10 offset-md-1">
                    <input type="hidden" name="image" id="img_value" value="{{ $user['image'] }}">
                    <div id="FileUpload">
                        <div id="crop_modal" class="crop_modal modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- crop_modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Image Upload</h4>
                                    </div>
                                    <div class="modal-body" style="display: inline-block">
                                        <img width="100%" src="" id="image_cropper">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="Save" value="Save">save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cropped_value" id="cropped_value" value="">
                        <input type="hidden" id="cropped_type" name="type" value="profile">
                        <div class="imageupload">
                            <div class="file-tab">
                                @if($user['image'])
                                    <img src="{{ url('upload/profile').'/'. $user['image'] }}" alt="Image preview" id="image" class="thumbnail" style="height:300px;width:300px ">
                                @else
                                    <img src="{{ url('images/profile.png') }}" alt="Image preview" id="image"
                                         class="thumbnail" style="height:300px;width:300px ; border:dashed 2px #444444">
                                @endif
                                <label class="btn btn-default btn-file">choose image<input type="file" name="file" id="cropper">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="full_name"><b>full name :</b></label>
                        <input class="form-control" type="text" id="full_name" name="full_name"
                               value="{{ $user['full_name'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="email"><b>email :</b></label>
                        <input class="form-control" type="text" id="email" name="email"
                               value="{{ $user['email'] }}">
                    </div>
                </div>
                <div class="col-12  col-md-10 offset-md-1">
                    <div class="form-group mb-0">
                        <label class="col-form-label" for="mobile"><b>mobile :</b></label>
                        <input class="form-control" type="text" id="mobile" name="mobile"
                               value="{{ $user['mobile'] }}">
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1  mt-2">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender1" name="gender" class="custom-control-input"
                               value="0"{{ ( $user['gender']  == 0 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="gender1">woman</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gender2" name="gender" class="custom-control-input"
                               value="1"{{ ( $user['gender']  == 1 ?  "checked" : '') }}>
                        <label class="custom-control-label" for="gender2">man</label>
                    </div>
                </div>
                <div class="col-12 col-md-6 offset-md-6 mt-2">
                    <button class="btn btn-success">save changes</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-info">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('footer')
    <script>
        $(function () {
            var cropper;
            var options = {
                aspectRatio: 1 / 1,
                minContainerWidth: 700,
                minContainerHeight: 450,
                minCropBoxWidth: 250,
                minCropBoxHeight: 250,
                cropBoxResizable: false,
                dragMode: 'move',
                viewMode: 1,
                crop: function (e) {
                    $("#cropped_value").val(parseInt(e.detail.width) + "," + parseInt(e.detail.height) + "," + parseInt(e.detail.x) + "," + parseInt(e.detail.y));
                }
            };
            $("body").on("click", "#image_source", function () {
                var e = $("#image_source").attr("src");
                e = e.replace("/thumb", ""), $("#image_cropper").attr("src", e), $("#image_edit").val("yes"), $("#crop_modal").modal("show")
            }), $(".crop_modal").on("hide.bs.modal", function () {
                cropper.destroy()
            }), $(".crop_modal").on("show.bs.modal", function () {
                var e = document.getElementById("image_cropper");
                cropper = new Cropper(e, options)
            }), $("body").on("click", "#Save", function () {
                var e = new FormData;
                e.append("cropped_value", $("#cropped_value").val()), e.append("cropped_type", $("#cropped_type").val()), e.append("file", $("#cropper")[0].files[0]), $.ajax({
                    url: "{{ url('/ajaxupload/') }}",
                    type: "POST",
                    mimeType: "multipart/form-data",
                    headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                    data: e,
                    contentType: !1,
                    cache: !1,
                    processData: !1,
                    success: function (a) {
                        $("#crop_modal").modal("hide"), $("#image").attr("src", asli_url + "/upload/" + e.get("cropped_type") + "/thumb/" + a).show(), $("#img_value").val(a)
                    }
                })
            }), $(document).on("change", "#cropper", function () {
                $(this).data("imagecheck");
                var e = this.files[0], a = e.type, o = window.URL || window.webkitURL;
                img = new Image, img.src = o.createObjectURL(e), img.onload = function () {
                    var o = ["image/jpeg", "image/png", "image/jpg"];
                    if (a != o[0] && a != o[1] && a != o[2]) return alert("the picture format isn't correct"), !1;
                    var r = new FileReader;
                    r.readAsDataURL(e), r.onloadend = function () {
                        $(document).find("#image_cropper").attr("src", ""), $(document).find("#image_cropper").attr("src", this.result), $("#image_edit").val(""), $("#crop_modal").modal("show")
                    }
                }
            });
        });
    </script>
@endsection
