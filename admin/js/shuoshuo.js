/**
 * Created by lxb on 2017/9/17.
 */

function getGeoLocation(){
    if('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(
            // 若获取成功
            function(position) {
                var lat = position.coords.latitude;     // 纬度
                var lng = position.coords.longitude;    // 经度
                s.set('geolat', lat);
                s.set('geolng', lng);
                get_detail_location(lat, lng);
            },
            // 若获取失败
            function(err) {
                //alert('获取地理位置时遇到错误。');
                $('.geo').html("坐标："+'<span class=error>获取地理位置时遇到错误('+err.message+ ')</span>');
                $('.error').text('获取地理位置时遇到错误(' + err.message + ')');
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
        s.set('geoaddr', elm.children()[0].value);
    }
}


//绑定说说对象与页面输出；
function Shuoshuo(uid){
    var binder = new PubSub(uid);
    var message = uid + ':change';
    var shuoshuo = {
        attributes : {},
        set : function(attrName, value){
            this.attributes[attrName] = value;
            console.log(this.attributes);
            binder.trigger(message, [attrName, value, this]);
        },
        get : function (attrName) {
            return this.attributes[attrName];
        },
        edit: function (data) {
            //console.log(data);
            this.set('id', data.id);
            this.set('content', data.content);
            this.set('date', data.date);
            this.set('geolat', data.geo_lat);
            this.set('geolng', data.geo_lng);
            this.set('geoaddr', data.geo_addr);
        },
        _binder : binder
    }

    binder.on(message, function (e, attrName, value, obj) {
        if(obj !== shuoshuo){
            shuoshuo.set(attrName, value);
        }
    });

    return shuoshuo;
}

function edit_shuoshuo(data){
    console.log(data.id);
    $(':input[name=id]').val(data.id);
    $(':input[name=content]').val(data.content);
    $(':input[name=date]').val(data.date);
    $(':input[name=geolat]').val(data.geo_lat);
    $(':input[name=geolng]').val(data.geo_lng);
    $(':input[name=geoaddr]').val(data.geo_addr);
}

var s = new Shuoshuo('shuoshuo');
$(document).ready(function () {
    $('#rct-shuoshuo').on('click', function (e) {
        var t = e.target.classList;
        if(t.contains('edit')){
            var id = $(e.target.parentNode).data('id');
            $.get('shuoshuo.php', {"id":id}, function (data) {
                s.edit(JSON.parse(data));
            });
            //location.href = '?id='+id;
            e.preventDefault();
            e.stopPropagation();
            return;
        } else if(t.contains('delete')){
            if(!confirm('确定删除说说？')){
                return;
            }
            var id = $(e.target.parentNode).data('id');
            $.get('shuoshuo.php', {"id":id, "delete":1}, function (data) {
                var rep = JSON.parse(data);
                if(rep.repCode == 0){
                    alert(rep.repInfo);
                    location.reload();
                }
                alert(rep.repInfo);
            });
            e.preventDefault();
            e.stopPropagation();
            return;
        }

    })
})
