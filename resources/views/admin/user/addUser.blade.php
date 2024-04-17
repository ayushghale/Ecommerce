<?php
$currentPage = 'addUser';
$currentNav = 'user';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Add User

            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Full Name :</label>
                            </div>
                            <input type="text" placeholder="Enter Your Full Name" name="name">

                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Phone Number :</label>
                            </div>
                            <input type="text" placeholder="Enter Phone Number" name="contact_number">
                            @error('contact_number')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Email :</label>
                            </div>
                            <input type="text" placeholder="Enter Email" name="email">
                            @error('email')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Address :</label>
                            </div>
                            <input type="text" placeholder="Enter Address" name="location">
                            @error('location')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Password" name="password">
                            @error('password')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Confirm Password :</label>
                            </div>
                            <input type="text" placeholder="Enter Confirm Password" name="conform_password">
                            @error('conform_password')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <button class="add-items">
                        Add Staff
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
