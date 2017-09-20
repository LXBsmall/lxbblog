/**
 * Created by lxb on 2017/9/20.
 */



// function PubSub(objId){
//     var message = objId + ':change';
//     var pubSub = jQuery({});
//     var dataAttr = 'bind-' + objId;
//
//     $(document).on('input change', '[data' + dataAttr +']', function(e){
//         var $ele = $(this);
//         console.log('$ele', $ele);
//         pubSub.trigger(message, [$ele.data(dataAttr), $ele.val()]);
//     });
//
//     //推送数据变化到全部绑定对象上
//     pubSub.on(message, function (e, proName, newValue) {
//         $('[data-' + dataAttr + '=' + proName + ']').each(function () {
//             $ele = $(this);
//             if($ele.is('input, textarea')){
//                 $ele.val(newValue);
//             } else if($ele.is('select')) {
//                 //var optSelect = $ele.children()[0]
//                 $ele.children()[0].text = newValue;
//                 $ele.children()[0].value = newValue;
//                 $ele.val(newValue);
//                 console.log($ele.val())
//             } else {
//                 $ele.html(newValue);
//             }
//         });
//     });
//
//     return pubSub;
// }

function PubSub(objId){
    var pubSub = $({});
    var dataAttr = 'bind-'+objId;
    var message = objId +':change';
    $(document).on('input change','[data-' + dataAttr + ']', function(e){
        $ele = $(this);
        //console.log($ele.val());
        pubSub.trigger(message, [$ele.data(dataAttr), $ele.val()]);
    });

    pubSub.on(message, function(e, proName, newValue) {
        $('[data-' + dataAttr + '=' + proName + ']').each(function(){
            var $ele = $(this);
            if($ele.is('input, textarea')) {
                $ele.val(newValue);
            } else if($ele.is('select')) {
                $ele.children()[0].value = newValue;
                $ele.children()[0].text = newValue;
            } else {
                $ele.html(newValue);
            }
        });
    });
    return pubSub;
}