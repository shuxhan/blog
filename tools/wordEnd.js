/* name: workEnd.js
*  author: shuxhan
*  guide: 下班倒计时，可以在变量message修改下班时间
*         只用写时和分，自动获取当天日期
*/
var workEnd = function () {
    if ((new Date().getMonth() + 1).length != 1) {
        var myMonth = '0' + (new Date().getMonth() + 1);
    } else {
        var myMonth = new Date().getMonth() + 1;
    }

    if ((new Date().getDate()).length != 1) {
        var myDate = '0' + (new Date().getDate());
    } else {
        var myDate = new Date().getDate();
    }

    var body = document.getElementsByTagName('body')[0];
    body.style.fontSize = '20px';
    body.style.textAlign = 'center'
    setInterval(function () {
        var message = (parseInt(((new Date(new Date().getFullYear() + '-' + myMonth + '-' + myDate + ' 17:45:00').getTime()) - (new Date())) / (1000)));
        // 强行替换页面，显示倒计时
        body.innerHTML = '距离下班还有' + message + '秒！';
        // 在控制台打印倒计时
        console.log('距离下班还有' + message + '秒！');
    }, 1000)
}

// 运行事件
workEnd();
