<!-- BEGIN: main -->

<!-- BEGIN: error -->
<div class="alert alert-warning" role="alert">{ERROR}</div>
<!-- END: error -->

<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{POST.id}">
    <table>
        <tr>
            <td>{LANG.name}</td>
            <td><input type="text" name="fullname" id="fullname"></td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td><input type="text" name="phone" id="phone"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>{LANG.gender}</td>
            <td>
                <!-- BEGIN: gender -->
                <input type="radio" name="gender" {GENDER.checked} value="{GENDER.key}">{GENDER.title}
                <!-- END: gender -->
            </td>
        </tr>

        <tr>
            <td>Địa chỉ</td>
            <td>
                <select name="provide" id="provide" onchange="change_provide()">
                    <option value="0">Chon thanh pho</option>
                    <!-- BEGIN: provide -->
                    <option value="{PROVINCE.key}" {PROVINCE.selected}>{PROVINCE.title}</option>
                    <!-- END: provide -->
                </select>
                <select name="district" id="district">
                    <option value="0">Chon quan huyen</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <div class="text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    $.('#provide').select2();
    $.('#district').select2();
    function change_provide() {
        var id_provide = $('#provide').val();
        $.ajax({
            url: script_name + '?' + nv_name_variable + '=' + nv_module_name
                 + '&' + nv_fc_variable
                 + '=main&change_provide=1&id_provide=' + id_provide,
            success: function (result) {
                $('#district').html(result);
            }
        });
    }
</script>
<!-- END: main -->