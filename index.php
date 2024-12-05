<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a DataGrid with PHP MySQLi and jQuery EasyUI</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Create a DataGrid with PHP MySQLi and jQuery EasyUI</h2>
    <p>Click the buttons on the datagrid toolbar to perform CRUD actions.</p>

    <table id="dg" title="Users Management" class="easyui-datagrid" url="getData.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" style="width:100%;height:450px;">
        <thead>
            <tr>
                <th field="firstname" width="50" sortable="true">First Name</th>
                <th field="lastname" width="50" sortable="true">Last Name</th>
                <th field="phone" width="50">Phone</th>
                <th field="email" width="50">Email</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar">
        <div id="tb" style="margin-top: 5px;">
            <input id="term" placeholder="Type keywords...">
            <a href="javascript:void(0);" class="easyui-linkbutton" style="height:30px;" type="search" plain="true" onclick="doSearch()">Search</a>
        </div>
        <div id="tb2">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
            <!-- Add Sort button -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="sortUsers()">Sort</a>
        </div>
    </div>

    <div id="dlg" class="easyui-dialog" style="width:450px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input name="firstname" class="easyui-textbox" required="true" label="First Name:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="lastname" class="easyui-textbox" required="true" label="Last Name:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="phone" class="easyui-textbox" required="true" label="Phone:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="email" class="easyui-textbox" required="true" validType="email" label="Email:" style="width:100%">
            </div>
        </form>
    </div>

    <div id="dlg-buttons">
        <a href="javascript:void(0);" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px;">Save</a>
        <a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close');" style="width:90px;">Cancel</a>
    </div>

    <script type="text/javascript">
        var url;

        function doSearch() {
            $('#dg').datagrid('load', {
                term: $('#term').val()
            });
        }

        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'New User');
            $('#fm').form('clear');
            url = 'addData.php';  // URL for adding new user
            console.log('URL for new user:', url);
        }

        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
                $('#fm').form('load', row);
                url = 'editData.php?id=' + row.id;  // URL for editing existing user
                console.log('URL for editing user:', url);
            }
        }

        function saveUser() {
            console.log('Form submitting with URL:', url);  // Debugging to check if URL is correct

            $('#fm').form('submit', {
                url: url,
                onSubmit: function () {
                    return $(this).form('validate');  // Ensure form validation before submission
                },
                success: function (response) {
                    var respData = $.parseJSON(response);
                    if (respData.status == 0) {
                        $.messager.show({
                            title: 'Error',
                            msg: respData.msg
                        });
                    } else {
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');  // Reload the data grid
                    }
                }
            });
        }

        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirm', 'Are you sure you want to delete this user?', function (r) {
                    if (r) {
                        $.post('deleteData.php', {id: row.id}, function (response) {
                            if (response.status == 1) {
                                $('#dg').datagrid('reload');
                            } else {
                                $.messager.show({
                                    title: 'Error',
                                    msg: response.msg
                                });
                            }
                        }, 'json');
                    }
                });
            }
        }

        // Sort Users function
        function sortUsers() {
            // Example: Sorting by 'firstname' column in ascending order
            var column = 'firstname';  // Example: Sorting by 'firstname' column
            var sortOrder = 'asc';      // Sort order (asc or desc)

            // Apply sorting to the DataGrid
            $('#dg').datagrid('load', {
                term: $('#term').val(),
                sort: column,             // Column to sort by
                order: sortOrder          // Sort order (ascending or descending)
            });
        }
    </script>
</body>
</html>
