<!-- BEGIN: main -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="text-center">
            <th class="text-nowrap">So thu tu</th>
            <th class="text-nowrap">Ho ten</th>
            <th class="text-nowrap">Email</th>
            <th class="text-nowrap">Phone</th>
            <th class="text-nowrap">Gioi tinh</th>
            <th class="text-nowrap">Dia chi</th>
            <th class="text-nowrap">kich hoat</th>
            <th class="text-nowrap text-center">Chuc nang</th>
        </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
            <tr class="text-center">
                <td class="">
                    <select onchange="nv_change_weight({ROW.id})" name="weight" class="form-control weight_{ROW.id}" id="">
                        <!-- BEGIN: weight -->
                        <option value="{J}" {J_SELECT}>{J}</option>
                        <!-- END: weight -->
                    </select>
                </td>
                <td class="">{ROW.fullname}</td>
                <td class="">{ROW.email}</td>
                <td class="">{ROW.phone}</td>
                <td class="">{ROW.gender}</td>
                <td class="">{ROW.address}</td>
                <td class="">
                    <input onchange="nv_change_active({ROW.id})" type="checkbox" name="active" {ROW.active}>
                </td>
                <td class="text-center text-nowrap">
                    <a href="{ROW.url_edit}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i>Sửa</a>
                    <a href="{ROW.url_delete}" class="btn btn-danger btn-sm delete"><i class="fa fa-edit"></i>Xoá</a>
                </td>
            </tr>
        <!-- END: loop -->
        </tbody>
    </table>
    <!-- BEGIN: GENERATE_PAGE -->
        {GENERATE_PAGE}
    <!-- END: GENERATE_PAGE -->
</div>
<script type="text/javascript">

    function nv_change_weight(id) {
        var new_weight = $('.weight_'+id).val();
        $.ajax({
            url: script_name + '?' + nv_name_variable + '=' + nv_module_name
                + '&' + nv_fc_variable
                + '=list&change_weight=1&id=' + id + '&new_weight='+new_weight,
            success: function (result) {
               if (result!='ERR'){

                    location.reload();
                }

            }
        });
    }
    function nv_change_active(id) {
        $.ajax({
            url: script_name + '?' + nv_name_variable + '=' + nv_module_name
                + '&' + nv_fc_variable
                + '=list&change_active=1&id=' + id,
            success: function (result) {
              if (result=='ERR'){
                  /*location.reload();*/
                    alert('Loi k xac dinh');
                  location.reload();
              }

            }
        });
    }
   /* $.document.ready(function () {
        $('.delete').click(function () {
            if (confirm('Ban co muon xoa khong?')){
                return true;
            }else {
                return false;
            }
        });
    });*/
</script>
<!-- END: main -->