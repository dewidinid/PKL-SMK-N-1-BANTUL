@extends('layouts.headerlogin')

@section('content')

    <div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
        <div class="row">
        <div class="col-md-3 register-left" style="margin-top: 10%;right: 5%">
            <h3>E-PKL SMK N 1 BANTUL</h3>
            <hr>
            <h5>Selamat Datang di </h5>
            <h5>Website PKL SMK N 1 Bantul</h5>
        </div>

        <!-- button login -->
            <div class="col-md-9 register-right" style="margin-top: 0px;left: 80px; margin-button:10px; ">
                <div>
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="width: 50%;">
                        <li class="nav-item">
                        <a class="nav-link active" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab" aria-controls="siswa"
                            aria-selected="true">Siswa</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="pembimbing-tab" data-toggle="tab" href="#pembimbing" role="tab" aria-controls="pembimbing"
                            aria-selected="false">Pembimbing</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin"
                            aria-selected="false">Admin</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="dudi-tab" data-toggle="tab" href="#dudi" role="tab" aria-controls="dudi"
                            aria-selected="false">Dudi</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                        <h3 class="register-heading">Login sebagai Siswa</h3>
                        <form method="post" action="siswa">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="NIS" name="username1" onkeydown="return alphaOnly(event);" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                    </div>
                                    <!-- Tombol submit yang disabled pada awalnya -->
                                    <button type="submit" class="btn btn-outline-primary" value="Login">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Form Login Pembimbing -->
                    <div class="tab-pane fade show" id="pembimbing" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Login sebagai Pembimbing</h3>
                        <form method="post" action="pembimbing">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="NIP / Id Pembimbing" name="username1" onkeydown="return alphaOnly(event);" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn btn-outline-primary" value="Login">Login</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!--  Form login admin -->
                    <div class="tab-pane fade show" id="admin" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Login sebagai Admin</h3>
                        <form method="post" action="admin">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Admin" name="username1" onkeydown="return alphaOnly(event);" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn btn-outline-primary" value="Login">Login</button>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- Form Login Dudi -->
                    <div class="tab-pane fade show" id="dudi" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Login sebagai Dudi</h3>
                        <form method="post" action="dudi">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Kode Dudi" name="username1" onkeydown="return alphaOnly(event);" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required />
                                </div>
                                <button type="submit" class="btn btn-outline-primary" value="Login">Login</button>
                            </div>
                            <br>
                        </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>
                <br>
            

            </div>
        </div>
    </div>


@endsection
