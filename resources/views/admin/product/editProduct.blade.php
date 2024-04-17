<?php
$currentPage = 'displayProduct';
$currentNav = 'product';
?>


@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Edit Product

            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="add-input-container" style="padding-bottom: 10px">
                        <div class="profile-label">
                            <label for="">Category Type</label>
                        </div>
                        <!-- <input type="text"  placeholder="Register Service As"> -->
                        <select name="category_id">

                            <option value="{{$product->category_id}}">{{$product->category_name}}</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach\
                            @error('user_type_id')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Name</label>
                            </div>
                            <input type="text" placeholder="Enter Name" name="name"
                                value="{{ $product->name }}">

                            @error('name')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Price</label>
                            </div>
                            <input type="text" placeholder="Enter Price" name="price"
                                value="{{ $product->price }}">

                            @error('price')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Image</label>
                            </div>
                            <input type="file" name="image">

                            @error('image')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div style="margin-right: 20px; ">
                        <div class="profile-label" style=" margin:10px 0">
                            <label for="description">Description</label>
                        </div>
                        <textarea name="description" id="description" rows="10"
                        style="border: 1px solid gray; width: 100%; padding: 10px;">{{$product->description}}</textarea>

                        @error('description')
                            <div class="error" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
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
