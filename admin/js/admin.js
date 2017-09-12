/**
 * Created by lgw on 2017/8/13.
 */
function getGeoLocation(){
    if('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
            // 若获取成功
            function(position) {
                var lat = position.coords.latitude;     // 纬度
                var lng = position.coords.longitude;    // 经度
                $('.geo').text('坐标:'+' 纬度:'+lat+', 经度:'+lng);
                $('input[name=geolat]').val(lat);
                $('input[name=geolng]').val(lng);
                get_detail_location(lat, lng);
            },
            // 若获取失败
            function(err) {
                //alert('获取地理位置时遇到错误。');
                $('.geo').html($('.geo').text()+'<span class=error>获取地理位置时遇到错误('+err.message+ ')</span>');
            },
            // 更多参数
            {
                enableHighAccuracy: true,               // 启用高精度获取
            }
        );
    }
    else {
        alert('你的浏览器不支持地理位置服务。');
    }
}

function get_detail_location(lat,lng) {
    //var results = $('#results');
    // 注意高德的经纬度参数与上面两个是相反的
    var gd = document.createElement('script');
    gd.src = '//restapi.amap.com/v3/assistant/coordinate/convert?key=eb057f7b19b8bb1c89a76b571e3490cc&locations='+
        lng+','+lat+'&coordsys=gps&output=json&callback=update_address_gaode_coord';
    $('.loads').empty();
    $('.loads').append(gd);
}

function update_address_gaode_coord(data) {
    if(data.status === '1'){
        var s = data.locations;
        var sc = document.createElement('script');
        sc.src = '//restapi.amap.com/v3/geocode/regeo?key=eb057f7b19b8bb1c89a76b571e3490cc&location=' +
            s+'&extensions=all&callback=update_address_gaode';
        $('.loads').append(sc);
    }
}

function update_address_gaode(data){
    update_address(data, $('#location'));
}

function update_address(data, elm) {
    elm.empty();
    if(data.status == 1 || data.status == 0){
        var a = data.result || data.regeocode;
        (a.pois || []).forEach(function(poi){
            var info = poi.name || poi.title;
            var o = $('<option>');
            o.val(info);
            o.text(info);
            elm.append(o);
        })
    }
}

$(document).ready(function () {

    $('#rct-shuoshuo').on('click', function (e) {
        var t = e.target.classList;
        if(t.contains('edit')){
            var id = (e.target.parentNode).attributes('data-id');
            location.href = '?id='+id;
            e.preventDefault();
            e.stopPropagation();
            return;
        } else if(1){

        }

    })
})


