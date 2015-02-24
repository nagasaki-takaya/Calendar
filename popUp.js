    function showPopup(event,monthDay) {

        target = document.getElementById(monthDay);

        if(!event) var event = window.event;
        if(!event.pageX) px = event.clientX + document.body.scrollLeft; else px = event.pageX;
        if(!event.pageY) py = event.clientY + document.body.scrollTop; else py = event.pageY;

        target.style.left = px+30+"px";
        target.style.top  = py+5 + "px";
        target.style.visibility = "visible";
    }

    function hidePopup(monthDa) {
        target = document.getElementById(monthDa);
        target.style.visibility = "hidden";
    }
