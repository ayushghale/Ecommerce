<?php
$currentPage = 'displayProduct';
$currentNav = 'product';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Product </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Sn no.</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        ?>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <img src="{{ $product->image }}" alt="" style="width: 100px; height:100px">
                                </td>
                                <td>
                                    <div style="display: flex; gap:3px; height:full">
                                        <button class="edit-user">
                                            <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"
                                                style="color: white">
                                                Edit
                                            </a>
                                        </button>

                                        <button class="delete-user">
                                            <a href="{{ route('admin.products.delete', ['id' => $product->id]) }}"
                                                style="color: white">
                                                Delete
                                            </a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $i++;
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
