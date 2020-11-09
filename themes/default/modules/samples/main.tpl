<!-- BEGIN: main -->

<div class="well">
    <form action="{NV_BASE_SITEURL}index.php" method="get">
        <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
        <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />


        <div class="row">
            <div class="col-xs-12 col-md-18">
                <div class="form-group">
                    <input class="form-control" type="text" value="{KEYWORD}" maxlength="64" name="keyword" placeholder="{LANG.search_key}" />
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search}" />
                </div>
            </div>
        </div>
    </form>
</div>

<caption class="caption carousel-caption">Danh sach thanh vien</caption>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="text-center">
            <th class="text-nowrap">So thu tu</th>
            <th class="text-nowrap">Ho ten</th>
        </tr>
        </thead>
        <tbody>
        <!-- BEGIN: loop -->
            <td class=""><a href="{ROW.url_view}"></a>{ROW.stt}</td>
            <td class=""><a href="{ROW.url_view}">{ROW.fullname}</a></td>
        </tr>
        <!-- END: loop -->
        </tbody>
    </table>
    <!-- BEGIN: GENERATE_PAGE -->
    {GENERATE_PAGE}
    <!-- END: GENERATE_PAGE -->
</div>
<!-- END: main -->