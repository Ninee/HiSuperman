/**
 * Created by hirsi on 2018/9/10.
 */
! function (j, i) {
    function k() {
        var c, d = p.getBoundingClientRect().width;
        d > 750 && (d = 750), c = d / 10, p.style.fontSize = c + "px"
    }
    var o, l, p = j.documentElement,
        n = j.querySelector('meta[name="viewport"]'),
        m = "width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=no";
    n ? n.setAttribute("content", m) : (n = j.createElement("meta"), n.setAttribute("name", "viewport"), n.setAttribute(
        "content", m),  p.firstElementChild ? p.firstElementChild.appendChild(n) : (l =
        j.createElement("div"), l.appendChild(n), j.write(l.innerHTML))), k(), i.addEventListener("resize", function () {
        clearTimeout(o), o = setTimeout(k, 300)
    }, !1), i.addEventListener("pageshow", function (b) {
        b.persisted && (clearTimeout(o), o = setTimeout(k, 300))
    }, !1), "complete" === j.readyState ? j.body.style.fontSize = "16px" : j.addEventListener("DOMContentLoaded", function () {
        j.body.style.fontSize = "16px"
    }, !1)
}(document, window);
// (function() {
//     var html = document.documentElement;
//     var hWidth = html.getBoundingClientRect().width;
//     console.log(hWidth);
//     html.style.fontSize = hWidth / 10 + "px";
// })();