<?php
$currentPage = 'displayUser';
$currentNav = 'user';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Users </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Sn no.</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $i = 1;
                        ?>
                        @foreach ($userDatas as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->location }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td style="display: flex; gap:3px">
                                    <button class="edit-user">
                                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" style="color: white">
                                            Edit
                                        </a>
                                    </button>

                                    <button class="delete-user">
                                        <a href="{{ route('admin.users.delete', ['id' => $user->id]) }}" style="color: white">
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
