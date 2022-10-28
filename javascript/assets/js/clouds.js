var app = {
    chars: [
        "www_Ahor4_Ro0t",
        "Unleashed",
        "127.0.0.1",
        "CoD3",
        "HACKED!",
        "Security",
        "Breached!",
        "System",
    ],

    init: function () {
        app.container = document.querySelector(".search__clouds").createElement("div");
        app.container.className = "animation-container";
        document.querySelector(".search__clouds").appendChild(app.container);
        window.setInterval(app.add, 100);
    },

    add: function () {
        var element = document.querySelector(".search__clouds").createElement("span");
        app.container.appendChild(element);
        app.animate(element);
    },

    animate: function (element) {
        var character = app.chars[Math.floor(Math.random() * app.chars.length)];
        var duration = Math.floor(Math.random() * 15) + 1;
        var offset = Math.floor(Math.random() * (50 - duration * 2)) + 3;
        var size = 10 + (15 - duration);
        element.style.cssText =
            "right:" +
            offset +
            "vw; font-size:" +
            size +
            "px;animation-duration:" +
            duration +
            "s";
        element.innerHTML = character;
        window.setTimeout(app.remove, duration * 1000, element);
    },

    remove: function (element) {
        element.parentNode.removeChild(element);
    },
};

document.addEventListener("DOMContentLoaded", app.init);
