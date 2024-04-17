<?php
$currentPage = 'displayCategory';
$currentNav = 'category';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Categries </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Sn no.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        ?>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $category->name }}</td>

                                <td style="display: flex; gap:3px">
                                    <button class="edit-user">
                                        <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" style="color: white">
                                            Edit
                                        </a>
                                    </button>

                                    <button class="delete-user">
                                        <a href="{{ route('admin.categories.delete', ['id' => $category->id]) }}" style="color: white">
                                            Delete
                                        </a>
                                    </button>
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
