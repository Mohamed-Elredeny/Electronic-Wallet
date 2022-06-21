<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>e-wallet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin/images/logo.png")}}">

    <link href="{{asset("assets/admin/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/admin/libs/summernote/summernote-bs4.min.css")}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/admin/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset("assets/admin/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset("assets/admin/css/icons.min.css")}}" rel="stylesheet" type="text/css"/>
    
    <!-- App Css-->
    @yield("style")
    <link href="{{asset("assets/admin/css/app-rtl.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/admin/css/redo.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/site/css/teacher.css')}}">


</head>
<body>

    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

     <!-- Begin page -->
     <div class="accountbg" style="background: url('{{asset("assets/admin/images/bg.jpg")}}');background-size: cover;background-position: center;"></div>

    <div class="account-pages mt-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>    
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <div class="text-center mt-4">
                                <div class="mb-3">
                                    <a href="index.html"><img src="{{asset("assets/admin/images/logo.png")}}" height="40" alt="logo"></a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h4 class="font-size-18 mt-2 text-center">تسجيل</h4>

                                <form class="form-horizontal" method="post"  action="{{route('vendor.register.submit')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username">الاسم</label>
                                        <input type="text" class="form-control" name="name" id="username" placeholder=" الاسم" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الالكتروني</label>
                                        <input type="mail" class="form-control" name="email" id="email" placeholder="ادخل البريد الالكتروني" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">كلمة المرور</label>
                                        <input type="password" class="form-control" name="password" id="userpassword" placeholder="ادخل كلمة المرور" required>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label">{{__('home.card')}}</label>
                                            <select class="select2 form-control select2-multiple" multiple="multiple" name="cards_id[]" multiple data-placeholder="اختر الإضافات" required>
                                                <option value="all">{{__('home.all')}}</option>
                                            @foreach($categories as $group)
                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">الصورة</label>
                                        <input type="file" class="form-control" name="imagee" id="image" accept="image/*" required>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">تسجيل دخول</button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> هل نسيت كلمة المرور</a>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    {{-- <div class="mt-5 text-center">
                        <p class="text-white"> <a href="pages-register.html" class="font-weight-bold text-primary"> Signup Now </a> </p>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    
    <script src="{{asset("assets/admin/libs/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/metismenu/metisMenu.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/select2/js/select2.min.js")}}"></script>
    <script src="{{asset("assets/admin/libs/summernote/summernote-bs4.min.js")}}"></script>
    <script src="{{asset("assets/admin/js/pages/email-summernote.init.js")}}"></script>

    <script src="{{asset("assets/admin/js/app.js")}}"></script>

</body>
</html>
