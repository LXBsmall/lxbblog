/**
 * Created by lgw on 2017/6/22.
 */
$('#shuoshuo-list').on('click', function(e){
    var cur = e.target;
    var form = $('#shuoshuo-comment');
    if(cur && cur.nodeName.toUpperCase() == 'I'){
        if(cur.className == 'fa fa-commenting'){
            $('#shuoshuo-list').find('i').attr('class', 'fa fa-commenting')
            form.remove();
            $(cur).after(form);
            form.slideDown('fast');
            cur.className = 'fa fa-caret-up';
            $('#shuoshuo-comment').find('input:first').attr('value',
                $(cur).parent().attr('data-shuoshuo-id'));
        } else {
            form.slideUp('fast');
            cur.className = 'fa fa-commenting';
        }
    }
})

function log(data) {
    console.log(data);
}