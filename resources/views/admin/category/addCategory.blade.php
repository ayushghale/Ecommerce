<?php
$currentPage = 'addCategory';
$currentNav = 'category';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Add Category

            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Category name</label>
                            </div>
                            <input type="text" placeholder="Enter catrgory" name="name">

                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <button class="add-items">
                        Add Category
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
