<?php
$currentPage = 'displayCategory';
$currentNav = 'category';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Edit Category

            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Category </label>
                            </div>
                            <input type="text" placeholder="Enter Category Name" name="name"
                            value="{{$category->name}}">

                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <button class="add-items">
                        Update User
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
