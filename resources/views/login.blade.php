@extends('layouts.headerlogin')

@section('content')

{{-- <div class="container register" style="font-family: 'IBM Plex Sans', sans-serif;">
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
</div> --}}

<br>
<br>

<div class="container">
    <div class="content">
        <div class="welcome-section">
            <h1>E-PKL SMK N 1 BANTUL</h1>
            <p>Selamat Datang di Website PKL SMK N 1 Bantul</p>
        </div>
        <div class="login-section frosted-glass">
            <br>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="siswa-tab" data-toggle="tab" href="#siswa" role="tab" aria-controls="siswa" aria-selected="true">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pembimbing-tab" data-toggle="tab" href="#pembimbing" role="tab" aria-controls="pembimbing" aria-selected="false">Pembimbing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dudi-tab" data-toggle="tab" href="#dudi" role="tab" aria-controls="dudi" aria-selected="false">Dudi</a>
                    </li>
                </ul>
            </div>            
            <br>
            <div class="tab-content">
                <!-- Form Login Siswa -->
                <div class="tab-pane active" id="siswa">
                    <h3 style="color: white">Login sebagai Siswa</h3>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="siswa">
                        <div class="form-group">
                            <input type="text" name="username1" placeholder="NIS" class="form-control" required>
                        </div>
                        <div class="form-group password-field">
                            <input type="password" name="password2" placeholder="Password *" class="form-control" required>
                            <button type="button" class="toggle-password">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                    </form>
                </div>
        
                <!-- Form Login Pembimbing -->
                <div class="tab-pane" id="pembimbing">
                    <h3 style="color: white">Login sebagai Pembimbing</h3>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="pembimbing">
                        <div class="form-group">
                            <input type="text" name="username1" placeholder="NIP / NIK" class="form-control" required>
                        </div>
                        <div class="form-group password-field">
                            <input type="password" name="password2" placeholder="Password *" class="form-control" required>
                            <button type="button" class="toggle-password"><i class="far fa-eye"></i></button>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                    </form>
                </div>
        
                <!-- Form Login Admin -->
                <div class="tab-pane" id="admin">
                    <h3 style="color: white">Login sebagai Admin</h3>
                        <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="admin">
                        <div class="form-group">
                            <input type="text" name="username1" placeholder="Kode Admin" class="form-control" required>
                        </div>
                        <div class="form-group password-field">
                            <input type="password" name="password2" placeholder="Password *" class="form-control" required>
                            <button type="button" class="toggle-password"><i class="far fa-eye"></i></button>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                    </form>
                </div>
        
                <!-- Form Login Dudi -->
                <div class="tab-pane" id="dudi">
                    <h3 style="color: white">Login sebagai Dudi</h3>
                        <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="role" value="dudi">
                        <div class="form-group">
                            <input type="text" name="username1" placeholder="Kode Dudi" class="form-control" required>
                        </div>
                        <div class="form-group password-field">
                            <input type="password" name="password2" placeholder="Password *" class="form-control" required>
                            <button type="button" class="toggle-password"><i class="far fa-eye"></i></button>
                        </div>
                        <button type="submit" class="login-button">Login</button>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<br><br><br>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-item");
    const panes = document.querySelectorAll(".tab-pane");

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            // Remove active class from all tabs and panes
            tabs.forEach((t) => t.classList.remove("active"));
            panes.forEach((pane) => pane.classList.remove("active"));

            // Add active class to clicked tab and corresponding pane
            tab.classList.add("active");
            const targetPane = document.getElementById(tab.dataset.tab);
            targetPane.classList.add("active");
        });
    });
});

</script>

@include('layouts.footer')
@endsection
