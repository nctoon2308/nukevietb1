<!-- BEGIN: main -->
<div class="content">
    <div id="lobanOuter" style="height:400px;">
        <div id="abc"></div>
        <div class="loban-touch-left"></div>
        <div class="loban-touch-right"></div>
        <div id="sodoLoban"></div>
        <div id="container-sodo"><input type="text" value="0" name="sodo" id="sodo" /> mm ({LANG.nhapso})</div>
        <div id="thanhdo"></div>
        <p class="loban-note">{LANG.keodexem}</p>
        <p class="loban-t loban-522">{LANG.thuoc522}</p>
        <p class="loban-t loban-429">{LANG.thuoc429}</p>
        <p class="loban-t loban-388">{LANG.thuoc388}</p>
        <div id="loban-wrapper">
            <div id="loban-scroller">
                <div id="pullRight" style="display:none;">
                    <span class="pullRightIcon"></span><span class="pullRightLabel">{LANG.keoquaphai}</span>
                </div>
                <ul id="loban-thelist">
                    <li>
                        <img src="{LINK_MAIN}thuoc522" nopin="nopin" />
                        <img src="{LINK_MAIN}thuoc429" nopin="nopin" />
                        <img src="{LINK_MAIN}thuoc388" nopin="nopin" />
                    </li>
                </ul>
                <div id="pullLeft" style="display:none;">
                    <span class="pullLeftIcon"></span><span class="pullLeftLabel">{LANG.keoquatrai}</span>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="donvitinh">{LANG.donvitinh}: mm</div>
</div>

<script type="text/javascript">
    var rulerLength = 1000, //S? do 1 do?n thu?c (mm)
        trimStart = 0,  //S? do d?u c?a thu?c (mm)
        trimEnd = 1000, //S? do cu?i c?a thu?c (mm)
    
        myScroll;
    
    function pullRightAction () {
        if(trimStart > 0) {
            $('#loban-scroller').width(function(i,width){
                return width + 10000;
            });
            trimStart -= rulerLength;
            var qStr = '&trimStart='+trimStart+'&rulerLength='+rulerLength;
            var newLi = $('<li>').append($('<img/>', { src:'{LINK_MAIN}thuoc522'+qStr }))
                .append($('<img/>', { src:'{LINK_MAIN}thuoc429'+qStr }))
                .append($('<img/>', { src:'{LINK_MAIN}thuoc388'+qStr }));
            $('#loban-thelist').prepend(newLi);
            myScroll.refresh();
        }
    }
    
    function pullLeftAction () {
        if(trimEnd < 50000) {
            $('#loban-scroller').width(function(i,width){
                return width + 10000;
            });
            var qStr = '&trimStart='+trimEnd+'&rulerLength='+rulerLength;
            var newLi = $('<li>').append($('<img/>', { src:'{LINK_MAIN}thuoc522'+qStr }))
                .append($('<img/>', { src:'{LINK_MAIN}thuoc429'+qStr }))
                .append($('<img/>', { src:'{LINK_MAIN}thuoc388'+qStr }));
            trimEnd += rulerLength;
            $('#loban-thelist').append(newLi);
            myScroll.refresh();
        }
    }
    
    function loaded() {
        Math.nativeRound = Math.round;
        Math.round = function(i, iDecimals) {
            if (!iDecimals)
                return Math.nativeRound(i);
            else
                return Math.nativeRound(i * Math.pow(10, Math.abs(iDecimals))) / Math.pow(10, Math.abs(iDecimals));
    
        };
    
        myScroll = new iScroll('loban-wrapper', {
            useTransition: true,
            leftOffset: $('#pullRight').outerWidth(true),
            onRefresh: function () {
                $('#thanhdo').css({'left': $('#lobanOuter').width()/2 + 'px' });
                //$('#container-sodo').css({'left': ($('#lobanOuter').width()/2 - 32) + 'px' });
                if ($('#pullRight').hasClass('loading')) {
                    $('#pullRight').removeClass('loading');
                    $('#pullRight .pullRightLabel').html('{LANG.keoquaphai}');
                } else if ($('#pullLeft').hasClass('loading')) {
                    $('#pullLeft').removeClass('loading');
                    $('#pullLeft .pullLeftLabel').html('{LANG.keoquatrai}');
                }
                $('#sodoLoban').html(Math.round((-this.x+$('#lobanOuter').width()/2)/100,1) + ' cm');
                $('#sodo').val(Math.round((-this.x+$('#lobanOuter').width()/2)/10,0));
            },
            onScrollMove: function () {
                $('#sodoLoban').html(Math.round((-this.x+$('#lobanOuter').width()/2)/100,1) + ' cm');
                $('#sodo').val(Math.round((-this.x+$('#lobanOuter').width()/2)/10,0));
            },
            onScrollEnd: function () {
                console.log("onScrollEnd: " + this.x);
                if (this.x == 0 && !$('#pullRight').hasClass('flip')) {
                    console.log("pullRight add class 'flip'");
                    $('#pullRight').addClass('flip');
                    $('#pullRight .pullRightLabel').html('{LANG.thalammoi}');
                } else if (-this.x > ($('#loban-scroller').width() - 2000) && !$('#pullLeft').hasClass('flip')) {
                    console.log("pullLeft add class 'flip'");
                    $('#pullLeft').addClass('flip');
                    $('#pullLeft .pullLeftLabel').html('{LANG.thalammoi}');
                }
    
                $('#abc').html('this.x='+this.x+' : out='+($('#loban-scroller').width()-2000));
    
                if ($('#pullRight').hasClass('flip')) {
                    $('#pullRight').removeClass('flip');
                    $('#pullRight').addClass('loading');
                    $('#pullRight .pullRightLabel').html('...');
                    console.log("pullRightAction");
                    pullRightAction();	// Execute custom function (ajax call?)
                } else if ($('#pullLeft').hasClass('flip')) {
                    $('#pullLeft').removeClass('flip');
                    $('#pullLeft').addClass('loading');
                    $('#pullLeft .pullLeftLabel').html('...');
                    console.log("pullLeftAction");
                    pullLeftAction();	// Execute custom function (ajax call?)
                }
                $('#sodoLoban').html(Math.round((-this.x+$('#lobanOuter').width()/2)/100,1) + ' cm');
                $('#sodo').val(Math.round((-this.x+$('#lobanOuter').width()/2)/10,0));
            }
        });
    
        setTimeout(function () { document.getElementById('loban-wrapper').style.left = '0'; }, 800);
    
    
        $('#sodo').blur(function(){
            var px = parseFloat($(this).val())*10
            px += $('#lobanOuter').width()/2;
            var st = Math.ceil((px-trimEnd*10)/10000)
            if(st>0){
                for(var i=1;i<=st;i++){
                    pullLeftAction();
                }
                myScroll.refresh();
            }
            myScroll.scrollTo(-(px-Math.round($('#lobanOuter').width(),0)),0,Math.max((st+1)*500, 1500))
        });
    
        $('#sodo').bind('keypress', function(e) {
            var code = e.keyCode || e.which;
            if(code == 13) {
                $(this).blur()
            }
            else {
                if(!((code == 46) || (code>=48 && code<=57))){
                    return false;
                }
            }
        });
    
    }
    
    document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
</script>
<!-- END: main -->