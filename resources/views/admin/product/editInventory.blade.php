<?php
$currentPage = 'displayProduct';
$currentNav = 'product';
?>


@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Edit Inventory : {{$product->name}}

            </h1>

        </div>
        <div class="dashboard-container">
            <div class="admin-input-container">
                <form action="{{ route('admin.products.inventory.update', ['id' => $product->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="whole-input-container">
                        <div class="add-input-container">
                            <div class="profile-label">
                                <label for="">Stock quantity</label>
                            </div>
                            <input type="number" placeholder="Enter stock quantity" name="stock" min="1" value="{{$inventory->stock}}"
                                style="width: 100%; padding: 10px; border: 1px solid black; margin-top: 10px">
                            @error('stock')
                                <div class="error" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button class="add-items">
                        Update Inventory
                    </button>
                </form>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
