var adaptiveWx = function () {
    var locPath= location.pathname,
        locSearch = location.search,
        wxUrl = 'http://m.2.fengniao.com',
        init =function () {
            wxUrl =((/^\/secforum\/(\d+)\.html$/.test(locPath))||/^\/credit\/list/.test(locPath) ||/^\/recycle/.test(locPath)  ) ?wxUrl+locPath+locSearch:wxUrl;
        },
        isWap =(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/i.test(navigator.userAgent))) && (document.cookie.indexOf("showpc=1") < 0),
        start =function () {
            init();
            window.location.href = wxUrl;
        };
        isWap && start();
}
adaptiveWx();



