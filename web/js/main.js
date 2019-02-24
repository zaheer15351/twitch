$(document).ready(function () {
    var current = location.pathname;
    if (current=="/") {
        current="home";
    } else if (current=="/streamer") {
        current="streamer";
    }
    $('nav li a.local').each(function(){
        var $this = $(this);
        if($this.data('index').indexOf(current) !== -1){
            $this.parent().addClass('active');
        }
    });
});