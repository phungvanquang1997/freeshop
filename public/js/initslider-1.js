jQuery(document).ready(function () {    var scripts = document.getElementsByTagName("script");    var jsFolder = "";    for (var i = 0; i < scripts.length; i++) {        if (scripts[i].src && scripts[i].src.match(/initslider-1\.js/i))            jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);    }    jQuery("#amazingslider-1").amazingslider({        sliderid: 1,        jsfolder: jsFolder,        width: 800,        height: 1000,        skinsfoldername: "",        loadimageondemand: false,        videohidecontrols: false,        donotresize: false,        enabletouchswipe: true,        fullscreen: false,        autoplayvideo: false,        addmargin: true,        randomplay: false,        isresponsive: false,        pauseonmouseover: false,        playvideoonclickthumb: true,        slideinterval: 5000,        fullwidth: false,        transitiononfirstslide: false,        scalemode: "fill",        loop: 0,        autoplay: true,        navplayvideoimage: "../images/amazingslider/play-32-32-0.png",        navpreviewheight: 60,        timerheight: 2,        descriptioncssresponsive: "font-size:12px;",        shownumbering: false,        skin: "RightThumbs",        addgooglefonts: true,        navshowplaypause: true,        navshowplayvideo: true,        navshowplaypausestandalonemarginx: 8,        navshowplaypausestandalonemarginy: 8,        navbuttonradius: 0,        navthumbnavigationarrowimageheight: 32,        navpreviewarrowheight: 16,        lightboxshownavigation: false,        showshadow: false,        navfeaturedarrowimagewidth: 8,        navpreviewwidth: 120,        googlefonts: "Inder",        navborderhighlightcolor: "",        bordercolor: "#ffffff",        lightboxdescriptionbottomcss: "{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}",        lightboxthumbwidth: 80,        navthumbnavigationarrowimagewidth: 32,        navthumbtitlehovercss: "text-decoration:none;",        texteffectresponsivesize: 600,        navcolor: "#999999",        arrowwidth: 32,        texteffecteasing: "easeOutCubic",        texteffect: "slide",        lightboxthumbheight: 60,        navspacing: 8,        navarrowimage: "../images/amazingslider/navarrows-28-28-0.png",        ribbonimage: "../images/amazingslider/ribbon_topleft-0.png",        navwidth: 120,        navheight: 68,        arrowimage: "../images/amazingslider/arrows-32-32-0.png",        timeropacity: 0.6,        arrowhideonmouseleave: 1000,        navthumbnavigationarrowimage: "../images/amazingslider/carouselarrows-32-32-4.png",        navshowplaypausestandalone: false,        texteffect1: "slide",        navpreviewbordercolor: "#ffffff",        texteffect2: "slide",        customcss: "",        ribbonposition: "topleft",        navthumbdescriptioncss: "display:block;position:relative;padding:2px 4px;text-align:left;font:normal 12px Arial,Helvetica,sans-serif;color:#333;",        lightboxtitlebottomcss: "{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}",        arrowstyle: "mouseover",        navthumbtitleheight: 18,        textpositionmargintop: 24,        buttoncssresponsive: "",        navswitchonmouseover: false,        playvideoimage: "../images/amazingslider/playvideo-64-64-0.png",        arrowtop: 50,        textstyle: "static",        playvideoimageheight: 64,        navfonthighlightcolor: "#666666",        showbackgroundimage: false,        navpreviewborder: 4,        navshowplaypausestandaloneheight: 28,        shadowcolor: "#aaaaaa",        navbuttonshowbgimage: true,        navbuttonbgimage: "../images/amazingslider/navbuttonbgimage-28-28-0.png",        textbgcss: "display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);",        textpositiondynamic: "bottomleft",        navpreviewarrowwidth: 8,        playvideoimagewidth: 64,        buttoncss: "display:block; position:relative; margin-top:8px;",        navshowpreviewontouch: false,        bottomshadowimagewidth: 96,        showtimer: true,        navradius: 0,        navmultirows: false,        navshowpreview: false,        navmarginy: 16,        navmarginx: 16,        navfeaturedarrowimage: "../images/amazingslider/featuredarrow-8-16-0.png",        showribbon: false,        navstyle: "thumbnails",        textpositionmarginleft: 24,        descriptioncss: "display:block; position:relative; font:12px \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial; color:#fff; margin-top:8px;",        navplaypauseimage: "../images/amazingslider/navplaypause-28-28-0.png",        backgroundimagetop: -10,        timercolor: "#ffffff",        numberingformat: "%NUM/%TOTAL ",        navdirection: "vertical",        navfontsize: 12,        navhighlightcolor: "#333333",        texteffectdelay1: 1000,        navimage: "../images/amazingslider/bullet-24-24-5.png",        texteffectdelay2: 1500,        texteffectduration1: 600,        navshowplaypausestandaloneautohide: false,        texteffectduration2: 600,        navbuttoncolor: "#999999",        navshowarrow: true,        texteffectslidedirection: "left",        navshowfeaturedarrow: true,        lightboxbarheight: 64,        titlecss: "display:block; position:relative; font:bold 14px \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial; color:#fff;",        ribbonimagey: 0,        ribbonimagex: 0,        texteffectslidedistance1: 120,        texteffectslidedistance2: 120,        navrowspacing: 8,        navshowplaypausestandaloneposition: "bottomright",        navshowbuttons: false,        lightboxthumbtopmargin: 12,        titlecssresponsive: "font-size:12px;",        navshowplaypausestandalonewidth: 28,        navfeaturedarrowimageheight: 16,        navopacity: 0.8,        textpositionmarginright: 24,        backgroundimagewidth: 120,        textautohide: true,        navthumbtitlewidth: 120,        navpreviewposition: "left",        texteffectseparate: false,        arrowheight: 32,        arrowmargin: 8,        texteffectduration: 600,        bottomshadowimage: "../images/amazingslider/bottomshadow-110-95-4.png",        border: 4,        lightboxshowdescription: false,        timerposition: "bottom",        navfontcolor: "#333333",        navthumbnavigationstyle: "arrowinside",        borderradius: 0,        navbuttonhighlightcolor: "#333333",        textpositionstatic: "bottom",        texteffecteasing2: "easeOutCubic",        navthumbstyle: "imageandtitle",        texteffecteasing1: "easeOutCubic",        textcss: "display:block; padding:12px; text-align:left;",        navbordercolor: "#ffffff",        navpreviewarrowimage: "../images/amazingslider/previewarrow-8-16-0.png",        navthumbtitlecss: "display:block;position:relative;padding:2px 4px;text-align:center;font:bold 12px Arial,Helvetica,sans-serif;color:#333;",        showbottomshadow: false,        texteffectslidedistance: 30,        texteffectdelay: 500,        textpositionmarginstatic: 0,        backgroundimage: "",        navposition: "right",        texteffectslidedirection1: "right",        navborder: 2,        textformat: "Bottom bar",        texteffectslidedirection2: "right",        bottomshadowimagetop: 95,        texteffectresponsive: true,        shadowsize: 5,        lightboxthumbbottommargin: 8,        textpositionmarginbottom: 24,        lightboxshowtitle: true,        fade: {            duration: 3000,            easing: "easeOutCubic",            checked: true        },        transition: "fade",        scalemode: "fill",        isfullscreen: false,        textformat: {}    });});