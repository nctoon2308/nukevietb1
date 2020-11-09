<!-- BEGIN: main -->
<!-- BEGIN: DATA -->
<div>
    <table class="table table-striped table-bordered table-hover">
        <caption>Thong tin thanh vien: {DATA.fullname}</caption>
        <tr>
            <td>
                <label for="">Ho Ten: </label>{DATA.fullname}
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Phone: </label>{DATA.phone}
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Email: </label>{DATA.email}
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Gioi Tinh: </label>{DATA.gender}
            </td>
        </tr>
        <tr>
            <td class="">
                <label for="">Hinh Anh</label>
                <img src="{DATA.image}" width="250px" height="250px">
            </td>
        </tr>
    </table>
</div>
<!-- END: DATA -->
<!-- END: main -->