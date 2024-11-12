@extends('layouts.headerlogin')

@section('content')

<div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
    <div class="row">
        <div class="col-md-3 register-left" style="margin-top: 10%; right: 5%">
            <h3>E-PKL SMK N 1 BANTUL</h3>
            <hr>
            <h5>Selamat Datang di </h5>
            <h5>Website PKL SMK N 1 Bantul</h5>
        </div>

        <!-- Button login -->
        <div class="col-md-8 register-right frosted-glass" style="margin-top: 0px; left: 120px; margin-bottom: 10px;">
            <div>
                <ul class="nav nav-tabs nav-justified " id="myTab" role="tablist" style="width: 50%; margin-top: 15px;">
                    <li class="nav-item" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; padding-right: 5px;">
                        <a class="nav-link active" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab" aria-controls="siswa"
                           aria-selected="true">Siswa</a>
                    </li>
                    <li class="nav-item" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; padding-right: 5px;">
                        <a class="nav-link" id="pembimbing-tab" data-toggle="tab" href="#pembimbing" role="tab" aria-controls="pembimbing"
                           aria-selected="false">Pembimbing</a>
                    </li>
                    <li class="nav-item" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; padding-right: 5px;">
                        <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin"
                           aria-selected="false">Admin</a>
                    </li>
                    <li class="nav-item" style="margin-top: 5px; margin-bottom: 5px; padding-left: 5px; padding-right: 5px;">
                        <a class="nav-link" id="dudi-tab" data-toggle="tab" href="#dudi" role="tab" aria-controls="dudi"
                           aria-selected="false">Dudi</a>
                    </li>
                </ul>
            </div>

            <br>
            {{-- <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                    <h3 class="register-heading">Login sebagai Siswa</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="siswa">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" inputmode="numeric" class="form-control" placeholder="NIS" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" id="password-siswa" required>
                                    <button type="button" id="toggle-password-siswa" class="btn position-absolute" style="top: 10%; right: 10px; transform: translateY(-7%);">
                                        <i class="far fa-eye" style="color: rgb(173, 173, 173)"></i>
                                    </button>

                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;  " value="Login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form Login Pembimbing -->
                <div class="tab-pane fade" id="pembimbing" role="tabpanel" aria-labelledby="pembimbing-tab">
                    <h3 class="register-heading">Login sebagai Pembimbing</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="pembimbing">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" inputmode="numeric" class="form-control" placeholder="NIP / NIK" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;  " value="Login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form login admin -->
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <h3 class="register-heading">Login sebagai Admin</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Admin" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;  " value="Login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form Login Dudi -->
                <div class="tab-pane fade" id="dudi" role="tabpanel" aria-labelledby="dudi-tab">
                    <h3 class="register-heading">Login sebagai Dudi</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="dudi">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Dudi" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;   " value="Login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="tab-content" id="myTabContent">
                <!-- Form Login Siswa -->
                <div class="tab-pane fade show active" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                    <h3 class="register-heading">Login sebagai Siswa</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="siswa">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" inputmode="numeric" class="form-control" placeholder="NIS" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" id="password-siswa" required>
                                    <button type="button" class="btn toggle-password position-absolute" style="top: 10%; right: 10px; transform: translateY(-7%);">
                                        <i class="far fa-eye" style="color: rgb(173, 173, 173)"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            
                <!-- Form Login Pembimbing -->
                <div class="tab-pane fade" id="pembimbing" role="tabpanel" aria-labelledby="pembimbing-tab">
                    <h3 class="register-heading">Login sebagai Pembimbing</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="pembimbing">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" inputmode="numeric" class="form-control" placeholder="NIP / NIK" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required>
                                    <button type="button" class="btn toggle-password position-absolute" style="top: 10%; right: 10px; transform: translateY(-7%);">
                                        <i class="far fa-eye" style="color: rgb(173, 173, 173)"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            
                <!-- Form Login Admin -->
                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <h3 class="register-heading">Login sebagai Admin</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Admin" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required>
                                    <button type="button" class="btn toggle-password position-absolute" style="top: 10%; right: 10px; transform: translateY(-7%);">
                                        <i class="far fa-eye" style="color: rgb(173, 173, 173)"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            
                <!-- Form Login Dudi -->
                <div class="tab-pane fade" id="dudi" role="tabpanel" aria-labelledby="dudi-tab">
                    <h3 class="register-heading">Login sebagai Dudi</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="dudi">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Dudi" name="username1" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required>
                                    <button type="button" class="btn toggle-password position-absolute" style="top: 10%; right: 10px; transform: translateY(-7%);">
                                        <i class="far fa-eye" style="color: rgb(173, 173, 173)"></i>
                                    </button>
                                </div>
                                <button type="submit" class="btn" style="background-color: white; color: rgb(0, 94, 217); margin-top: 50px;">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
</div>

<br><br>

@endsection
