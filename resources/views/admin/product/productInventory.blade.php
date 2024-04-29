<?php
$currentPage = 'inventoryProduct';
$currentNav = 'product';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Product Inventory </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Sn no.</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>stock</th>
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
                                <td>{{ $product->stock }}</td>

                                <td>
                                    <div style="display: flex; gap:3px; height:full">

                                        <a href="{{ route('admin.products.inventory.edit', ['id' => $product->id]) }}"
                                            style="color: white;width: 100%;">
                                            <button class="edit-user" style="width: 100%;">
                                                Edit
                                            </button>
                                        </a>
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
